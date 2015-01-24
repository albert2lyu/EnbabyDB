<?php

namespace EnbabyDBManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use EnbabyDBManagerBundle\Entity\Series;
use EnbabyDBManagerBundle\Entity\Books;



class LinksController extends Controller
{
    public function unlinkAction(Request $request)
    {

		$isbn = $request->query->get('ISBN','NULL');
        $seriesId = $request->query->get('Id','NULL');

        if($isbn == 'NULL' || $seriesId == 'NULL')
        {
            $response = new Response(json_encode(array('MSG' => '-1')));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }


        $em = $this->getDoctrine()->getManager();
        $series = $em->getRepository('EnbabyDBManagerBundle:Series')->findOneById($seriesId);
        $book = $em->getRepository('EnbabyDBManagerBundle:Books')->findOneByIsbn($isbn);

        if(!$series || !$book)
        {
				$response = new Response(json_encode(array('MSG' => '-1')));
        }else{
                $lc = $this->get('EnbabyDBManagerBundle.Services.LinksDB');
                $books = $lc->unlinkBookFromSeries($isbn,$seriesId);
				$response = new Response(json_encode(array('MSG' => '1')));
        }


		$response->headers->set('Content-Type', 'application/json');
		return $response;
    }

	public function linkAction(Request $request)
	{
		$isbn = $request->request->get('ISBN','NULL');
		$seriesId = $request->request->get('Id','NULL');

		if($isbn == 'NULL' || $seriesId == 'NULL')
		{
			$response = new Response(json_encode(array('MSG' => '-1')));
			$response->headers->set('Content-Type', 'application/json');
			return $response;
		}

		$em = $this->getDoctrine()->getManager();
        $series = $em->getRepository('EnbabyDBManagerBundle:Series')->findOneById($seriesId);
        $book = $em->getRepository('EnbabyDBManagerBundle:Books')->findOneByIsbn($isbn);

        if(!$series || !$book)
        {
                $response = new Response(json_encode(array('MSG' => '-1','Detail' => 'Can not find ' . $series .' or ' . $book)));
        }else{
                $lc = $this->get('EnbabyDBManagerBundle.Services.LinksDB');
                $books = $lc->linkBookToSeries($isbn,$seriesId);
                $response = new Response(json_encode(array('MSG' => '1')));
        }


        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
	


}
