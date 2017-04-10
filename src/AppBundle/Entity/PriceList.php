<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @Table(name="pricelist__pricelist")
 */
class PriceList
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
     * @Assert\NotBlank()
     * @ORM\Column(type="string", name="pricelist_name", length=255)
     */
    protected $name;


    /**
     * Owning Side
     *
     * @ORM\ManyToMany(targetEntity="Price", inversedBy="pricelist", cascade={"persist"})
     * @ORM\JoinTable(name="price_list_pub",
     *      joinColumns={@ORM\JoinColumn(name="price_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="pricelist_id", referencedColumnName="id")}
     *      )
     */
    protected $beerprice;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->beerprice = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return PriceList
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Set beerprice
     *
     * @param \AppBundle\Entity\Price $beerprice
     *
     * @return PriceList
     */
    public function setBeerprice(\AppBundle\Entity\Price $beerprice = null)
    {
        $this->beerprice = $beerprice;

        return $this;
    }

    /**
     * Add beerprice
     *
     * @param \AppBundle\Entity\Price $beerprice
     *
     * @return PriceList
     */
    public function addBeerprice(\AppBundle\Entity\Price $beerprice)
    {
        $this->beerprice[] = $beerprice;

        return $this;
    }

    /**
     * Remove beerprice
     *
     * @param \AppBundle\Entity\Price $beerprice
     */
    public function removeBeerprice(\AppBundle\Entity\Price $beerprice)
    {
        $this->beerprice->removeElement($beerprice);
    }

    /**
     * Get beerprice
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBeerprice()
    {
        return $this->beerprice;
    }



    public function __toString()
    {
        return $this->getName();
    }
}
