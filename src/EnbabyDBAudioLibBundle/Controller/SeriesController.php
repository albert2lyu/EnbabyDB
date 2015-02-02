<?php

namespace EnbabyDBAudioLibBundle\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EnbabyDBManagerBundle\Entity\Series;

class SeriesController extends Controller
{

  public function indexAction()
  {
    // $series = $this->getDoctrine()->getRepository('EnbabyDBManagerBundle:Series')->findAll();
    // $series = $this->getDoctrine()->getRepository('EnbabyDBManagerBundle:Series')->findBy([], ['rank' => 'ASC']);
    $em = $this->getDoctrine()->getManager();
    $query = $em->createQuery('SELECT series FROM EnbabyDBManagerBundle:Series series ORDER BY series.rank');
    $series = $query->getResult();
    return $this->render('EnbabyDBAudioLibBundle:Default:index.html.twig',array('series' => $series));
  }

  public function seriesAction($seriesId)
  {
    $series = $this->getDoctrine()->getRepository('EnbabyDBManagerBundle:Series')->findOneById($seriesId);
    if(!$series){
     throw $this->createNotFoundException('啊呀，怎么找不到了！');
   }else{
     $lc = $this->get('EnbabyDBManagerBundle.Services.LinksDB');
     $books = $lc->getBooksInSeries($seriesId);
     return $this->render('EnbabyDBAudioLibBundle:Default:series.html.twig',array('series' => $series,'books' => $books));
   }
 }
}

