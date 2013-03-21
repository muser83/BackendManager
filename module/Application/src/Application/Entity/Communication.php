<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

/**
 * Application\Entity\Communication
 *
 * @ORM\Entity()
 * @ORM\Table(name="communications")
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
    protected $url1;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $url2;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $url3;

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
    protected $faxe;

    /**
     * @ORM\OneToOne(targetEntity="Person", mappedBy="communication")
     * @ORM\JoinColumn(name="communications_id", referencedColumnName="id", nullable=false)
     */
    protected $person;

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
     * Set the value of url1.
     *
     * @param string $url1
     * @return \Application\Entity\Communication
     */
    public function setUrl1($url1)
    {
        $this->url1 = $url1;

        return $this;
    }

    /**
     * Get the value of url1.
     *
     * @return string
     */
    public function getUrl1()
    {
        return $this->url1;
    }

    /**
     * Set the value of url2.
     *
     * @param string $url2
     * @return \Application\Entity\Communication
     */
    public function setUrl2($url2)
    {
        $this->url2 = $url2;

        return $this;
    }

    /**
     * Get the value of url2.
     *
     * @return string
     */
    public function getUrl2()
    {
        return $this->url2;
    }

    /**
     * Set the value of url3.
     *
     * @param string $url3
     * @return \Application\Entity\Communication
     */
    public function setUrl3($url3)
    {
        $this->url3 = $url3;

        return $this;
    }

    /**
     * Get the value of url3.
     *
     * @return string
     */
    public function getUrl3()
    {
        return $this->url3;
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
     * Set the value of faxe.
     *
     * @param string $faxe
     * @return \Application\Entity\Communication
     */
    public function setFaxe($faxe)
    {
        $this->faxe = $faxe;

        return $this;
    }

    /**
     * Get the value of faxe.
     *
     * @return string
     */
    public function getFaxe()
    {
        return $this->faxe;
    }

    /**
     * Set Person entity (one to one).
     *
     * @param \Application\Entity\Person $person
     * @return \Application\Entity\Communication
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
                'name' => 'url1',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'url2',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'url3',
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
                'name' => 'faxe',
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
        return array('id', 'email', 'facebook', 'twitter', 'url1', 'url2', 'url3', 'phone', 'mobile', 'skype', 'faxe');
    }

    // Custom methods //////////////////////////////////////////////////////////
}

