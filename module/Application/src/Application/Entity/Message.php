<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

/**
 * Application\Entity\Message
 *
 * @ORM\Entity()
 * @ORM\Table(name="messages", indexes={@ORM\Index(name="fk_messages_persons1_idx", columns={"to_persons_id"}), @ORM\Index(name="fk_messages_persons2_idx", columns={"from_persons_id"})})
 */
class Message
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
    protected $to_persons_id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $is_read;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $is_trash;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $is_deleted;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $subject;

    /**
     * @ORM\Column(type="text")
     */
    protected $message;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $cdate;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="messagesRelatedByToPersonsId")
     * @ORM\JoinColumn(name="to_persons_id", referencedColumnName="id", nullable=false)
     */
    protected $personRelatedByToPersonsId;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="messagesRelatedByFromPersonsId")
     * @ORM\JoinColumn(name="from_persons_id", referencedColumnName="id")
     */
    protected $personRelatedByFromPersonsId;

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
     * @return \Application\Entity\Message
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
     * Set the value of to_persons_id.
     *
     * @param integer $to_persons_id
     * @return \Application\Entity\Message
     */
    public function setToPersonsId($to_persons_id)
    {
        $this->to_persons_id = $to_persons_id;

        return $this;
    }

    /**
     * Get the value of to_persons_id.
     *
     * @return integer
     */
    public function getToPersonsId()
    {
        return $this->to_persons_id;
    }

    /**
     * Set the value of is_read.
     *
     * @param boolean $is_read
     * @return \Application\Entity\Message
     */
    public function setIsRead($is_read)
    {
        $this->is_read = $is_read;

        return $this;
    }

    /**
     * Get the value of is_read.
     *
     * @return boolean
     */
    public function getIsRead()
    {
        return $this->is_read;
    }

    /**
     * Set the value of is_trash.
     *
     * @param boolean $is_trash
     * @return \Application\Entity\Message
     */
    public function setIsTrash($is_trash)
    {
        $this->is_trash = $is_trash;

        return $this;
    }

    /**
     * Get the value of is_trash.
     *
     * @return boolean
     */
    public function getIsTrash()
    {
        return $this->is_trash;
    }

    /**
     * Set the value of is_deleted.
     *
     * @param boolean $is_deleted
     * @return \Application\Entity\Message
     */
    public function setIsDeleted($is_deleted)
    {
        $this->is_deleted = $is_deleted;

        return $this;
    }

    /**
     * Get the value of is_deleted.
     *
     * @return boolean
     */
    public function getIsDeleted()
    {
        return $this->is_deleted;
    }

    /**
     * Set the value of subject.
     *
     * @param string $subject
     * @return \Application\Entity\Message
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get the value of subject.
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set the value of message.
     *
     * @param string $message
     * @return \Application\Entity\Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of cdate.
     *
     * @param datetime $cdate
     * @return \Application\Entity\Message
     */
    public function setCdate($cdate)
    {
        $this->cdate = $cdate;

        return $this;
    }

    /**
     * Get the value of cdate.
     *
     * @return datetime
     */
    public function getCdate()
    {
        return $this->cdate;
    }

    /**
     * Set Person related by `to_persons_id` entity (many to one).
     *
     * @param \Application\Entity\Person $person
     * @return \Application\Entity\Message
     */
    public function setPersonRelatedByToPersonsId(Person $person = null)
    {
        $this->personRelatedByToPersonsId = $person;

        return $this;
    }

    /**
     * Get Person related by `to_persons_id` entity (many to one).
     *
     * @return \Application\Entity\Person
     */
    public function getPersonRelatedByToPersonsId()
    {
        return $this->personRelatedByToPersonsId;
    }

    /**
     * Set Person related by `from_persons_id` entity (many to one).
     *
     * @param \Application\Entity\Person $person
     * @return \Application\Entity\Message
     */
    public function setPersonRelatedByFromPersonsId(Person $person = null)
    {
        $this->personRelatedByFromPersonsId = $person;

        return $this;
    }

    /**
     * Get Person related by `from_persons_id` entity (many to one).
     *
     * @return \Application\Entity\Person
     */
    public function getPersonRelatedByFromPersonsId()
    {
        return $this->personRelatedByFromPersonsId;
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
                'name' => 'to_persons_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'from_persons_id',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'is_read',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'is_trash',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'is_deleted',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'subject',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'message',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'cdate',
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
        return array('id', 'to_persons_id', 'from_persons_id', 'is_read', 'is_trash', 'is_deleted', 'subject', 'message', 'cdate');
    }

    // Custom methods //////////////////////////////////////////////////////////
}

