<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

/**
 * Application\Entity\Communication
 *
 * @ORM\Entity(repositoryClass="CommunicationRepository")
 * @ORM\Table(name="communication")
 */
class Communication
    implements InputFilterAwareInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $facebook;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $twitter;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $uri1;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $uri2;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $uri3;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $phone;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $mobile;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $skype;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $fax;

    /**
     * @ORM\ManyToMany(targetEntity="Address", inversedBy="communications")
     * @ORM\JoinTable(name="persons",
     *     joinColumns={@ORM\JoinColumn(name="communication_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="addresses_id", referencedColumnName="id")}
     * )
     */
    protected $addresses;

    /**
     * Instance of InputFilterInterface.
     *
     * @var InputFilter
     */
    private $_inputFilter;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Application\Entity\Communication
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
     * Set the value of email.
     *
     * @param string $email
     * @return \Application\Entity\Communication
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of facebook.
     *
     * @param string $facebook
     * @return \Application\Entity\Communication
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get the value of facebook.
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set the value of twitter.
     *
     * @param string $twitter
     * @return \Application\Entity\Communication
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get the value of twitter.
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set the value of uri1.
     *
     * @param string $uri1
     * @return \Application\Entity\Communication
     */
    public function setUri1($uri1)
    {
        $this->uri1 = $uri1;

        return $this;
    }

    /**
     * Get the value of uri1.
     *
     * @return string
     */
    public function getUri1()
    {
        return $this->uri1;
    }

    /**
     * Set the value of uri2.
     *
     * @param string $uri2
     * @return \Application\Entity\Communication
     */
    public function setUri2($uri2)
    {
        $this->uri2 = $uri2;

        return $this;
    }

    /**
     * Get the value of uri2.
     *
     * @return string
     */
    public function getUri2()
    {
        return $this->uri2;
    }

    /**
     * Set the value of uri3.
     *
     * @param string $uri3
     * @return \Application\Entity\Communication
     */
    public function setUri3($uri3)
    {
        $this->uri3 = $uri3;

        return $this;
    }

    /**
     * Get the value of uri3.
     *
     * @return string
     */
    public function getUri3()
    {
        return $this->uri3;
    }

    /**
     * Set the value of phone.
     *
     * @param string $phone
     * @return \Application\Entity\Communication
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of phone.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of mobile.
     *
     * @param string $mobile
     * @return \Application\Entity\Communication
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get the value of mobile.
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set the value of skype.
     *
     * @param string $skype
     * @return \Application\Entity\Communication
     */
    public function setSkype($skype)
    {
        $this->skype = $skype;

        return $this;
    }

    /**
     * Get the value of skype.
     *
     * @return string
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * Set the value of fax.
     *
     * @param string $fax
     * @return \Application\Entity\Communication
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get the value of fax.
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Add Address entity to collection.
     *
     * @param \Application\Entity\Address $address
     * @return \Application\Entity\Communication
     */
    public function addAddress(Address $address)
    {
        $this->addresses[] = $address;

        return $this;
    }

    /**
     * Get Address entity collection.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAddresses()
    {
        return $this->addresses;
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
                'name' => 'email',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'facebook',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'twitter',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'uri1',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'uri2',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'uri3',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'phone',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'mobile',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'skype',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'fax',
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
        return array('id', 'email', 'facebook', 'twitter', 'uri1', 'uri2', 'uri3', 'phone', 'mobile', 'skype', 'fax');
    }
}