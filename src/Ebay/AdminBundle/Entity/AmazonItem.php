<?php

namespace Ebay\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AmazonItem
 *
 * @ORM\Table(name="amazon_item")
 * @ORM\Entity
 */
class AmazonItem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", nullable=true)
     */
    private $title;

    /**
     * @var float
     *
     * @ORM\Column(name="reviews", type="float", precision=10, scale=0, nullable=true)
     */
    private $reviews;

    /**
     * @var string
     *
     * @ORM\Column(name="soldBy", type="string", length=255, nullable=true)
     */
    private $soldby;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isFBA", type="boolean", nullable=true)
     */
    private $isfba;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="availability", type="string", length=255, nullable=true)
     */
    private $availability;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isInStock", type="boolean", nullable=true)
     */
    private $isinstock;

    /**
     * @var string
     *
     * @ORM\Column(name="shortDesc", type="text", nullable=true)
     */
    private $shortdesc;

    /**
     * @var string
     *
     * @ORM\Column(name="longDesc", type="text", nullable=true)
     */
    private $longdesc;

    /**
     * @var string
     *
     * @ORM\Column(name="longDescRaw", type="text", nullable=true)
     */
    private $longdescraw;
    
    /**
     *
     * @var type 
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;
            

    /**
     * @var string
     *
     * @ORM\Column(name="asin", type="string", length=255, nullable=true)
     */
    private $asin;

    /**
     * @var string
     *
     * @ORM\Column(name="upc", type="string", length=255, nullable=true)
     */
    private $upc;

    /**
     * @var string
     *
     * @ORM\Column(name="ean", type="string", length=255, nullable=true)
     */
    private $ean;

    /**
     * @var string
     *
     * @ORM\Column(name="mpn", type="string", length=255, nullable=true)
     */
    private $mpn;

    /**
     * @var string
     *
     * @ORM\Column(name="dimensions", type="string", length=255, nullable=true)
     */
    private $dimensions;

    /**
     * @var integer
     *
     * @ORM\Column(name="reviewsNum", type="integer", nullable=true)
     */
    private $reviewsnum;

    /**
     * @var integer
     *
     * @ORM\Column(name="sellerRank", type="integer", nullable=true)
     */
    private $sellerrank;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    


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
     * Set title
     *
     * @param string $title
     * @return AmazonItem
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set reviews
     *
     * @param float $reviews
     * @return AmazonItem
     */
    public function setReviews($reviews)
    {
        $this->reviews = $reviews;

        return $this;
    }

    /**
     * Get reviews
     *
     * @return float 
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * Set soldby
     *
     * @param string $soldby
     * @return AmazonItem
     */
    public function setSoldby($soldby)
    {
        $this->soldby = $soldby;

        return $this;
    }

    /**
     * Get soldby
     *
     * @return string 
     */
    public function getSoldby()
    {
        return $this->soldby;
    }

    /**
     * Set isfba
     *
     * @param boolean $isfba
     * @return AmazonItem
     */
    public function setIsfba($isfba)
    {
        $this->isfba = $isfba;

        return $this;
    }

    /**
     * Get isfba
     *
     * @return boolean 
     */
    public function getIsfba()
    {
        return $this->isfba;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return AmazonItem
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set availability
     *
     * @param string $availability
     * @return AmazonItem
     */
    public function setAvailability($availability)
    {
        $this->availability = $availability;

        return $this;
    }

    /**
     * Get availability
     *
     * @return string 
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * Set isinstock
     *
     * @param boolean $isinstock
     * @return AmazonItem
     */
    public function setIsinstock($isinstock)
    {
        $this->isinstock = $isinstock;

        return $this;
    }

    /**
     * Get isinstock
     *
     * @return boolean 
     */
    public function getIsinstock()
    {
        return $this->isinstock;
    }

    /**
     * Set shortdesc
     *
     * @param string $shortdesc
     * @return AmazonItem
     */
    public function setShortdesc($shortdesc)
    {
        $this->shortdesc = $shortdesc;

        return $this;
    }

    /**
     * Get shortdesc
     *
     * @return string 
     */
    public function getShortdesc()
    {
        return $this->shortdesc;
    }

    /**
     * Set longdesc
     *
     * @param string $longdesc
     * @return AmazonItem
     */
    public function setLongdesc($longdesc)
    {
        $this->longdesc = $longdesc;

        return $this;
    }

    /**
     * Get longdesc
     *
     * @return string 
     */
    public function getLongdesc()
    {
        return $this->longdesc;
    }

    /**
     * Set longdescraw
     *
     * @param string $longdescraw
     * @return AmazonItem
     */
    public function setLongdescraw($longdescraw)
    {
        $this->longdescraw = $longdescraw;

        return $this;
    }

    /**
     * Get longdescraw
     *
     * @return string 
     */
    public function getLongdescraw()
    {
        return $this->longdescraw;
    }

    /**
     * Set asin
     *
     * @param string $asin
     * @return AmazonItem
     */
    public function setAsin($asin)
    {
        $this->asin = $asin;

        return $this;
    }

    /**
     * Get asin
     *
     * @return string 
     */
    public function getAsin()
    {
        return $this->asin;
    }

    /**
     * Set upc
     *
     * @param string $upc
     * @return AmazonItem
     */
    public function setUpc($upc)
    {
        $this->upc = $upc;

        return $this;
    }

    /**
     * Get upc
     *
     * @return string 
     */
    public function getUpc()
    {
        return $this->upc;
    }

    /**
     * Set ean
     *
     * @param string $ean
     * @return AmazonItem
     */
    public function setEan($ean)
    {
        $this->ean = $ean;

        return $this;
    }

    /**
     * Get ean
     *
     * @return string 
     */
    public function getEan()
    {
        return $this->ean;
    }

    /**
     * Set mpn
     *
     * @param string $mpn
     * @return AmazonItem
     */
    public function setMpn($mpn)
    {
        $this->mpn = $mpn;

        return $this;
    }

    /**
     * Get mpn
     *
     * @return string 
     */
    public function getMpn()
    {
        return $this->mpn;
    }

    /**
     * Set dimensions
     *
     * @param string $dimensions
     * @return AmazonItem
     */
    public function setDimensions($dimensions)
    {
        $this->dimensions = $dimensions;

        return $this;
    }

    /**
     * Get dimensions
     *
     * @return string 
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * Set reviewsnum
     *
     * @param integer $reviewsnum
     * @return AmazonItem
     */
    public function setReviewsnum($reviewsnum)
    {
        $this->reviewsnum = $reviewsnum;

        return $this;
    }

    /**
     * Get reviewsnum
     *
     * @return integer 
     */
    public function getReviewsnum()
    {
        return $this->reviewsnum;
    }

    /**
     * Set sellerrank
     *
     * @param integer $sellerrank
     * @return AmazonItem
     */
    public function setSellerrank($sellerrank)
    {
        $this->sellerrank = $sellerrank;

        return $this;
    }

    /**
     * Get sellerrank
     *
     * @return integer 
     */
    public function getSellerrank()
    {
        return $this->sellerrank;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return AmazonItem
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return AmazonItem
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return AmazonItem
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
}
