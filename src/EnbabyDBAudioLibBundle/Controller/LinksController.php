<?php

namespace EnbabyDBAudioLibBundle\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EnbabyDBManagerBundle\Entity\Series;

class LinksController extends Controller
{

   public function indexAction()
   {
   	$series = $this->getDoctrine()->getRepository('EnbabyAudioLibBundle:Series')->findAll();
      return $this->render('EnbabyAudioLibBundle:Default:index.html.twig',array('series' => $series));
   }



	public function	getSeriesAction($seriesId)
	{	
		$series = getSeriesInfoFromIndex($seriesId);
		if(!$series){
			throw $this->createNotFoundException('啊呀，怎么找不到了！');
		}else{
			$libLoc = getSeriesLocation($seriesId);
			return $this->render('EnbabyAudioLibBundle:Default:series.html.twig',array('libLoc' => $libLoc, 'series' => $series));
		}
	}



    public function getSeriesBookAction($seriesId,$subId)
    {
		$book = getBookInfoFromIndex($seriesId,$subId);
		if(!$book){
			throw $this->createNotFoundException('啊呀，怎么找不到了！');
		}else{
			$libLoc = getBookLocation($seriesId,$subId);
			return $this->render('EnbabyAudioLibBundle:Default:book.html.twig',array('libLoc' => $libLoc, 'book' => $book));
		}
      
      
    }



	 public function getBookAction($bookId)
    {
		$book = $this->getDoctrine()->getRepository('EnbabyAudioLibBundle:Books')->find($bookId);
        if (!$book) {
            throw $this->createNotFoundException('啊呀，怎么找不到了！');
        }
 
		return $this->render('EnbabyAudioLibBundle:Default:book.html.twig',array('book' => $book));
    }
    
    
    


}

