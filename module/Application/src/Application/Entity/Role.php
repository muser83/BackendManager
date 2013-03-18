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
 * @ORM\Entity(repositoryClass="RoleRepository")
 * @ORM\Table(name="roles", indexes={@ORM\Index(name="fk_roles_roles1_idx", columns={"parent_id"}), @ORM\Index(name="fk_roles_settings1_idx", columns={"settings_id"})}, uniqueConstraints={@ORM\UniqueConstraint(name="name_UNIQUE", columns={"name"})})
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
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $settings_id;

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
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $roles;

    /**
     * @ORM\OneToMany(targetEntity="RolesHasResourcesHasPrivilege", mappedBy="role")
     * @ORM\JoinColumn(name="roles_id", referencedColumnName="id", nullable=false)
     */
    protected $rolesHasResourcesHasPrivileges;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="role")
     * @ORM\JoinColumn(name="roles_id", referencedColumnName="id", nullable=false)
     */
    protected $usersRelatedByRolesId;

    /**
     * @ORM\ManyToOne(targetEntity="Setting", inversedBy="roles")
     * @ORM\JoinColumn(name="settings_id", referencedColumnName="id", nullable=false)
     */
    protected $setting;

    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="roles")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $role;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="roles")
     * @ORM\JoinTable(name="users_has_roles",
     *     joinColumns={@ORM\JoinColumn(name="roles_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="users_id", referencedColumnName="id")}
     * )
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
        $this->roles = new ArrayCollection();
        $this->rolesHasResourcesHasPrivileges = new ArrayCollection();
        $this->usersRelatedByRolesId = new ArrayCollection();
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
     * Set the value of settings_id.
     *
     * @param integer $settings_id
     * @return \Application\Entity\Role
     */
    public function setSettingsId($settings_id)
    {
        $this->settings_id = $settings_id;

        return $this;
    }

    /**
     * Get the value of settings_id.
     *
     * @return integer
     */
    public function getSettingsId()
    {
        return $this->settings_id;
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
     * Add RolesHasResourcesHasPrivilege entity to collection (one to many).
     *
     * @param \Application\Entity\RolesHasResourcesHasPrivilege $rolesHasResourcesHasPrivilege
     * @return \Application\Entity\Role
     */
    public function addRolesHasResourcesHasPrivilege(RolesHasResourcesHasPrivilege $rolesHasResourcesHasPrivilege)
    {
        $this->rolesHasResourcesHasPrivileges[] = $rolesHasResourcesHasPrivilege;

        return $this;
    }

    /**
     * Get RolesHasResourcesHasPrivilege entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRolesHasResourcesHasPrivileges()
    {
        return $this->rolesHasResourcesHasPrivileges;
    }

    /**
     * Add User related by `roles_id` entity to collection (one to many).
     *
     * @param \Application\Entity\User $user
     * @return \Application\Entity\Role
     */
    public function addUserRelatedByRolesId(User $user)
    {
        $this->usersRelatedByRolesId[] = $user;

        return $this;
    }

    /**
     * Get User related by `roles_id` entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsersRelatedByRolesId()
    {
        return $this->usersRelatedByRolesId;
    }

    /**
     * Set Setting entity (many to one).
     *
     * @param \Application\Entity\Setting $setting
     * @return \Application\Entity\Role
     */
    public function setSetting(Setting $setting = null)
    {
        $this->setting = $setting;

        return $this;
    }

    /**
     * Get Setting entity (many to one).
     *
     * @return \Application\Entity\Setting
     */
    public function getSetting()
    {
        return $this->setting;
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
     * Add User entity to collection.
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
     * Get User entity collection.
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
                'name' => 'settings_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'parent_id',
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
        return array('id', 'settings_id', 'parent_id', 'is_visible', 'name', 'descr');
    }
}