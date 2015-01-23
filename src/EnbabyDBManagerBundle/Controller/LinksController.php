<?php

namespace EnbabyDBManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use EnbabyDBManagerBundle\Entity\Series;
use EnbabyDBManagerBundle\Entity\Books;



class LinksController extends Controller
{
    public function unlinkAction($seriesId)
    {
        $em = $this->getDoctrine()->getManager();
        $series = $em->getRepository('EnbabyDBManagerBundle:Series')->findOneById($seriesId);
        $books = array();

        if(!$series)
        {
                $series = new Series();
                $series->setId($this->getNextSeriesId());
        }else{
                $lc = $this->get('EnbabyDBManagerBundle.Services.LinksDB');
                $books = $lc->getBooksInSeries($seriesId);
        }


        return $this->render('EnbabyDBManagerBundle:Series:series.html.twig',array('series'=>$series,'books'=>$books));
    }



}
