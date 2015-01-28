<?php

namespace EnbabyDBManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

DEFINE("WEBROOT","/var/www/EnbabyDB/web");
DEFINE("Uploads","/AudioLib/uploads/");


class UploadController extends Controller
{

    public function uploadAction(Request $request)
    {
        $fileElementName = $request->files->keys();
        $uploadFile = $request->files->get($fileElementName[0]);
        if($uploadFile->isValid())
        {
            $timeStamp = md5(time() . $uploadFile->getClientOriginalName());
            $localFileName = $timeStamp . '.' . $uploadFile->guessExtension();
            $file = $uploadFile->move(WEBROOT . Uploads , $localFileName );
            $response = new Response(json_encode(array('MSG' => '1', 'File' =>  $localFileName)));
        }else{
            $response = new Response(json_encode(array('MSG'=> '-1')));
        }
        return $response;
    }
}
