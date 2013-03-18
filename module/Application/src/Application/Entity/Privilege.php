<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

/**
 * Application\Entity\Privilege
 *
 * @ORM\Entity(repositoryClass="PrivilegeRepository")
 * @ORM\Table(name="privileges", uniqueConstraints={@ORM\UniqueConstraint(name="name_UNIQUE", columns={"name"})})
 */
class Privilege
    implements InputFilterAwareInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $is_visible;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    protected $icon;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $descr;

    /**
     * @ORM\OneToMany(targetEntity="RolesHasResourcesHasPrivilege", mappedBy="privilege")
     * @ORM\JoinColumn(name="privileges_id", referencedColumnName="id", nullable=false)
     */
    protected $rolesHasResourcesHasPrivileges;

    /**
     * @ORM\OneToMany(targetEntity="UsersHasResource", mappedBy="privilege")
     * @ORM\JoinColumn(name="privileges_id", referencedColumnName="id", nullable=false)
     */
    protected $usersHasResources;

    /**
     * @ORM\ManyToMany(targetEntity="Resource", inversedBy="privileges")
     * @ORM\JoinTable(name="resources_has_privileges",
     *     joinColumns={@ORM\JoinColumn(name="privileges_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="resources_id", referencedColumnName="id")}
     * )
     */
    protected $resources;

    /**
     * Instance of InputFilterInterface.
     *
     * @var InputFilter
     */
    private $_inputFilter;

    public function __construct()
    {
        $this->rolesHasResourcesHasPrivileges = new ArrayCollection();
        $this->usersHasResources = new ArrayCollection();
        $this->resources = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Application\Entity\Privilege
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
     * @return \Application\Entity\Privilege
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
     * @return \Application\Entity\Privilege
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
     * Set the value of icon.
     *
     * @param string $icon
     * @return \Application\Entity\Privilege
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get the value of icon.
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set the value of descr.
     *
     * @param string $descr
     * @return \Application\Entity\Privilege
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
     * Add RolesHasResourcesHasPrivilege entity to collection (one to many).
     *
     * @param \Application\Entity\RolesHasResourcesHasPrivilege $rolesHasResourcesHasPrivilege
     * @return \Application\Entity\Privilege
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
     * Add UsersHasResource entity to collection (one to many).
     *
     * @param \Application\Entity\UsersHasResource $usersHasResource
     * @return \Application\Entity\Privilege
     */
    public function addUsersHasResource(UsersHasResource $usersHasResource)
    {
        $this->usersHasResources[] = $usersHasResource;

        return $this;
    }

    /**
     * Get UsersHasResource entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsersHasResources()
    {
        return $this->usersHasResources;
    }

    /**
     * Add Resource entity to collection.
     *
     * @param \Application\Entity\Resource $resource
     * @return \Application\Entity\Privilege
     */
    public function addResource(Resource $resource)
    {
        $this->resources[] = $resource;

        return $this;
    }

    /**
     * Get Resource entity collection.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResources()
    {
        return $this->resources;
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
                'name' => 'is_visible',
                'required' => true,
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
                'name' => 'icon',
                'required' => false,
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
        return array('id', 'is_visible', 'name', 'icon', 'descr');
    }
}