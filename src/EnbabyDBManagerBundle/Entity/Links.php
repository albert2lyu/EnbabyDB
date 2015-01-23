<?php

namespace EnbabyDBManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Links 
 *
 * @ORM\Table(name="Links")
 * @ORM\Entity
 */
class Links
{
    /**
     * @ORM\Column(name="ISBN", type="string", length=13)
     * @ORM\Id
     */
    protected $isbn;
	
    /**
     * @ORM\Column(name="Series", type="string", length=5)
     */
    protected $series;


    /**
     * Set isbn
     *
     * @param string $isbn
     * @return Links
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
     * Set series
     *
     * @param string $series
     * @return Links
     */
    public function setSeries($series)
    {
        $this->series = $series;

        return $this;
    }

    /**
     * Get series
     *
     * @return string 
     */
    public function getSeries()
    {
        return $this->series;
    }
}
