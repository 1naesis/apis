<?php

namespace App\Controller\Checkphone;

use App\Entity\Client;
use App\Repository\ClientRepository;
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
        dump($clientRepository->findByPhoneJSON($phone));
        return $this->json(["get"=>$phone]);
    }

    /**
     * @Route("/checkphone/client", methods={"POST"})
     */
    public function addPhone(Request $request): Response
    {
        if (!$request->request->has("phone")) {
            return $this->json(["post"=>0]);
        }

        return $this->json([$request->request->get("phone")]);
    }

}
