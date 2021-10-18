<?php

namespace App\Controller\Checkphone;

use App\Entity\Checkphone\Client;
use App\Repository\Checkphone\ClientRepository;
use DateTime;
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
    public function setting(): Response
    {
        $setting = [
            'idchat' => 'asdjaskd'
        ];
        return $this->json($setting);
    }

    /**
     * @Route("/checkphone/client/{phone}", methods={"GET"})
     */
    public function phone(string $phone, ClientRepository $clientRepository): Response
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
        ClientRepository $clientRepository,
        EntityManagerInterface $manager): Response
    {
        $phone = null;
        if ($request->request->has("phone")) {
            $phone = $request->request->get("phone");
        } else {
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
