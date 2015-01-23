<?php

namespace EnbabyDBManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use EnbabyDBManagerBundle\Entity\Series;
use EnbabyDBManagerBundle\Entity\Books;



class LinksController extends Controller
{
    public function getBooksInSeries($seriesId)
    {
	$em = $this->getDoctrine()->getManager();
	$query = $em->createQuery('SELECT book.isbn,book.displayName FROM EnbabyDBManagerBundle:Books book,EnbabyDBManagerBundle:Links link WHERE link.series = :seriesid AND book.isbn = link.isbn')->setParameter('seriesid', $seriesId);
	$books = $query->getResult();
	return $books;
    }

    public function removeBookFromSeries($isbn,$seriesId)
    {
	$em = $this->getDoctrine()->getManager();
	$link = $em->getRepository('EnbabyDBManagerBundle:Links')->findOneBy(array('isbn'=>$isbn,'series'=>$seriesId));
	if($link)
	{
		$em->delete($link);
		return 1;
	}else{
		return 0;
	}
    }

    public function addBookToSeries($isbn,$seriesId)
    {
	$em = $this->getDoctrine()->getManager();
        $link = $em->getRepository('EnbabyDBManagerBundle:Links')->findOneBy(array('isbn'=>$isbn,'series'=>$seriesId));
	if(!$link)
	{
		$link = new Links();
		$link->setSeries($seriesId);
		$link->setIsbn($isbn);
		$em->persist($link);
		$em->flush();
	}	
        return 1;
    }

    public function getSeriesOfABook($isbn)
    {
	$em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT series.id FROM EnbabyDBManagerBundle:Series series,EnbabyDBManagerBundle:Links link WHERE link.isbn = :isbn AND series.id = link.series')->setParameter('isbn', $isbn);
        $series = $query->getResult();
        return $series;
    }


}
