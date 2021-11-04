<?php

namespace App\Controller;

use App\Repository\Checkphone\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocController extends AbstractController
{
    /**
     * @Route("/doc", name="doc")
     */
    public function index(ClientRepository $clientRepository): Response
    {
        // Checkphone
        $pathConfigCheckphone = '/usr/applications/checkphone/context.xml';
        $xmlConfigCheckphone = simplexml_load_file($pathConfigCheckphone);
        $statusCheckphoneRobot = $xmlConfigCheckphone->process;
        $listClient = $clientRepository->countToDay();
        dd($listClient);
        exit();
        // Checkphone END
        return $this->render('doc/index.html.twig', [
            "statusCheckphoneRobot" => $statusCheckphoneRobot,
            "listClient" => $listClient
            ]);
    }

    /**
     * @Route("/doc/info", name="doc_info")
     */
    public function test(ClientRepository $clientRepository): Response
    {
        echo "test page";
        exit();
    }
}
