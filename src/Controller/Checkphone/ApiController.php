<?php

namespace App\Controller\Checkphone;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{

    /**
     * @Route("/checkphone/client", methods={"GET"})
     */
    public function phones(): Response
    {
        return $this->json(["All"]);
    }

    /**
     * @Route("/checkphone/client/{phone}", methods={"GET"})
     */
    public function phone(string $phone): Response
    {
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
