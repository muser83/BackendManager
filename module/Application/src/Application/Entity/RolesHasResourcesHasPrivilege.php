<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

/**
 * Application\Entity\RolesHasResourcesHasPrivilege
 *
 * @ORM\Entity(repositoryClass="RolesHasResourcesHasPrivilegeRepository")
 * @ORM\Table(name="roles_has_resources_has_privileges", indexes={@ORM\Index(name="fk_roles_has_resources_has_privileges_roles1_idx", columns={"roles_id"}), @ORM\Index(name="fk_roles_has_resources_has_privileges_resources1_idx", columns={"resources_id"}), @ORM\Index(name="fk_roles_has_resources_has_privileges_privileges1_idx", columns={"privileges_id"})})
 */
class RolesHasResourcesHasPrivilege
    implements InputFilterAwareInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $roles_id;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $resources_id;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $privileges_id;

    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="rolesHasResourcesHasPrivileges")
     * @ORM\JoinColumn(name="roles_id", referencedColumnName="id", nullable=false)
     */
    protected $role;

    /**
     * @ORM\ManyToOne(targetEntity="Resource", inversedBy="rolesHasResourcesHasPrivileges")
     * @ORM\JoinColumn(name="resources_id", referencedColumnName="id", nullable=false)
     */
    protected $resource;

    /**
     * @ORM\ManyToOne(targetEntity="Privilege", inversedBy="rolesHasResourcesHasPrivileges")
     * @ORM\JoinColumn(name="privileges_id", referencedColumnName="id", nullable=false)
     */
    protected $privilege;

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
     * Set the value of roles_id.
     *
     * @param integer $roles_id
     * @return \Application\Entity\RolesHasResourcesHasPrivilege
     */
    public function setRolesId($roles_id)
    {
        $this->roles_id = $roles_id;

        return $this;
    }

    /**
     * Get the value of roles_id.
     *
     * @return integer
     */
    public function getRolesId()
    {
        return $this->roles_id;
    }

    /**
     * Set the value of resources_id.
     *
     * @param integer $resources_id
     * @return \Application\Entity\RolesHasResourcesHasPrivilege
     */
    public function setResourcesId($resources_id)
    {
        $this->resources_id = $resources_id;

        return $this;
    }

    /**
     * Get the value of resources_id.
     *
     * @return integer
     */
    public function getResourcesId()
    {
        return $this->resources_id;
    }

    /**
     * Set the value of privileges_id.
     *
     * @param integer $privileges_id
     * @return \Application\Entity\RolesHasResourcesHasPrivilege
     */
    public function setPrivilegesId($privileges_id)
    {
        $this->privileges_id = $privileges_id;

        return $this;
    }

    /**
     * Get the value of privileges_id.
     *
     * @return integer
     */
    public function getPrivilegesId()
    {
        return $this->privileges_id;
    }

    /**
     * Set Role entity (many to one).
     *
     * @param \Application\Entity\Role $role
     * @return \Application\Entity\RolesHasResourcesHasPrivilege
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
     * Set Resource entity (many to one).
     *
     * @param \Application\Entity\Resource $resource
     * @return \Application\Entity\RolesHasResourcesHasPrivilege
     */
    public function setResource(Resource $resource = null)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get Resource entity (many to one).
     *
     * @return \Application\Entity\Resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set Privilege entity (many to one).
     *
     * @param \Application\Entity\Privilege $privilege
     * @return \Application\Entity\RolesHasResourcesHasPrivilege
     */
    public function setPrivilege(Privilege $privilege = null)
    {
        $this->privilege = $privilege;

        return $this;
    }

    /**
     * Get Privilege entity (many to one).
     *
     * @return \Application\Entity\Privilege
     */
    public function getPrivilege()
    {
        return $this->privilege;
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
                'name' => 'roles_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'resources_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'privileges_id',
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
        return array('roles_id', 'resources_id', 'privileges_id');
    }
}