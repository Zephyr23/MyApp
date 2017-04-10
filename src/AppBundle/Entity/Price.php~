<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @Table(name="price__price")
 * @UniqueEntity({"price", "beer"})
 */
class Price
{
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     */
    protected $price;

    /**
     * Owning Side
     *
     * @ORM\ManyToMany(targetEntity="Beer", inversedBy="price", cascade={"persist"})
     * @ORM\JoinTable(name="price_list_price",
     *      joinColumns={@ORM\JoinColumn(name="price_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="beer_id", referencedColumnName="id")}
     *      )
     */
    protected $beer;

    /**
     *
     * @ORM\ManyToMany(targetEntity="PriceList", mappedBy="beerprice")
     */
    protected $pricelist;


    public function __toString()
    {
        return $this->getBeer()[0] . ' ' .$this->getPrice() .'din';
    }

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Set price
     *
     * @param string $price
     *
     * @return Price
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set beer
     *
     * @param \AppBundle\Entity\Beer $beer
     *
     * @return Price
     */
    public function setBeer(\AppBundle\Entity\Beer $beer = null)
    {
        $this->beer = $beer;

        return $this;
    }

    /**
     * Get beer
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBeer()
    {
        return $this->beer;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->beer = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add beer
     *
     * @param \AppBundle\Entity\Beer $beer
     *
     * @return Price
     */
    public function addBeer(\AppBundle\Entity\Beer $beer)
    {
        $this->beer[] = $beer;

        return $this;
    }

    /**
     * Remove beer
     *
     * @param \AppBundle\Entity\Beer $beer
     */
    public function removeBeer(\AppBundle\Entity\Beer $beer)
    {
        $this->beer->removeElement($beer);
    }

    /**
     * Set pricelist
     *
     * @param \AppBundle\Entity\PriceList $pricelist
     *
     * @return Price
     */
    public function setPricelist(\AppBundle\Entity\PriceList $pricelist = null)
    {
        $this->pricelist = $pricelist;

        return $this;
    }



    /**
     * Add pricelist
     *
     * @param \AppBundle\Entity\PriceList $pricelist
     *
     * @return Price
     */
    public function addPricelist(\AppBundle\Entity\PriceList $pricelist)
    {
        $this->pricelist[] = $pricelist;

        return $this;
    }

    /**
     * Remove pricelist
     *
     * @param \AppBundle\Entity\PriceList $pricelist
     */
    public function removePricelist(\AppBundle\Entity\PriceList $pricelist)
    {
        $this->pricelist->removeElement($pricelist);
    }

    /**
     * Get pricelist
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPricelist()
    {
        return $this->pricelist;
    }
}
