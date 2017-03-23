<?php
namespace AppBundle\Entity;

use AppBundle\AppBundle;
use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @Table(name="pub__pub")
 */
class Pub
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
     * @ORM\OneToOne(targetEntity="Address",  cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     **/
    protected $address;

    /**
     * Owning Side
     *
     * @ORM\ManyToMany(targetEntity="Beer", inversedBy="pubs", cascade={"persist"})
     * @ORM\JoinTable(name="pub_beer",
     *      joinColumns={@ORM\JoinColumn(name="beer_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="pub_id", referencedColumnName="id")}
     *      )
     */
    protected $beers;

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
     * @var string
     * @ORM\Column(type="time", name="ohours_weekdays_from", length=20, nullable=true)
     */
    protected $ohoursWeekdaysFrom;

    /**
     * @var string
     * @ORM\Column(type="time", name="ohours_saturday_from", length=20, nullable=true)
     */
    protected $ohoursSaturdayFrom;

    /**
     * @var string
     * @ORM\Column(type="time", name="ohours_sunday_from", length=20, nullable=true)
     */
    protected $ohoursSundayFrom;

    /**
     * @var string
     * @ORM\Column(type="time", name="ohours_weekdays_to", length=20, nullable=true)
     */
    protected $ohoursWeekdaysTo;

    /**
     * @var string
     * @ORM\Column(type="time", name="ohours_saturday_to", length=20, nullable=true)
     */
    protected $ohoursSaturdayTo;

    /**
     * @var string
     * @ORM\Column(type="time", name="ohours_sunday_to", length=20, nullable=true)
     */
    protected $ohoursSundayTo;

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
     * @return Pub
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
     * Set address
     *
     * @param \AppBundle\Entity\Address $address
     * @return Pub
     */
    public function setAddress(\AppBundle\Entity\Address $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \AppBundle\Entity\Address 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->beers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add beers
     *
     * @param \AppBundle\Entity\Beer $beer
     * @return Pub
     */
    public function addBeer(\AppBundle\Entity\Beer $beer)
    {
        $beer->addPub($this);
        $this->beers[] = $beer;
    }

    /**
     * Remove beers
     *
     * @param \AppBundle\Entity\Beer $beer
     */
    public function removeBeer(\AppBundle\Entity\Beer $beer)
    {
        $this->beers->removeElement($beer);
    }

    /**
     * Get beers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBeers()
    {
        return $this->beers;
    }


    /**
     * Set picture
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $picture
     *
     * @return Pub
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
     * @return Pub
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
     * Set ohoursWeekdays
     *
     * @param string $ohoursWeekdays
     *
     * @return Pub
     */
    public function setOhoursWeekdays($ohoursWeekdays)
    {
        $this->ohoursWeekdays = $ohoursWeekdays;

        return $this;
    }

    /**
     * Get ohoursWeekdays
     *
     * @return string
     */
    public function getOhoursWeekdays()
    {
        return $this->ohoursWeekdays;
    }

    /**
     * Set ohoursSaturday
     *
     * @param string $ohoursSaturday
     *
     * @return Pub
     */
    public function setOhoursSaturday($ohoursSaturday)
    {
        $this->ohoursSaturday = $ohoursSaturday;

        return $this;
    }

    /**
     * Get ohoursSaturday
     *
     * @return string
     */
    public function getOhoursSaturday()
    {
        return $this->ohoursSaturday;
    }

    /**
     * Set ohoursSunday
     *
     * @param string $ohoursSunday
     *
     * @return Pub
     */
    public function setOhoursSunday($ohoursSunday)
    {
        $this->ohoursSunday = $ohoursSunday;

        return $this;
    }

    /**
     * Get ohoursSunday
     *
     * @return string
     */
    public function getOhoursSunday()
    {
        return $this->ohoursSunday;
    }

    /**
     * Set ohoursWeekdaysFrom
     *
     * @param \DateTime $ohoursWeekdaysFrom
     *
     * @return Pub
     */
    public function setOhoursWeekdaysFrom($ohoursWeekdaysFrom)
    {
        $this->ohoursWeekdaysFrom = $ohoursWeekdaysFrom;

        return $this;
    }

    /**
     * Get ohoursWeekdaysFrom
     *
     * @return \DateTime
     */
    public function getOhoursWeekdaysFrom()
    {
        return $this->ohoursWeekdaysFrom;
    }

    /**
     * Set ohoursSaturdayFrom
     *
     * @param \DateTime $ohoursSaturdayFrom
     *
     * @return Pub
     */
    public function setOhoursSaturdayFrom($ohoursSaturdayFrom)
    {
        $this->ohoursSaturdayFrom = $ohoursSaturdayFrom;

        return $this;
    }

    /**
     * Get ohoursSaturdayFrom
     *
     * @return \DateTime
     */
    public function getOhoursSaturdayFrom()
    {
        return $this->ohoursSaturdayFrom;
    }

    /**
     * Set ohoursSundayFrom
     *
     * @param \DateTime $ohoursSundayFrom
     *
     * @return Pub
     */
    public function setOhoursSundayFrom($ohoursSundayFrom)
    {
        $this->ohoursSundayFrom = $ohoursSundayFrom;

        return $this;
    }

    /**
     * Get ohoursSundayFrom
     *
     * @return \DateTime
     */
    public function getOhoursSundayFrom()
    {
        return $this->ohoursSundayFrom;
    }

    /**
     * Set ohoursWeekdaysTo
     *
     * @param \DateTime $ohoursWeekdaysTo
     *
     * @return Pub
     */
    public function setOhoursWeekdaysTo($ohoursWeekdaysTo)
    {
        $this->ohoursWeekdaysTo = $ohoursWeekdaysTo;

        return $this;
    }

    /**
     * Get ohoursWeekdaysTo
     *
     * @return \DateTime
     */
    public function getOhoursWeekdaysTo()
    {
        return $this->ohoursWeekdaysTo;
    }

    /**
     * Set ohoursSaturdayTo
     *
     * @param \DateTime $ohoursSaturdayTo
     *
     * @return Pub
     */
    public function setOhoursSaturdayTo($ohoursSaturdayTo)
    {
        $this->ohoursSaturdayTo = $ohoursSaturdayTo;

        return $this;
    }

    /**
     * Get ohoursSaturdayTo
     *
     * @return \DateTime
     */
    public function getOhoursSaturdayTo()
    {
        return $this->ohoursSaturdayTo;
    }

    /**
     * Set ohoursSundayTo
     *
     * @param \DateTime $ohoursSundayTo
     *
     * @return Pub
     */
    public function setOhoursSundayTo($ohoursSundayTo)
    {
        $this->ohoursSundayTo = $ohoursSundayTo;

        return $this;
    }

    /**
     * Get ohoursSundayTo
     *
     * @return \DateTime
     */
    public function getOhoursSundayTo()
    {
        return $this->ohoursSundayTo;
    }
}
