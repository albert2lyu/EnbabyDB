<?php

namespace EnbabyDBManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use EnbabyDBManagerBundle\Entity\Series;
use EnbabyDBManagerBundle\Entity\Books;

DEFINE("WEBROOT","/var/www/EnbabyDB/web");
DEFINE("SnapshotDB","/AudioLib/snapshots/");


class ManagerController extends Controller
{
    public function bookindexAction()
    {
	$em = $this->getDoctrine()->getManager();
	$query = $em->createQuery('SELECT book.isbn FROM EnbabyDBManagerBundle:Books book');
	$bookindex = $query->getResult();
	
	return $this->render('EnbabyDBManagerBundle:Manager:bookindex.html.twig',array('bookindex' => $bookindex));	

    }

    public function bookAction($isbn)
    {
	$book = $this->getDoctrine()->getRepository('EnbabyDBManagerBundle:Books')->find($isbn);

	if(!$book)
	{
		$book = new Books();
	}
	return $this->render('EnbabyDBManagerBundle:Manager:book.html.twig',array('book' => $book));
    }

    public function bookupdateAction(Request $request)
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




    public function seriesindexAction()
    {
	$series = $this->getDoctrine()->getRepository('EnbabyDBManagerBundle:Series')->findAll();
		
        return $this->render('EnbabyDBManagerBundle:Manager:index.html.twig', array('series' => $series));
    }

    public function seriesAction($seriesId)
    {
	$em = $this->getDoctrine()->getManager();
	$series = $em->getRepository('EnbabyDBManagerBundle:Series')->findOneById($seriesId);

	if(!$series) 
	{
		$series = new Series();
		$series->setId($this->getNextSeriesId());
	}


	return $this->render('EnbabyDBManagerBundle:Manager:series.html.twig',array('series'=>$series));
    }

    public function seriesremoveAction(Request $request)
    {
	$seriesId = $request->request->get('Id','NULL');
	if($seriesId =='NULL')
	{
		$response = new Response(json_encode(array('MSG' => '-1')));
	}else{
		$em = $this->getDoctrine()->getManager();
        	$series = $em->getRepository('EnbabyDBManagerBundle:Series')->find($seriesId);

		if(!$series)
		{
			$response = new Response(json_encode(array('MSG' => '-1')));	
		}else{
			$em->remove($series);
			$em->flush();
			$response = new Response(json_encode(array('MSG' => '1')));
		}
		$response->headers->set('Content-Type', 'application/json');
	}
	return $response;
	
}
	
	

    public function seriesupdateAction(Request $request)
    {


	$seriesId = $request->request->get('Id','NULL');
	if($seriesId == 'NULL')
	{
		$response = new Response(json_encode(array('MSG' => '-1')));
		$response->headers->set('Content-Type', 'application/json');
		return $response;
	}
	$em = $this->getDoctrine()->getManager();
	$series = $em->getRepository('EnbabyDBManagerBundle:Series')->find($seriesId);
	$new = null;
	if(!$series)
	{
		$series = new Series();
		$new = 1;
	}
        $series->setId($seriesId);
	$series->setDisplayName($request->request->get('DisplayName'));
	$series->setDescription($request->request->get('Description'));
	$series->setLinkToBuy($request->request->get('LinkToBuy'));
	$series->setSnapshot($request->request->get('Snapshot'));
	$series->setRank($request->request->get('Rank'));

	if($new) $em->persist($series);
	$em->flush();
	
	$response = new Response(json_encode(array('MSG' => '1')));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
	
    }
	
    public function seriesuploadAction(Request $request)
    {
	$fileElementName = 'fileToUpload';
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




    public function getNextSeriesId()
    {
	$nowtime = time();
	$year = ($nowtime / 31556926 + 1970) % 2000 ;
	for($i = 1; $i <100; $i++)
	{
		if($i<10)
		{
			$returnId = 'Z' . $year . '0' . $i;
		}else{
			$returnId = 'Z' . $year . $i;
		}
		$em = $this->getDoctrine()->getManager();
                $series = $em->getRepository('EnbabyDBManagerBundle:Series')->findOneById($returnId);
		if(!$series)
		{
			return $returnId;
		}
		
	}
	
	return 'FULL';
    }
}
