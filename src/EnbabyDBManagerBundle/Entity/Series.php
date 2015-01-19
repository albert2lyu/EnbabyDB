<?php

namespace EnbabyDBManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Series
 *
 * @ORM\Table(name="Series")
 * @ORM\Entity
 */
class Series
{
    /**
     * @ORM\Column(name="Id", type="string", length=5)
     * @ORM\Id
     */
    protected $id;

	/**
     * @ORM\Column(name="DisplayName", type="text")
     */
    protected $displayName;

    /**
     * @ORM\Column(name="Description", type="text")
     */
    protected $description;

    /**
     * @ORM\Column(name="BookNumber", type="integer")
     */
    protected $bookNumber;

    /**
     * @ORM\Column(name="PublishDate", type="date")
     */
    protected $publishDate;

    /**
     * @ORM\Column(name="Publisher", type="string",length=400)
     */
    protected $publisher;




    /**
     * Set id
     *
     * @param string $id
     * @return Series
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
     * Set displayName
     *
     * @param string $displayName
     * @return Series
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
     * @return Series
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
     * Set bookNumber
     *
     * @param integer $bookNumber
     * @return Series
     */
    public function setBookNumber($bookNumber)
    {
        $this->bookNumber = $bookNumber;

        return $this;
    }

    /**
     * Get bookNumber
     *
     * @return integer 
     */
    public function getBookNumber()
    {
        return $this->bookNumber;
    }

    /**
     * Set publishDate
     *
     * @param \DateTime $publishDate
     * @return Series
     */
    public function setPublishDate($publishDate)
    {
        $this->publishDate = $publishDate;

        return $this;
    }

    /**
     * Get publishDate
     *
     * @return \DateTime 
     */
    public function getPublishDate()
    {
        return $this->publishDate;
    }

    /**
     * Set publisher
     *
     * @param string $publisher
     * @return Series
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * Get publisher
     *
     * @return string 
     */
    public function getPublisher()
    {
        return $this->publisher;
    }
}
