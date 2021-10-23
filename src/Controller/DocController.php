<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocController extends AbstractController
{
    /**
     * @Route("/doc", name="doc")
     */
    public function index(): Response
    {
        $pathConfigCheckphone = '/usr/applications/checkphone/context.xml';
        $xmlConfigCheckphone = simplexml_load_file($pathConfigCheckphone);
        $statusCheckphoneRobot = $xmlConfigCheckphone->process;
        return $this->render('doc/index.html.twig', ["statusCheckphoneRobot" => $statusCheckphoneRobot]);
    }
}
