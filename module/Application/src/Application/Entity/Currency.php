<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

/**
 * Application\Entity\Currency
 *
 * @ORM\Entity()
 * @ORM\Table(name="currencies", uniqueConstraints={@ORM\UniqueConstraint(name="name_UNIQUE", columns={"name"}), @ORM\UniqueConstraint(name="iso4217_UNIQUE", columns={"iso4217"})})
 */
class Currency
    implements InputFilterAwareInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $is_visible;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=3)
     */
    protected $iso4217;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    protected $symbol;

    /**
     * @ORM\OneToMany(targetEntity="Locale", mappedBy="currency")
     * @ORM\JoinColumn(name="currencies_id", referencedColumnName="id", nullable=false)
     */
    protected $locales;

    /**
     * Instance of InputFilterInterface.
     *
     * @var InputFilter
     */
    private $_inputFilter;

    public function __construct()
    {
        $this->locales = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Application\Entity\Currency
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
     * Set the value of is_visible.
     *
     * @param boolean $is_visible
     * @return \Application\Entity\Currency
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
     * @return \Application\Entity\Currency
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
     * Set the value of iso4217.
     *
     * @param string $iso4217
     * @return \Application\Entity\Currency
     */
    public function setIso4217($iso4217)
    {
        $this->iso4217 = $iso4217;

        return $this;
    }

    /**
     * Get the value of iso4217.
     *
     * @return string
     */
    public function getIso4217()
    {
        return $this->iso4217;
    }

    /**
     * Set the value of symbol.
     *
     * @param string $symbol
     * @return \Application\Entity\Currency
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * Get the value of symbol.
     *
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * Add Locale entity to collection (one to many).
     *
     * @param \Application\Entity\Locale $locale
     * @return \Application\Entity\Currency
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
                'name' => 'iso4217',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'symbol',
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
        $dataFields = array('id', 'is_visible', 'name', 'iso4217', 'symbol');
        $relationFields = array();
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
        return array('id', 'is_visible', 'name', 'iso4217', 'symbol');
    }
    // Custom methods //////////////////////////////////////////////////////////
}