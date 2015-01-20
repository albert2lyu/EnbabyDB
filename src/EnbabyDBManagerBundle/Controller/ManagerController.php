<?php

namespace EnbabyDBManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EnbabyDBManagerBundle\Entity\Series;
require('AudioDB.php');

class ManagerController extends Controller
{
    public function indexAction()
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


    public function seriesupdateAction(Request $request)
    {
	$seriesId = $request->request->get('Id','NULL');
	if($seriesId == 'NULL')
		return $this->render('EnbabyDBManagerBundle:Manager:error.html.twig',array('errorMSG' => 'Update Failed'));
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

	$em = $this->getDoctrine()->getManager();
	if($new) $em->persist($series);
	$em->flush();
	
	return $this->render('EnbabyDBManagerBundle:Manager:error.html.twig',array('errorMSG' => 'Update good!'));

	
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
