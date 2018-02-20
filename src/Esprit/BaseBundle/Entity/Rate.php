<?php

namespace Esprit\BaseBundle\Entity;

/**
 * Rate
 */
class Rate
{
    /**
     * @var int
     */
    private $id;


    /**
     * @var integer
     */
    private $rating;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return Rate
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }
    /**
     * @var \Esprit\BaseBundle\Entity\Product
     */
    private $product;


    /**
     * Set product
     *
     * @param \Esprit\BaseBundle\Entity\Product $product
     *
     * @return Rate
     */
    public function setProduct(\Esprit\BaseBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Esprit\BaseBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }


}
