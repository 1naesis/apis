<?php

namespace App\Controller\Checkphone;

use App\Entity\Checkphone\Client;
use App\Entity\Checkphone\Device;
use App\Repository\Checkphone\ClientRepository;
use App\Repository\Checkphone\DeviceRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{

    /**
     * @Route("/checkphone/setting", methods={"GET"})
     */
    public function setting(Request $request): Response
    {
        $pathConfig = '/usr/applications/checkphone/context.xml';
        $xmlConfig = simplexml_load_file($pathConfig);

        if ($request->query->has("id_chat")
            && preg_match("/^[A-Za-z0-9]+$/", $request->query->get("id_chat"))
        ) {
            $xmlConfig->telegram->id_chat = trim($request->query->get("id_chat"));
        }

        $setting = [
            'id_chat' => (string) $xmlConfig->telegram->id_chat
        ];

        $xmlConfig->asXML($pathConfig);
        return $this->json($setting);
    }

    /**
     * @Route("/checkphone/client/{phone}", methods={"GET"})
     */
    public function phone(string $phone,
                          ClientRepository $clientRepository
    ): Response
    {
        $client = $clientRepository->findByPhone($phone);
        if (!$client) {
            $client = new Client();
        }
        return $this->json($client->getArray());
    }

    /**
     * @Route("/checkphone/client", methods={"POST"})
     */
    public function addPhone(
        Request $request,
        EntityManagerInterface $entityManager,
        DeviceRepository $deviceRepository,
        ClientRepository $clientRepository,
        EntityManagerInterface $manager): Response
    {
        $idDev = null;
        if ($request->request->has("id_dev")) {
            $idDev = trim($request->request->get("id_dev"));
        } else if ($request->getContent())  {
            $json = json_decode($request->getContent());
            foreach ($json as $k => $j) {
                if ($k == "id_dev") {
                    $idDev = trim($j);
                }
            }
        }
        if ($idDev) {
            $device = $deviceRepository->findOneByUid($idDev);

            if ($device) {
                $try = $device->getTry();
                if ($try === 0) {
                    return new Response("Forbidden", 403);
                }
                $device ->setTry($try - 1);
            } else {
                $device = (new Device())
                    ->setUid($idDev)
                    ->setTry(2)
                    ->setCreateDate(new DateTimeImmutable());
            }
            $entityManager->persist($device);
            $entityManager->flush();
        }

        $phone = null;
        if ($request->request->has("phone")) {
            $phone = $request->request->get("phone");
        } else if ($request->getContent()) {
            $json = json_decode($request->getContent());
            foreach ($json as $k => $j) {
                if ($k == "phone") {
                    $phone = $j;
                }
            }
        }
        if ($phone) {
            $client = $clientRepository->findByPhone($phone);
            if ($client) {
                $client->setState('waiting')
                    ->setUpdated(new DateTime());
            } else {
                $client = (new Client())
                    ->setPhone($phone)
                    ->setState('waiting')
                    ->setUpdated(new DateTime());
            }
            $manager->persist($client);
            $manager->flush();
        } else {
            $client = new Client();
        }

        return $this->json($client->getArray());
    }

}
