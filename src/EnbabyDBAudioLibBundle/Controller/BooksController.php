<?php

namespace EnbabyDBAudioLibBundle\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EnbabyDBManagerBundle\Entity\Series;

class BooksController extends Controller
{

	public function bookAction($isbn)
	{
		$book = $this->getDoctrine()->getRepository('EnbabyDBManagerBundle:Books')->find($isbn);
		if (!$book) {
			throw $this->createNotFoundException('啊呀，怎么找不到了！');
		}

		return $this->render('EnbabyDBAudioLibBundle:Default:book.html.twig',array('book' => $book));
	}

}

