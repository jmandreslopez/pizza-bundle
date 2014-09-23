<?php

namespace Demo\PizzaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 */
class Orders
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $customerId;

    /**
     * @var boolean
     */
    private $ingredient1;

    /**
     * @var boolean
     */
    private $ingredient2;

    /**
     * @var boolean
     */
    private $ingredient3;

    /**
     * @var integer
     */
    private $sizeId;

    /**
     * @var boolean
     */
    private $delivered;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \Demo\PizzaBundle\Entity\Customers
     */
    private $customer;

    /**
     * @var \Demo\PizzaBundle\Entity\Sizes
     */
    private $size;


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
     * Set customerId
     *
     * @param integer $customerId
     * @return Orders
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Get customerId
     *
     * @return integer
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set ingredient1
     *
     * @param boolean $ingredient1
     * @return Orders
     */
    public function setIngredient1($ingredient1)
    {
        $this->ingredient1 = $ingredient1;

        return $this;
    }

    /**
     * Get ingredient1
     *
     * @return boolean
     */
    public function getIngredient1()
    {
        return $this->ingredient1;
    }

    /**
     * Set ingredient2
     *
     * @param boolean $ingredient2
     * @return Orders
     */
    public function setIngredient2($ingredient2)
    {
        $this->ingredient2 = $ingredient2;

        return $this;
    }

    /**
     * Get ingredient2
     *
     * @return boolean
     */
    public function getIngredient2()
    {
        return $this->ingredient2;
    }

    /**
     * Set ingredient3
     *
     * @param boolean $ingredient3
     * @return Orders
     */
    public function setIngredient3($ingredient3)
    {
        $this->ingredient3 = $ingredient3;

        return $this;
    }

    /**
     * Get ingredient3
     *
     * @return boolean
     */
    public function getIngredient3()
    {
        return $this->ingredient3;
    }

    /**
     * Set sizeId
     *
     * @param integer $sizeId
     * @return Orders
     */
    public function setSizeId($sizeId)
    {
        $this->sizeId = $sizeId;

        return $this;
    }

    /**
     * Get sizeId
     *
     * @return integer
     */
    public function getSizeId()
    {
        return $this->sizeId;
    }

    /**
     * Set delivered
     *
     * @param boolean $delivered
     * @return Orders
     */
    public function setDelivered($delivered)
    {
        $this->delivered = $delivered;

        return $this;
    }

    /**
     * Get delivered
     *
     * @return boolean
     */
    public function getDelivered()
    {
        return $this->delivered;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Orders
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
     * Set customer
     *
     * @param \Demo\PizzaBundle\Entity\Customers $customer
     * @return Orders
     */
    public function setCustomer(\Demo\PizzaBundle\Entity\Customers $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \Demo\PizzaBundle\Entity\Customers
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set size
     *
     * @param \Demo\PizzaBundle\Entity\Sizes $size
     * @return Orders
     */
    public function setSize(\Demo\PizzaBundle\Entity\Sizes $size = null)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return \Demo\PizzaBundle\Entity\Sizes
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Now we tell doctrine that before we persist or update we call the
     * updatedTimestamps() function.
     *
     * @ORM\PrePersist
     */
    public function timestamps()
    {
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTime(date('Y-m-d H:i:s')));
        }
    }
}
