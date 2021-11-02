<?php


namespace App\Controller\Downloader;


use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/download", methods={"POST"})
     */
    public function downloader(Request $request): Response
    {
        $response = [
            'url' => '',
            'status' => 400
        ];
        if ($request->files->has('image')
            && $request->files->get('image') != null
            && $request->files->get('image')->getError() === 0)
        {
            $image = $request->files->get('image');
            $nameFile = time();
            $nowDay = (new DateTimeImmutable())->format('d_m_Y');
            while (file_exists('downloader/'.$nowDay.'/'.$nameFile.'.'.$image->getClientOriginalExtension())) {
                $nameFile ++;
            }
            $image->move('downloader/'.$nowDay, $nameFile.'.'.$image->getClientOriginalExtension());
            if (file_exists('downloader/'.$nowDay.'/'.$nameFile.'.'.$image->getClientOriginalExtension())) {
                $response['url'] = $request->getSchemeAndHttpHost().'/downloader/'.$nowDay.'/'.$nameFile.'.'.$image->getClientOriginalExtension();
                $response['status'] = 200;
            }
        }
        return $this->json($response);
    }
}