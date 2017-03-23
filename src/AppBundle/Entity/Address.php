<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @Table(name="address__address")
 */
class Address
{
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(type="string", name="street_name", length=255)
     */
    protected $streetName;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(type="string", name="street_number", length=20)
     */
    protected $streetNumber;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(type="string", name="postcode", length=20)
     */
    protected $postcode;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(type="string", name="city", length=255)
     */
    protected $city;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(type="string", name="district", length=255)
     */
    protected $district;



    /**
     * Set streetName
     *
     * @param string $streetName
     *
     * @return ShopAddress
     */
    public function setStreetName($streetName)
    {
        $this->streetName = $streetName;

        return $this;
    }

    /**
     * Get streetName
     *
     * @return string
     */
    public function getStreetName()
    {
        return $this->streetName;
    }

    /**
     * Set streetNumber
     *
     * @param string $streetNumber
     *
     * @return ShopAddress
     */
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    /**
     * Get streetNumber
     *
     * @return string
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     *
     * @return ShopAddress
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return ShopAddress
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    public function __toString()
    {
        return  $this->getStreetNumber().' '.$this->getStreetName().' '.$this->getDistrict().' '.$this->getCity();
    }


    /**
     * Set district
     *
     * @param string $district
     *
     * @return Address
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get district
     *
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }
}
