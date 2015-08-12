<?php

namespace Ebay\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AmazonItemImages
 *
 * @ORM\Table(name="amazon_item_images", indexes={@ORM\Index(name="asin", columns={"asin"})})
 * @ORM\Entity
 */
class AmazonItemImages
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
     * @var integer
     *
     * @ORM\Column(name="amazon_id", type="integer", nullable=false)
     */
    private $amazonId;

    /**
     * @var string
     *
     * @ORM\Column(name="asin", type="string", length=255, nullable=false)
     */
    private $asin;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="image_url", type="string", length=255, nullable=false)
     */
    private $imageUrl;

    /**
     * @var integer
     *
     * @ORM\Column(name="display_order", type="integer", nullable=false)
     */
    private $displayOrder = '0';

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
     * Set amazonId
     *
     * @param integer $amazonId
     * @return AmazonItemImages
     */
    public function setAmazonId($amazonId)
    {
        $this->amazonId = $amazonId;

        return $this;
    }

    /**
     * Get amazonId
     *
     * @return integer 
     */
    public function getAmazonId()
    {
        return $this->amazonId;
    }

    /**
     * Set asin
     *
     * @param string $asin
     * @return AmazonItemImages
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
     * Set path
     *
     * @param string $path
     * @return AmazonItemImages
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set imageUrl
     *
     * @param string $imageUrl
     * @return AmazonItemImages
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Get imageUrl
     *
     * @return string 
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * Set displayOrder
     *
     * @param integer $displayOrder
     * @return AmazonItemImages
     */
    public function setDisplayOrder($displayOrder)
    {
        $this->displayOrder = $displayOrder;

        return $this;
    }

    /**
     * Get displayOrder
     *
     * @return integer 
     */
    public function getDisplayOrder()
    {
        return $this->displayOrder;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return AmazonItemImages
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
     * @return AmazonItemImages
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
}
