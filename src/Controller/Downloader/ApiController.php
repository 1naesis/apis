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
        header("Access-Control-Allow-Origin: *");
        $response = [
            'url' => $request->files->get('image')->getClientOriginalExtension(),
            'status' => 400
        ];
        $allowExtension = ["JPG", "JPEG", "JFIF", "PNG", "TIF", "TIFF", "GIF", "BMP"];
        if ($request->files->has('image')
            && $request->files->get('image') != null
            && $request->files->get('image')->getError() === 0
            && in_array($request->files->get('image')->getClientOriginalExtension(), $allowExtension)
        )
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