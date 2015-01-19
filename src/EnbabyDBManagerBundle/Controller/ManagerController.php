<?php

namespace EnbabyDBManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use EnbabyDBManagerBundle\Entity\Series;

class ManagerController extends Controller
{
    public function indexAction()
    {
	$series = $this->getDoctrine()->getRepository('EnbabyDBManagerBundle:Series')->findAll();
		
        return $this->render('EnbabyDBManagerBundle:Manager:index.html.twig', array('series' => $series));
    }

    public function seriesAction(Request $request,$seriesId)
    {
	$em = $this->getDoctrine()->getManager();
	if($seriesId != 'new')
	{	
		$series = $em->getRepository('EnbabyDBManagerBundle:Series')->findOneById($seriesId);
		$form = $this->createFormBuilder($series)
			->add('DisplayName','text')
			->add('Description','textarea')
			->add('BookNumber','text')
			->add('PublishDate','date')
			->add('Publisher','text')
			->add('Save', 'submit')
			->add('Remove','submit')
			->getForm();		
		$form->handleRequest($request);
		if ($form->isValid()) {
			// perform some action, such as saving the task to the database
			if($form->get('Remove')->isClicked())
			{
				$em->remove($series);
				$em->flush();
				return $this->redirect($this->generateUrl('enbaby_db_manager_index'));
			}
			$em->flush();
			
			return $this->render('EnbabyDBManagerBundle:Manager:series.html.twig', array('seriesId'=>$seriesId,'form' => $form->createView(),'updateSuccess'=>'Update Success!'));
			#return $this->redirect($this->generateUrl('task_success'));
		}
		
		return $this->render('EnbabyDBManagerBundle:Manager:series.html.twig', array('seriesId'=>$seriesId,'form' => $form->createView(),'updateSuccess'=>''));
	}else{

		$series = new Series();
		$series->setId($this->getNextSeriesId());
		if($series->getId() == 'FULL')
		{
			return $this->render('EnbabyDBManagerBundle:Manager:error.html.twig', array('errorMsg'=>'Seires is full, wait until next year! ^_^'));
		}
		$form = $this->createFormBuilder($series)
                        ->add('DisplayName','text')
                        ->add('Description','textarea')
                        ->add('BookNumber','text')
                        ->add('PublishDate','date')
                        ->add('Publisher','text')
                        ->add('save', 'submit')
                        ->getForm();            
		$form->handleRequest($request);
		if ($form->isValid())
		{
			$em->persist($series);
			$em->flush();
			return $this->redirect($this->generateUrl('enbaby_db_manager_series',array('seriesId'=>$series->getId())));
			#return $this->render('EnbabyDBManagerBundle:Manager:series.html.twig', array('seriesId'=>$series->getId(),'form' => $form->createView(),'updateSuccess'=>'Update Success!'));
		}

		return $this->render('EnbabyDBManagerBundle:Manager:series.html.twig', array('seriesId'=>$series->getId(),'form' => $form->createView(),'updateSuccess'=>''));
	}
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
