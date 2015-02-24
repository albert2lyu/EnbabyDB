<?php

namespace EnbabyDBAudioLibBundle\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WelcomeController extends Controller
{

	public function pcAction()
	{
		return $this->render('EnbabyDBAudioLibBundle:Welcome:pc.html.twig');
	}

}

