<?php

namespace App\Controller\Checkphone;

use App\Entity\Client;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    public function addPhone(Request $request, ClientRepository $clientRepository, EntityManagerInterface $manager): Response
    {
//        if (!$request->request->has("phone")) {
//            return $this->json(array());
//        }

        $client = $clientRepository->findByPhone($request->request->has("phone"));
        print_r($request->request);
        exit();
        if ($client) {
            $client->setState('waiting');
            $client->setUpdated(DateTimeImmutable::ISO8601);
        }
        $manager->persist($client);
        $manager->flush();

        return $this->json($client);
    }

}
