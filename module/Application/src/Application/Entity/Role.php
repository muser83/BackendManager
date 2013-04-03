<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

/**
 * Application\Entity\Role
 *
 * @ORM\Entity()
 * @ORM\Table(name="roles", indexes={@ORM\Index(name="fk_roles_roles1_idx", columns={"parent_roles_id"})}, uniqueConstraints={@ORM\UniqueConstraint(name="name_UNIQUE", columns={"name"})})
 */
class Role
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $descr;

    /**
     * @ORM\OneToMany(targetEntity="Role", mappedBy="role")
     * @ORM\JoinColumn(name="parent_roles_id", referencedColumnName="id")
     */
    protected $roles;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="role")
     * @ORM\JoinColumn(name="roles_id", referencedColumnName="id", nullable=false)
     */
    protected $users;

    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="roles")
     * @ORM\JoinColumn(name="parent_roles_id", referencedColumnName="id")
     */
    protected $role;

    /**
     * Instance of InputFilterInterface.
     *
     * @var InputFilter
     */
    private $_inputFilter;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Application\Entity\Role
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
     * @return \Application\Entity\Role
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
     * @return \Application\Entity\Role
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
     * Set the value of descr.
     *
     * @param string $descr
     * @return \Application\Entity\Role
     */
    public function setDescr($descr)
    {
        $this->descr = $descr;

        return $this;
    }

    /**
     * Get the value of descr.
     *
     * @return string
     */
    public function getDescr()
    {
        return $this->descr;
    }

    /**
     * Add Role entity to collection (one to many).
     *
     * @param \Application\Entity\Role $role
     * @return \Application\Entity\Role
     */
    public function addRole(Role $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * Get Role entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Add User entity to collection (one to many).
     *
     * @param \Application\Entity\User $user
     * @return \Application\Entity\Role
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
     * Set Role entity (many to one).
     *
     * @param \Application\Entity\Role $role
     * @return \Application\Entity\Role
     */
    public function setRole(Role $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get Role entity (many to one).
     *
     * @return \Application\Entity\Role
     */
    public function getRole()
    {
        return $this->role;
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
                'name' => 'parent_roles_id',
                'required' => false,
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
                'name' => 'descr',
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
        $dataFields = array('id', 'parent_roles_id', 'is_visible', 'name', 'descr');
        $relationFields = array('role');
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
        return array('id', 'parent_roles_id', 'is_visible', 'name', 'descr');
    }
    // Custom methods //////////////////////////////////////////////////////////
}