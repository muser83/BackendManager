<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

/**
 * Application\Entity\Setting
 *
 * @ORM\Entity()
 * @ORM\Table(name="settings")
 */
class Setting
    implements InputFilterAwareInterface
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $lock_system_after;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $shutdown_system_after;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $default_action_uri;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="setting")
     * @ORM\JoinColumn(name="settings_id", referencedColumnName="id", nullable=false)
     */
    protected $users;

    /**
     * Instance of InputFilterInterface.
     *
     * @var InputFilter
     */
    private $_inputFilter;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Application\Entity\Setting
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
     * Set the value of lock_system_after.
     *
     * @param integer $lock_system_after
     * @return \Application\Entity\Setting
     */
    public function setLockSystemAfter($lock_system_after)
    {
        $this->lock_system_after = $lock_system_after;

        return $this;
    }

    /**
     * Get the value of lock_system_after.
     *
     * @return integer
     */
    public function getLockSystemAfter()
    {
        return $this->lock_system_after;
    }

    /**
     * Set the value of shutdown_system_after.
     *
     * @param integer $shutdown_system_after
     * @return \Application\Entity\Setting
     */
    public function setShutdownSystemAfter($shutdown_system_after)
    {
        $this->shutdown_system_after = $shutdown_system_after;

        return $this;
    }

    /**
     * Get the value of shutdown_system_after.
     *
     * @return integer
     */
    public function getShutdownSystemAfter()
    {
        return $this->shutdown_system_after;
    }

    /**
     * Set the value of default_action_uri.
     *
     * @param string $default_action_uri
     * @return \Application\Entity\Setting
     */
    public function setDefaultActionUri($default_action_uri)
    {
        $this->default_action_uri = $default_action_uri;

        return $this;
    }

    /**
     * Get the value of default_action_uri.
     *
     * @return string
     */
    public function getDefaultActionUri()
    {
        return $this->default_action_uri;
    }

    /**
     * Add User entity to collection (one to many).
     *
     * @param \Application\Entity\User $user
     * @return \Application\Entity\Setting
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Get User entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
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
                'name' => 'lock_system_after',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'shutdown_system_after',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'default_action_uri',
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
        return array('id', 'lock_system_after', 'shutdown_system_after', 'default_action_uri');
    }

    // Custom methods //////////////////////////////////////////////////////////
}

