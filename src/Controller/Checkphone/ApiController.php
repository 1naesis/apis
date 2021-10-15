<?php

namespace App\Controller\Checkphone;

use App\Entity\Client;
use App\Repository\ClientRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use http\Exception\BadQueryStringException;
use Monolog\DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{

//    /**
//     * @Route("/checkphone/client", methods={"GET"})
//     */
//    public function phones(): Response
//    {
//        $test = $this->getDoctrine()
//            ->getRepository(Client::class)
//            ->findAll();
//        dump($test);
//        exit();
//        return $this->json($test);
//    }

    /**
     * @Route("/checkphone/client/{phone}", methods={"GET"})
     */
    public function phone(string $phone, ClientRepository $clientRepository): Response
    {
        $client = $clientRepository->findByPhoneJSON($phone);
        return $this->json($client);
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
        if (!$phone) {
            throw new BadQueryStringException("Неверный запрос");
        }

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

        return $this->json($client->getArray());
    }

}
