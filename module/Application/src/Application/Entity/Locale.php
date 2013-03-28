<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

/**
 * Application\Entity\Locale
 *
 * @ORM\Entity()
 * @ORM\Table(name="locales", indexes={@ORM\Index(name="fk_locales_countries1_idx", columns={"countries_id"}), @ORM\Index(name="fk_locales_currencies1_idx", columns={"currencies_id"}), @ORM\Index(name="fk_locales_charsets1_idx", columns={"charsets_id"}), @ORM\Index(name="fk_locales_timezones1_idx", columns={"timezones_id"}), @ORM\Index(name="fk_locales_languages1_idx", columns={"languages_id"})}, uniqueConstraints={@ORM\UniqueConstraint(name="name_UNIQUE", columns={"name"})})
 */
class Locale
    implements InputFilterAwareInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * 
     * @ORM\Column(type="integer")
     */
    protected $countries_id;

    /**
     * 
     * @ORM\Column(type="integer")
     */
    protected $languages_id;

    /**
     * 
     * @ORM\Column(type="integer")
     */
    protected $currencies_id;

    /**
     * 
     * @ORM\Column(type="integer")
     */
    protected $charsets_id;

    /**
     * 
     * @ORM\Column(type="integer")
     */
    protected $timezones_id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $is_visible;

    /**
     * @ORM\Column(type="string", length=5)
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumn(name="countries_id", referencedColumnName="id", nullable=false)
     */
    protected $country;

    /**
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumn(name="languages_id", referencedColumnName="id", nullable=false)
     */
    protected $language;

    /**
     * @ORM\ManyToOne(targetEntity="Currency")
     * @ORM\JoinColumn(name="currencies_id", referencedColumnName="id", nullable=false)
     */
    protected $currency;

    /**
     * @ORM\ManyToOne(targetEntity="Charset")
     * @ORM\JoinColumn(name="charsets_id", referencedColumnName="id", nullable=false)
     */
    protected $charset;

    /**
     * @ORM\ManyToOne(targetEntity="Timezone")
     * @ORM\JoinColumn(name="timezones_id", referencedColumnName="id", nullable=false)
     */
    protected $timezone;

    /**
     * Instance of InputFilterInterface.
     *
     * @var InputFilter
     */
    private $_inputFilter;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Application\Entity\Locale
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
     * Set the value of countries_id.
     *
     * @param integer $countries_id
     * @return \Application\Entity\Locale
     */
    public function setCountriesId($countries_id)
    {
        $this->countries_id = $countries_id;

        return $this;
    }

    /**
     * Get the value of countries_id.
     *
     * @return integer
     */
    public function getCountriesId()
    {
        return $this->countries_id;
    }

    /**
     * Set the value of languages_id.
     *
     * @param integer $languages_id
     * @return \Application\Entity\Locale
     */
    public function setLanguagesId($languages_id)
    {
        $this->languages_id = $languages_id;

        return $this;
    }

    /**
     * Get the value of languages_id.
     *
     * @return integer
     */
    public function getLanguagesId()
    {
        return $this->languages_id;
    }

    /**
     * Set the value of currencies_id.
     *
     * @param integer $currencies_id
     * @return \Application\Entity\Locale
     */
    public function setCurrenciesId($currencies_id)
    {
        $this->currencies_id = $currencies_id;

        return $this;
    }

    /**
     * Get the value of currencies_id.
     *
     * @return integer
     */
    public function getCurrenciesId()
    {
        return $this->currencies_id;
    }

    /**
     * Set the value of charsets_id.
     *
     * @param integer $charsets_id
     * @return \Application\Entity\Locale
     */
    public function setCharsetsId($charsets_id)
    {
        $this->charsets_id = $charsets_id;

        return $this;
    }

    /**
     * Get the value of charsets_id.
     *
     * @return integer
     */
    public function getCharsetsId()
    {
        return $this->charsets_id;
    }

    /**
     * Set the value of timezones_id.
     *
     * @param integer $timezones_id
     * @return \Application\Entity\Locale
     */
    public function setTimezonesId($timezones_id)
    {
        $this->timezones_id = $timezones_id;

        return $this;
    }

    /**
     * Get the value of timezones_id.
     *
     * @return integer
     */
    public function getTimezonesId()
    {
        return $this->timezones_id;
    }

    /**
     * Set the value of is_visible.
     *
     * @param boolean $is_visible
     * @return \Application\Entity\Locale
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
     * @return \Application\Entity\Locale
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
     * Set Country entity (many to one).
     *
     * @param \Application\Entity\Country $country
     * @return \Application\Entity\Locale
     */
    public function setCountry(Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get Country entity (many to one).
     *
     * @return \Application\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set Language entity (many to one).
     *
     * @param \Application\Entity\Language $language
     * @return \Application\Entity\Locale
     */
    public function setLanguage(Language $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get Language entity (many to one).
     *
     * @return \Application\Entity\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set Currency entity (many to one).
     *
     * @param \Application\Entity\Currency $currency
     * @return \Application\Entity\Locale
     */
    public function setCurrency(Currency $currency = null)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get Currency entity (many to one).
     *
     * @return \Application\Entity\Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set Charset entity (many to one).
     *
     * @param \Application\Entity\Charset $charset
     * @return \Application\Entity\Locale
     */
    public function setCharset(Charset $charset = null)
    {
        $this->charset = $charset;

        return $this;
    }

    /**
     * Get Charset entity (many to one).
     *
     * @return \Application\Entity\Charset
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * Set Timezone entity (many to one).
     *
     * @param \Application\Entity\Timezone $timezone
     * @return \Application\Entity\Locale
     */
    public function setTimezone(Timezone $timezone = null)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get Timezone entity (many to one).
     *
     * @return \Application\Entity\Timezone
     */
    public function getTimezone()
    {
        return $this->timezone;
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
                'name' => 'countries_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'languages_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'currencies_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'charsets_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'timezones_id',
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
        $dataFields = array('id', 'countries_id', 'languages_id', 'currencies_id', 'charsets_id', 'timezones_id', 'is_visible', 'name');
        $relationFields = array('country', 'currency', 'charset', 'timezone', 'language');
        $copiedFields = array();
        foreach ($dataFields as $field) {
            if (!in_array($field, $fields) && !empty($fields)) {
                continue;
            }
            $getter = sprintf('get%s', ucfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $field)))));
            $copiedFields[$field] = $this->{$getter}();
        }
        // foreach ($relationFields as $field => $relation) {
            // $copiedFields[$field] = $relation->getArrayCopy();
        // }

        // End.
        return $copiedFields;
    }

    public function __sleep()
    {
        return array('id', 'countries_id', 'languages_id', 'currencies_id', 'charsets_id', 'timezones_id', 'is_visible', 'name');
    }
    // Custom methods //////////////////////////////////////////////////////////
}