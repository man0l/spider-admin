<?php

namespace Ebay\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemSold
 *
 * @ORM\Table(name="item_sold", indexes={@ORM\Index(name="ebay_id", columns={"ebay_id"}), @ORM\Index(name="item_id", columns={"item_id"})})
 * @ORM\Entity
 */
class ItemSold
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
     * @ORM\Column(name="item_id", type="integer", nullable=true)
     */
    private $itemId;

    /**
     * @var string
     *
     * @ORM\Column(name="ebay_id", type="string", length=255, nullable=true)
     */
    private $ebayId;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=true)
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_at", type="datetime", nullable=true)
     */
    private $dateAt;

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
     * Set itemId
     *
     * @param integer $itemId
     * @return ItemSold
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;

        return $this;
    }

    /**
     * Get itemId
     *
     * @return integer 
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * Set ebayId
     *
     * @param string $ebayId
     * @return ItemSold
     */
    public function setEbayId($ebayId)
    {
        $this->ebayId = $ebayId;

        return $this;
    }

    /**
     * Get ebayId
     *
     * @return string 
     */
    public function getEbayId()
    {
        return $this->ebayId;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return ItemSold
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
     * Set quantity
     *
     * @param integer $quantity
     * @return ItemSold
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set dateAt
     *
     * @param \DateTime $dateAt
     * @return ItemSold
     */
    public function setDateAt($dateAt)
    {
        $this->dateAt = $dateAt;

        return $this;
    }

    /**
     * Get dateAt
     *
     * @return \DateTime 
     */
    public function getDateAt()
    {
        return $this->dateAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ItemSold
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
