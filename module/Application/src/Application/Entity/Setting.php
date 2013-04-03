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
     * If true a load mask will be showed while loading components.
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $use_loadmask;

    /**
     * Lock the system after x minutes.
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $lock_system_after;

    /**
     * Shutdown the system after x minutes.
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $shutdown_system_after;

    /**
     * Load and show by default x records.
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $rows_in_grid;

    /**
     * This uri will be loaded if the application uri is empty.
     *
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
     * Set the value of use_loadmask.
     *
     * @param boolean $use_loadmask
     * @return \Application\Entity\Setting
     */
    public function setUseLoadmask($use_loadmask)
    {
        $this->use_loadmask = $use_loadmask;

        return $this;
    }

    /**
     * Get the value of use_loadmask.
     *
     * @return boolean
     */
    public function getUseLoadmask()
    {
        return $this->use_loadmask;
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
     * Set the value of rows_in_grid.
     *
     * @param integer $rows_in_grid
     * @return \Application\Entity\Setting
     */
    public function setRowsInGrid($rows_in_grid)
    {
        $this->rows_in_grid = $rows_in_grid;

        return $this;
    }

    /**
     * Get the value of rows_in_grid.
     *
     * @return integer
     */
    public function getRowsInGrid()
    {
        return $this->rows_in_grid;
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
                'name' => 'use_loadmask',
                'required' => false,
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
                'name' => 'rows_in_grid',
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
     * Return a array with all fields and data.
     * Default the relations will be ignored.
     * 
     * @param array $fields
     * @return array
     */
    public function getArrayCopy(array $fields = array())
    {
        $dataFields = array('id', 'use_loadmask', 'lock_system_after', 'shutdown_system_after', 'rows_in_grid', 'default_action_uri');
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
        return array('id', 'use_loadmask', 'lock_system_after', 'shutdown_system_after', 'rows_in_grid', 'default_action_uri');
    }
    // Custom methods //////////////////////////////////////////////////////////
}