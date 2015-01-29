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
		$audio_en = $book->getAudioFiles();
		$audio_cn = $book->getAudioFiles_cn();

		if($audio_en != '') {
			$audios_en = split(';', $audio_en);
		}else{
			$audios_en = null;
		}

		if($audio_cn != '') {
			$audios_cn = split(';', $audio_cn);
		}else{
			$audios_cn = null;
		}
		return $this->render('EnbabyDBAudioLibBundle:Default:book.html.twig',
			array('book' => $book,'audios_en' => $audios_en,'audios_cn' => $audios_cn));
	}

}

