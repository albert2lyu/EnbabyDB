<?php

namespace EnbabyDBManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Books 
 *
 * @ORM\Table(name="Books")
 * @ORM\Entity
 */
class Books
{
    /**
     * @ORM\Column(name="Id", type="string", length=10)
     * @ORM\Id
     */
    protected $id;
	
	/**
     * @ORM\Column(name="SeriesId", type="string", length=5)
     */
    protected $seriesId;

	/**
     * @ORM\Column(name="SubId", type="string", length=4)
     */
    protected $subId;

	/**
     * @ORM\Column(name="DisplayName", type="text")
     */
    protected $displayName;

    /**
     * @ORM\Column(name="Description", type="text")
     */
    protected $description;

    /**
     * @ORM\Column(name="Author", type="string",length=200)
     */
    protected $author;


    /**
     * Set id
     *
     * @param string $id
     * @return Books
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set seriesId
     *
     * @param string $seriesId
     * @return Books
     */
    public function setSeriesId($seriesId)
    {
        $this->seriesId = $seriesId;

        return $this;
    }

    /**
     * Get seriesId
     *
     * @return string 
     */
    public function getSeriesId()
    {
        return $this->seriesId;
    }

    /**
     * Set subId
     *
     * @param string $subId
     * @return Books
     */
    public function setSubId($subId)
    {
        $this->subId = $subId;

        return $this;
    }

    /**
     * Get subId
     *
     * @return string 
     */
    public function getSubId()
    {
        return $this->subId;
    }

    /**
     * Set displayName
     *
     * @param string $displayName
     * @return Books
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Get displayName
     *
     * @return string 
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Books
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Books
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
