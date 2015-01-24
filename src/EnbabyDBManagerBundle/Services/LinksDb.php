<?php

namespace EnbabyDBManagerBundle\Services;

use Doctrine\ORM\EntityManager;
use EnbabyDBManagerBundle\Entity\Series;
use EnbabyDBManagerBundle\Entity\Books;
use EnbabyDBManagerBundle\Entity\Links;



class LinksDb 
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getBooksInSeries($seriesId)
    {
	$query = $this->em->createQuery('SELECT book.isbn,book.displayName FROM EnbabyDBManagerBundle:Books book,EnbabyDBManagerBundle:Links link WHERE link.series = :seriesid AND book.isbn = link.isbn')->setParameter('seriesid', $seriesId);
	$books = $query->getResult();
	return $books;
    }

    public function unlinkBookFromSeries($isbn,$seriesId)
    {
	$link = $this->em->getRepository('EnbabyDBManagerBundle:Links')->findOneBy(array('isbn'=>$isbn,'series'=>$seriesId));
	if($link)
	{
		$query = $this->em->createQuery('DELETE FROM EnbabyDBManagerBundle:Links link WHERE link.series = :seriesid AND link.isbn = :isbn')->setParameters(array('seriesid' => $seriesId,'isbn' => $isbn));
    	$books = $query->execute();
		return 1;
	}else{
		return 0;
	}
    }

    public function linkBookToSeries($isbn,$seriesId)
    {
        $link = $this->em->getRepository('EnbabyDBManagerBundle:Links')->findOneBy(array('isbn'=>$isbn,'series'=>$seriesId));
	if(!$link)
	{
		$link = new Links();
		$link->setSeries($seriesId);
		$link->setIsbn($isbn);
		$this->em->persist($link);
		$this->em->flush();
	}	
        return 1;
    }

    public function getSeriesLinkToBook($isbn)
    {
        $query = $this->em->createQuery('SELECT series.id,series.displayName FROM EnbabyDBManagerBundle:Series series,EnbabyDBManagerBundle:Links link WHERE link.isbn = :isbn AND series.id = link.series')->setParameter('isbn', $isbn);
        $series = $query->getResult();
        return $series;
    }

	public function getSeriesNotLinkToBook($isbn)
	{
		$query = $this->em->createQuery('SELECT series.id,series.displayName FROM EnbabyDBManagerBundle:Series series WHERE series.id NOT IN (SELECT link.series FROM EnbabyDBManagerBundle:Links link WHERE link.isbn = :isbn)')->setParameter('isbn', $isbn);
		$series = $query->getResult();
		return $series;
	}
}
