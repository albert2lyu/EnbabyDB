<?php

namespace EnbabyDBManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use EnbabyDBManagerBundle\Entity\Series;
use EnbabyDBManagerBundle\Entity\Books;

DEFINE("WEBROOT","/var/www/EnbabyDB/web");
DEFINE("SnapshotDB","/AudioLib/snapshots/");
DEFINE("AudioDB","/AudioLib/audios/");


class BooksController extends Controller
{
    public function indexAction()
    {
	$em = $this->getDoctrine()->getManager();
	$query = $em->createQuery('SELECT book.isbn FROM EnbabyDBManagerBundle:Books book');
	$index = $query->getResult();
	
	return $this->render('EnbabyDBManagerBundle:Books:index.html.twig',array('index' => $index));	

    }

    public function bookAction($isbn)
    {
	$book = $this->getDoctrine()->getRepository('EnbabyDBManagerBundle:Books')->find($isbn);

	if(!$book)
	{
		$book = new Books();
	}
	return $this->render('EnbabyDBManagerBundle:Books:book.html.twig',array('book' => $book));
    }

    public function updateAction(Request $request)
    {


        $isbn = $request->request->get('ISBN','NULL');
        if($isbn == 'NULL')
        {
                $response = new Response(json_encode(array('MSG' => '-1')));
                $response->headers->set('Content-Type', 'application/json');
                return $response;
        }
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository('EnbabyDBManagerBundle:Books')->find($isbn);
        $new = null;
        if(!$book)
        {
                $book = new Books();
                $new = 1;
        }
        $book->setISBN($isbn);
        $book->setDisplayName($request->request->get('DisplayName'));
        $book->setDescription($request->request->get('Description'));
        $book->setLinkToBuy($request->request->get('LinkToBuy'));
        $book->setSnapshot($request->request->get('Snapshot'));
	$book->setAuthor($request->request->get('Author'));
	$book->setAudioFiles($request->request->get('AudioFiles'));
        $book->setRank($request->request->get('Rank'));

        if($new) $em->persist($book);
        $em->flush();

        $response = new Response(json_encode(array('MSG' => '1')));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }





    public function removeAction(Request $request)
    {
	$isbn = $request->request->get('ISBN','NULL');
	if($isbn =='NULL')
	{
		$response = new Response(json_encode(array('MSG' => '-1')));
	}else{
		$em = $this->getDoctrine()->getManager();
		$query = $em->createQuery('SELECT book.isbn FROM EnbabyDBManagerBundle:Books book WHERE book.isbn = :isbn')->setParameter('isbn', $isbn);
        	$book = $query->getResult();

		if(!$book)
		{
			$response = new Response(json_encode(array('MSG' => '-1')));	
		}else{
			$query = $em->createQuery('DELETE FROM EnbabyDBManagerBundle:Books book WHERE book.isbn = :isbn')->setParameter('isbn',$isbn);
			$query->execute();
			$response = new Response(json_encode(array('MSG' => '1')));
		}
		$response->headers->set('Content-Type', 'application/json');
	}
	return $response;
	
}
	
	

	
    public function snapshotuploadAction(Request $request)
    {
	$fileElementName = 'Snapshot';
	$uploadFile = $request->files->get($fileElementName);
	if($uploadFile->isValid())
	{
		$timeStamp = md5(time() . $uploadFile->getClientOriginalName());
		$localFileName = $timeStamp . '.' . $uploadFile->guessExtension();
		$file = $uploadFile->move(WEBROOT . SnapshotDB , $localFileName );
		$response = new Response(json_encode(array('MSG' => '1', 'Location' =>  SnapshotDB . $localFileName)));

	}else{
		$response = new Response(json_encode(array('MSG'=> '-1')));
	}
	return $response;
    }

    public function audiouploadAction(Request $request)
    {
        $fileElementName = 'Audio';
        $uploadFile = $request->files->get($fileElementName);
        if($uploadFile->isValid())
        {
                $timeStamp = md5(time() . $uploadFile->getClientOriginalName());
                $localFileName = $timeStamp . '.' . $uploadFile->guessExtension();
                $file = $uploadFile->move(WEBROOT . AudioDB , $localFileName );
                $response = new Response(json_encode(array('MSG' => '1', 'Location' =>  AudioDB . $localFileName)));

        }else{
                $response = new Response(json_encode(array('MSG'=> '-1')));
        }
        return $response;
    }



}
