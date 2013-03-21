<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

/**
 * Application\Entity\Person
 *
 * @ORM\Entity()
 * @ORM\Table(name="persons", indexes={@ORM\Index(name="fk_persons_addresses1_idx", columns={"addresses_id"}), @ORM\Index(name="fk_persons_communications1_idx", columns={"communications_id"})}, uniqueConstraints={@ORM\UniqueConstraint(name="communications_id_UNIQUE", columns={"communications_id"}), @ORM\UniqueConstraint(name="addresses_id_UNIQUE", columns={"addresses_id"})})
 */
class Person
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
    protected $addresses_id;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $communications_id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    protected $middlename;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $lastname;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $gender;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $birthday;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="person")
     * @ORM\JoinColumn(name="to_persons_id", referencedColumnName="id", nullable=false)
     */
    protected $messagesRelatedByToPersonsId;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="person")
     * @ORM\JoinColumn(name="from_persons_id", referencedColumnName="id")
     */
    protected $messagesRelatedByFromPersonsId;

    /**
     * @ORM\OneToOne(targetEntity="User", mappedBy="person")
     * @ORM\JoinColumn(name="persons_id", referencedColumnName="id", nullable=false)
     */
    protected $user;

    /**
     * @ORM\OneToOne(targetEntity="Address", inversedBy="person")
     * @ORM\JoinColumn(name="addresses_id", referencedColumnName="id", nullable=false)
     */
    protected $address;

    /**
     * @ORM\OneToOne(targetEntity="Communication", inversedBy="person")
     * @ORM\JoinColumn(name="communications_id", referencedColumnName="id", nullable=false)
     */
    protected $communication;

    /**
     * Instance of InputFilterInterface.
     *
     * @var InputFilter
     */
    private $_inputFilter;

    public function __construct()
    {
        $this->messagesRelatedByToPersonsId = new ArrayCollection();
        $this->messagesRelatedByFromPersonsId = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Application\Entity\Person
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
     * Set the value of addresses_id.
     *
     * @param integer $addresses_id
     * @return \Application\Entity\Person
     */
    public function setAddressesId($addresses_id)
    {
        $this->addresses_id = $addresses_id;

        return $this;
    }

    /**
     * Get the value of addresses_id.
     *
     * @return integer
     */
    public function getAddressesId()
    {
        return $this->addresses_id;
    }

    /**
     * Set the value of communications_id.
     *
     * @param integer $communications_id
     * @return \Application\Entity\Person
     */
    public function setCommunicationsId($communications_id)
    {
        $this->communications_id = $communications_id;

        return $this;
    }

    /**
     * Get the value of communications_id.
     *
     * @return integer
     */
    public function getCommunicationsId()
    {
        return $this->communications_id;
    }

    /**
     * Set the value of firstname.
     *
     * @param string $firstname
     * @return \Application\Entity\Person
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of firstname.
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of middlename.
     *
     * @param string $middlename
     * @return \Application\Entity\Person
     */
    public function setMiddlename($middlename)
    {
        $this->middlename = $middlename;

        return $this;
    }

    /**
     * Get the value of middlename.
     *
     * @return string
     */
    public function getMiddlename()
    {
        return $this->middlename;
    }

    /**
     * Set the value of lastname.
     *
     * @param string $lastname
     * @return \Application\Entity\Person
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of lastname.
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of gender.
     *
     * @param boolean $gender
     * @return \Application\Entity\Person
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of gender.
     *
     * @return boolean
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of birthday.
     *
     * @param datetime $birthday
     * @return \Application\Entity\Person
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get the value of birthday.
     *
     * @return datetime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Add Message related by `to_persons_id` entity to collection (one to many).
     *
     * @param \Application\Entity\Message $message
     * @return \Application\Entity\Person
     */
    public function addMessageRelatedByToPersonsId(Message $message)
    {
        $this->messagesRelatedByToPersonsId[] = $message;

        return $this;
    }

    /**
     * Get Message related by `to_persons_id` entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessagesRelatedByToPersonsId()
    {
        return $this->messagesRelatedByToPersonsId;
    }

    /**
     * Add Message related by `from_persons_id` entity to collection (one to many).
     *
     * @param \Application\Entity\Message $message
     * @return \Application\Entity\Person
     */
    public function addMessageRelatedByFromPersonsId(Message $message)
    {
        $this->messagesRelatedByFromPersonsId[] = $message;

        return $this;
    }

    /**
     * Get Message related by `from_persons_id` entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessagesRelatedByFromPersonsId()
    {
        return $this->messagesRelatedByFromPersonsId;
    }

    /**
     * Set User entity (one to one).
     *
     * @param \Application\Entity\User $user
     * @return \Application\Entity\Person
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get User entity (one to one).
     *
     * @return \Application\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set Address entity (one to one).
     *
     * @param \Application\Entity\Address $address
     * @return \Application\Entity\Person
     */
    public function setAddress(Address $address = null)
    {
        $address->setPerson($this);
        $this->address = $address;

        return $this;
    }

    /**
     * Get Address entity (one to one).
     *
     * @return \Application\Entity\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set Communication entity (one to one).
     *
     * @param \Application\Entity\Communication $communication
     * @return \Application\Entity\Person
     */
    public function setCommunication(Communication $communication = null)
    {
        $communication->setPerson($this);
        $this->communication = $communication;

        return $this;
    }

    /**
     * Get Communication entity (one to one).
     *
     * @return \Application\Entity\Communication
     */
    public function getCommunication()
    {
        return $this->communication;
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
                'name' => 'addresses_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'communications_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'firstname',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'middlename',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'lastname',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'gender',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'birthday',
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
        return array('id', 'addresses_id', 'communications_id', 'firstname', 'middlename', 'lastname', 'gender', 'birthday');
    }

    // Custom methods //////////////////////////////////////////////////////////
}

