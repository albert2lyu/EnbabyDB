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
     * @ORM\Column(name="ISBN", type="string", length=13)
     . @ORM\Id
     */
    protected $isbn;
	
    /**
     * @ORM\Column(name="DisplayName", type="text")
     */
    protected $displayName;

    /**
     * @ORM\Column(name="Description", type="text")
     */
    protected $description;
   
    /**
     * @ORM\Column(name="LinkToBuy", type="text")
     */
    protected $linkToBuy;

    /**
     * @ORM\Column(name="Snapshot", type="text")
     */
    protected $snapshot;

    /**
     * @ORM\Column(name="Author", type="string",length=200)
     */
    protected $author;

    /**
     * @ORM\Column(name="AudioFiles", type="text")
     */
    protected $audioFiles;

    /**
     * @ORM\Column(name="AudioFiles_cn", type="text")
     */
    protected $audioFiles_cn;
   
    /**
     * @ORM\Column(name="Rank", type="integer")
     */
    protected $rank;


    /**
     * Set isbn
     *
     * @param string $isbn
     * @return Books
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn
     *
     * @return string 
     */
    public function getIsbn()
    {
        return $this->isbn;
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
     * Set linkToBuy
     *
     * @param string $linkToBuy
     * @return Books
     */
    public function setLinkToBuy($linkToBuy)
    {
        $this->linkToBuy = $linkToBuy;

        return $this;
    }

    /**
     * Get linkToBuy
     *
     * @return string 
     */
    public function getLinkToBuy()
    {
        return $this->linkToBuy;
    }

    /**
     * Set snapshot
     *
     * @param string $snapshot
     * @return Books
     */
    public function setSnapshot($snapshot)
    {
        $this->snapshot = $snapshot;

        return $this;
    }

    /**
     * Get snapshot
     *
     * @return string 
     */
    public function getSnapshot()
    {
        return $this->snapshot;
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

    /**
     * Set audioFiles
     *
     * @param string $audioFiles
     * @return Books
     */
    public function setAudioFiles($audioFiles)
    {
        $this->audioFiles = $audioFiles;

        return $this;
    }

    /**
     * Get audioFiles
     *
     * @return string 
     */
    public function getAudioFiles()
    {
        return $this->audioFiles;
    }

    /**
     * Set audioFiles_cn
     *
     * @param string $audioFiles_cn
     * @return Books
     */
    public function setAudioFiles_cn($audioFiles_cn)
    {
        $this->audioFiles_cn = $audioFiles_cn;

        return $this;
    }

    /**
     * Get audioFiles_cn
     *
     * @return string 
     */
    public function getAudioFiles_cn()
    {
        return $this->audioFiles_cn;
    }


    /**
     * Set rank
     *
     * @param integer $rank
     * @return Books
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return integer 
     */
    public function getRank()
    {
        return $this->rank;
    }
}
