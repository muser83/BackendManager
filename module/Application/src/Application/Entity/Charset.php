<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

/**
 * Application\Entity\Charset
 *
 * @ORM\Entity(repositoryClass="CharsetRepository")
 * @ORM\Table(name="charsets", uniqueConstraints={@ORM\UniqueConstraint(name="name_UNIQUE", columns={"name"})})
 */
class Charset
    implements InputFilterAwareInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
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
     * @ORM\OneToMany(targetEntity="Locale", mappedBy="charset")
     * @ORM\JoinColumn(name="charsets_id", referencedColumnName="id", nullable=false)
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
     * @return \Application\Entity\Charset
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
     * @return \Application\Entity\Charset
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
     * @return \Application\Entity\Charset
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
     * Add Locale entity to collection (one to many).
     *
     * @param \Application\Entity\Locale $locale
     * @return \Application\Entity\Charset
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
        $fields = get_object_vars($this);

        foreach ($data as $field => $value) {
            $setter = sprintf('set%s', ucfirst(
                str_replace(' ', '', ucwords(str_replace('_', ' ', $field)))
            ));

            if (array_key_exists($field, $fields)) {
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
     * @param array $exclude This fields will not be copied.
     * @return array
     */
    public function getArrayCopy(array $exclude = array())
    {
        $fields = get_object_vars($this);
        $copyable = array();

        foreach ($fields as $name => $value) {
            if ('_' == $name[0]) {
                // Field is private
                continue;
            }

            if (in_array($name, $exclude)) {
                // Exclude field $name
                continue;
            }

            $copyable[$name] = $value;
    }

    // End.
    return $copyable;
    }

    public function __sleep()
    {
        return array('id', 'is_visible', 'name');
    }
}