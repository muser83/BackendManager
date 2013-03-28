<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

/**
 * Application\Entity\Log
 *
 * @ORM\Entity()
 * @ORM\Table(name="logs", indexes={@ORM\Index(name="fk_logs_users1_idx", columns={"users_id"}), @ORM\Index(name="fk_logs_logevents1_idx", columns={"logevents_id"})})
 */
class Log
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
    protected $logevents_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $message;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $ip_address;

    /**
     * @ORM\Column(type="string", length=9)
     */
    protected $session;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $cdate;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="users_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Logevent")
     * @ORM\JoinColumn(name="logevents_id", referencedColumnName="id", nullable=false)
     */
    protected $logevent;

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
     * @return \Application\Entity\Log
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
     * Set the value of logevents_id.
     *
     * @param integer $logevents_id
     * @return \Application\Entity\Log
     */
    public function setLogeventsId($logevents_id)
    {
        $this->logevents_id = $logevents_id;

        return $this;
    }

    /**
     * Get the value of logevents_id.
     *
     * @return integer
     */
    public function getLogeventsId()
    {
        return $this->logevents_id;
    }

    /**
     * Set the value of message.
     *
     * @param string $message
     * @return \Application\Entity\Log
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
     * Set the value of ip_address.
     *
     * @param string $ip_address
     * @return \Application\Entity\Log
     */
    public function setIpAddress($ip_address)
    {
        $this->ip_address = $ip_address;

        return $this;
    }

    /**
     * Get the value of ip_address.
     *
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ip_address;
    }

    /**
     * Set the value of session.
     *
     * @param string $session
     * @return \Application\Entity\Log
     */
    public function setSession($session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get the value of session.
     *
     * @return string
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set the value of cdate.
     *
     * @param datetime $cdate
     * @return \Application\Entity\Log
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
     * Set User entity (many to one).
     *
     * @param \Application\Entity\User $user
     * @return \Application\Entity\Log
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get User entity (many to one).
     *
     * @return \Application\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set Logevent entity (many to one).
     *
     * @param \Application\Entity\Logevent $logevent
     * @return \Application\Entity\Log
     */
    public function setLogevent(Logevent $logevent = null)
    {
        $this->logevent = $logevent;

        return $this;
    }

    /**
     * Get Logevent entity (many to one).
     *
     * @return \Application\Entity\Logevent
     */
    public function getLogevent()
    {
        return $this->logevent;
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
                'name' => 'users_id',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'logevents_id',
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
                'name' => 'ip_address',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'session',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'cdate',
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
        $dataFields = array('id', 'users_id', 'logevents_id', 'message', 'ip_address', 'session', 'cdate');
        $relationFields = array('user', 'logevent');
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
        return array('id', 'users_id', 'logevents_id', 'message', 'ip_address', 'session', 'cdate');
    }

    // Custom methods //////////////////////////////////////////////////////////

    public function write($message, Logevent $logevent, User $user = null)
    {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $session = crc32(session_id());
        $cdate = new \DateTime();

        $this->setUser($user)
            ->setLogevent($logevent)
            ->setMessage($message)
            ->setIpAddress($ipAddress)
            ->setSession($session)
            ->setCdate($cdate);

        // End.
        return $this;
    }

}

