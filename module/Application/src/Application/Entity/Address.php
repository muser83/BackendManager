<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

/**
 * Application\Entity\Address
 *
 * @ORM\Entity()
 * @ORM\Table(name="addresses", indexes={@ORM\Index(name="fk_addresses_countries1_idx", columns={"countries_id"}), @ORM\Index(name="fk_addresses_provinces1_idx", columns={"provinces_id"})})
 */
class Address
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
    protected $provinces_id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $address;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    protected $postalcode;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $city;

    /**
     * @ORM\OneToOne(targetEntity="Person", mappedBy="address")
     * @ORM\JoinColumn(name="id", referencedColumnName="id", nullable=false)
     */
    protected $person;

    /**
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="addresses")
     * @ORM\JoinColumn(name="countries_id", referencedColumnName="id", nullable=false)
     */
    protected $country;

    /**
     * @ORM\ManyToOne(targetEntity="Province", inversedBy="addresses")
     * @ORM\JoinColumn(name="provinces_id", referencedColumnName="id", nullable=false)
     */
    protected $province;

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
     * @return \Application\Entity\Address
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
     * @return \Application\Entity\Address
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
     * Set the value of provinces_id.
     *
     * @param integer $provinces_id
     * @return \Application\Entity\Address
     */
    public function setProvincesId($provinces_id)
    {
        $this->provinces_id = $provinces_id;

        return $this;
    }

    /**
     * Get the value of provinces_id.
     *
     * @return integer
     */
    public function getProvincesId()
    {
        return $this->provinces_id;
    }

    /**
     * Set the value of address.
     *
     * @param string $address
     * @return \Application\Entity\Address
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of address.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of postalcode.
     *
     * @param string $postalcode
     * @return \Application\Entity\Address
     */
    public function setPostalcode($postalcode)
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    /**
     * Get the value of postalcode.
     *
     * @return string
     */
    public function getPostalcode()
    {
        return $this->postalcode;
    }

    /**
     * Set the value of city.
     *
     * @param string $city
     * @return \Application\Entity\Address
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of city.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set Person entity (one to one).
     *
     * @param \Application\Entity\Person $person
     * @return \Application\Entity\Address
     */
    public function setPerson(Person $person)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get Person entity (one to one).
     *
     * @return \Application\Entity\Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set Country entity (many to one).
     *
     * @param \Application\Entity\Country $country
     * @return \Application\Entity\Address
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
     * Set Province entity (many to one).
     *
     * @param \Application\Entity\Province $province
     * @return \Application\Entity\Address
     */
    public function setProvince(Province $province = null)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get Province entity (many to one).
     *
     * @return \Application\Entity\Province
     */
    public function getProvince()
    {
        return $this->province;
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
                'name' => 'provinces_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'address',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'postalcode',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'city',
                'required' => false,
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
     * Return a array with all fields and data.
     * Default the relations will be ignored.
     * 
     * @param array $fields
     * @return array
     */
    public function getArrayCopy(array $fields = array())
    {
        $dataFields = array('id', 'countries_id', 'provinces_id', 'address', 'postalcode', 'city');
        $relationFields = array('country', 'province');
        $copiedFields = array();
        foreach ($relationFields as $relationField) {
            $map = null;
            if (array_key_exists($relationField, $fields)) {
                $map = $fields[$relationField];
                $fields[] = $relationField;
                unset($fields[$relationField]);
            }
            if (!in_array($relationField, $fields)) {
                continue;
            }
            $getter = sprintf('get%s', ucfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $relationField)))));
            $relationEntity = $this->{$getter}();
            $copiedFields[$relationField] = (!is_null($map))
                ? $relationEntity->getArrayCopy($map)
                : $relationEntity->getArrayCopy();
            $fields = array_diff($fields, array($relationField));
        }
        foreach ($dataFields as $dataField) {
            if (!in_array($dataField, $fields) && !empty($fields)) {
                continue;
            }
            $getter = sprintf('get%s', ucfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $dataField)))));
            $copiedFields[$dataField] = $this->{$getter}();
        }

        // End.
        return $copiedFields;
    }

    public function __sleep()
    {
        return array('id', 'countries_id', 'provinces_id', 'address', 'postalcode', 'city');
    }
    // Custom methods //////////////////////////////////////////////////////////
}