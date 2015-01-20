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
     * @ORM\Column(name="LinkToBuy", type="text")
     */
    protected $linkToBuy;

    /**
     * @ORM\Column(name="Snapshot", type="text")
     */
    protected $snapshot;

    /**
     * @ORM\Column(name="Rank", type="integer")
     */
    protected $rank;


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
     * Set linkToBuy
     *
     * @param string $linkToBuy
     * @return Series
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
     * @return Series
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
     * Set rank
     *
     * @param integer $rank
     * @return Series
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
