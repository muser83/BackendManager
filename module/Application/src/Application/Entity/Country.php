<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

/**
 * Application\Entity\Country
 *
 * @ORM\Entity()
 * @ORM\Table(name="countries", indexes={@ORM\Index(name="fk_countries_continents1_idx", columns={"continents_id"})}, uniqueConstraints={@ORM\UniqueConstraint(name="name_UNIQUE", columns={"name"}), @ORM\UniqueConstraint(name="iso31662_UNIQUE", columns={"iso31662"}), @ORM\UniqueConstraint(name="iso31663_UNIQUE", columns={"iso31663"}), @ORM\UniqueConstraint(name="tld_UNIQUE", columns={"tld"}), @ORM\UniqueConstraint(name="calling_code_UNIQUE", columns={"calling_code"}), @ORM\UniqueConstraint(name="local_name_UNIQUE", columns={"local_name"})})
 */
class Country
    implements InputFilterAwareInterface
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $continents_id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $is_visible;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $local_name;

    /**
     * @ORM\Column(type="string", length=2)
     */
    protected $iso31662;

    /**
     * @ORM\Column(type="string", length=3)
     */
    protected $iso31663;

    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $tld;

    /**
     * @ORM\Column(type="string", length=5)
     */
    protected $calling_code;

    /**
     * @ORM\OneToMany(targetEntity="Locale", mappedBy="country")
     * @ORM\JoinColumn(name="countries_id", referencedColumnName="id", nullable=false)
     */
    protected $locales;

    /**
     * @ORM\OneToMany(targetEntity="Province", mappedBy="country")
     * @ORM\JoinColumn(name="countries_id", referencedColumnName="id", nullable=false)
     */
    protected $provinces;

    /**
     * @ORM\ManyToOne(targetEntity="Continent", inversedBy="countries")
     * @ORM\JoinColumn(name="continents_id", referencedColumnName="id", nullable=false)
     */
    protected $continent;

    /**
     * Instance of InputFilterInterface.
     *
     * @var InputFilter
     */
    private $_inputFilter;

    public function __construct()
    {
        $this->locales = new ArrayCollection();
        $this->provinces = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Application\Entity\Country
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of continents_id.
     *
     * @param integer $continents_id
     * @return \Application\Entity\Country
     */
    public function setContinentsId($continents_id)
    {
        $this->continents_id = $continents_id;

        return $this;
    }

    /**
     * Get the value of continents_id.
     *
     * @return integer
     */
    public function getContinentsId()
    {
        return $this->continents_id;
    }

    /**
     * Set the value of is_visible.
     *
     * @param boolean $is_visible
     * @return \Application\Entity\Country
     */
    public function setIsVisible($is_visible)
    {
        $this->is_visible = $is_visible;

        return $this;
    }

    /**
     * Get the value of is_visible.
     *
     * @return boolean
     */
    public function getIsVisible()
    {
        return $this->is_visible;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return \Application\Entity\Country
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of local_name.
     *
     * @param string $local_name
     * @return \Application\Entity\Country
     */
    public function setLocalName($local_name)
    {
        $this->local_name = $local_name;

        return $this;
    }

    /**
     * Get the value of local_name.
     *
     * @return string
     */
    public function getLocalName()
    {
        return $this->local_name;
    }

    /**
     * Set the value of iso31662.
     *
     * @param string $iso31662
     * @return \Application\Entity\Country
     */
    public function setIso31662($iso31662)
    {
        $this->iso31662 = $iso31662;

        return $this;
    }

    /**
     * Get the value of iso31662.
     *
     * @return string
     */
    public function getIso31662()
    {
        return $this->iso31662;
    }

    /**
     * Set the value of iso31663.
     *
     * @param string $iso31663
     * @return \Application\Entity\Country
     */
    public function setIso31663($iso31663)
    {
        $this->iso31663 = $iso31663;

        return $this;
    }

    /**
     * Get the value of iso31663.
     *
     * @return string
     */
    public function getIso31663()
    {
        return $this->iso31663;
    }

    /**
     * Set the value of tld.
     *
     * @param string $tld
     * @return \Application\Entity\Country
     */
    public function setTld($tld)
    {
        $this->tld = $tld;

        return $this;
    }

    /**
     * Get the value of tld.
     *
     * @return string
     */
    public function getTld()
    {
        return $this->tld;
    }

    /**
     * Set the value of calling_code.
     *
     * @param string $calling_code
     * @return \Application\Entity\Country
     */
    public function setCallingCode($calling_code)
    {
        $this->calling_code = $calling_code;

        return $this;
    }

    /**
     * Get the value of calling_code.
     *
     * @return string
     */
    public function getCallingCode()
    {
        return $this->calling_code;
    }

    /**
     * Add Locale entity to collection (one to many).
     *
     * @param \Application\Entity\Locale $locale
     * @return \Application\Entity\Country
     */
    public function addLocale(Locale $locale)
    {
        $this->locales[] = $locale;

        return $this;
    }

    /**
     * Get Locale entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLocales()
    {
        return $this->locales;
    }

    /**
     * Add Province entity to collection (one to many).
     *
     * @param \Application\Entity\Province $province
     * @return \Application\Entity\Country
     */
    public function addProvince(Province $province)
    {
        $this->provinces[] = $province;

        return $this;
    }

    /**
     * Get Province entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProvinces()
    {
        return $this->provinces;
    }

    /**
     * Set Continent entity (many to one).
     *
     * @param \Application\Entity\Continent $continent
     * @return \Application\Entity\Country
     */
    public function setContinent(Continent $continent = null)
    {
        $this->continent = $continent;

        return $this;
    }

    /**
     * Get Continent entity (many to one).
     *
     * @return \Application\Entity\Continent
     */
    public function getContinent()
    {
        return $this->continent;
    }

    /**
     * Not used, Only defined to be compatible with InputFilterAwareInterface.
     * 
     * @param \Zend\InputFilter\InputFilterInterface $inputFilter
     * @throws \Exception
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        // End.
        throw new \Exception("Not used.");
    }

    /**
     * Return a for this entity configured input filter instance.
     *
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {
        if ($this->_inputFilter instanceof InputFilterInterface) {
            // End.
            return $this->_inputFilter;
        }
        $factory = new InputFactory();

        $filters = array(
            array(
                'name' => 'id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'continents_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'is_visible',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'name',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'local_name',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'iso31662',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'iso31663',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'tld',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'calling_code',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
        );

        $this->_inputFilter = $factory->createInputFilter($filters);

        // End.
        return $this->_inputFilter;
    }

    /**
     * Populate entity with the given data.
     * The set* method will be used to set the data.
     *
     * @param array $data
     * @return boolean
     */
    public function populate(array $data = array())
    {

        foreach ($data as $field => $value) {
            $setter = sprintf('set%s', ucfirst(
                    str_replace(' ', '', ucwords(str_replace('_', ' ', $field)))
            ));

            if (method_exists($this, $setter)) {
                $this->{$setter}($value);
            }
        }

        // End.
        return true;
    }

    /**
     * Return all entity fields with values.
     * Fields started with _ will be excluded.
     * 
     * @param array $fields This fields will be copied
     * @return array
     */
    public function getArrayCopy(array $fields = array())
    {
        $orginalFields = get_object_vars($this);
        $copiedFields = array();

        foreach ($orginalFields as $field => $value) {
            switch (true) {
                case ('_' == $field[0]):
                // Field is private
                case (!in_array($field, $fields) && !empty($fields)):
                    // Exclude field
                    continue;
                    break;
                default:
                    $copiedFields[$field] = $value;
            }
        }

        // End.
        return $copiedFields;
    }

    public function __sleep()
    {
        return array('id', 'continents_id', 'is_visible', 'name', 'local_name', 'iso31662', 'iso31663', 'tld', 'calling_code');
    }

    // Custom methods //////////////////////////////////////////////////////////
}

