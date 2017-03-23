<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @Table(name="beer__beer")
 */
class Beer
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
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $name;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $type;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $style;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $manufacturer;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $country;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $ABV;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=65536, nullable=true)
     */
    protected $description;

    /**
     * Inverse Side
     *
     * @ORM\ManyToMany(targetEntity="Pub", mappedBy="beers")
     */
    protected $pubs;

    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="picture", referencedColumnName="id")
     * })
     */
    protected $picture;

    /**
     * @var Gallery
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Gallery")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="gallery", referencedColumnName="id")
     * })
     */
    protected $gallery;


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
     * @return Beer
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
     * Constructor
     */
    public function __construct()
    {
        $this->pubs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add pubs
     *
     * @param \AppBundle\Entity\Pub $pub
     * @return Beer
     */
    public function addPub(\AppBundle\Entity\Pub $pub)
    {
        //$pub->addBeer($this);
        $this->pubs[] = $pub;
    }

    /**
     * Remove pubs
     *
     * @param \AppBundle\Entity\Pub $pub
     */
    public function removePub(\AppBundle\Entity\Pub $pub)
    {
        $this->pubs->removeElement($pub);
    }

    /**
     * Get pubs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPubs()
    {
        return $this->pubs;
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Set picture
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $picture
     *
     * @return Beer
     */
    public function setPicture(\Application\Sonata\MediaBundle\Entity\Media $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set gallery
     *
     * @param \Application\Sonata\MediaBundle\Entity\Gallery $gallery
     *
     * @return Beer
     */
    public function setGallery(\Application\Sonata\MediaBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Application\Sonata\MediaBundle\Entity\Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Beer
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set style
     *
     * @param string $style
     *
     * @return Beer
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Get style
     *
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set manufacturer
     *
     * @param string $manufacturer
     *
     * @return Beer
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * Get manufacturer
     *
     * @return string
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Beer
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set aBV
     *
     * @param string $aBV
     *
     * @return Beer
     */
    public function setABV($aBV)
    {
        $this->ABV = $aBV;

        return $this;
    }

    /**
     * Get aBV
     *
     * @return string
     */
    public function getABV()
    {
        return $this->ABV;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Beer
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
