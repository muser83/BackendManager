<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

/**
 * Application\Entity\Resource
 *
 * @ORM\Entity(repositoryClass="ResourceRepository")
 * @ORM\Table(name="resources", uniqueConstraints={@ORM\UniqueConstraint(name="name_UNIQUE", columns={"name"})})
 */
class Resource
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
    protected $is_navigation;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $label;

    /**
     * Use a underscore as separator.\nReplace the separator with an / to create an
     * URL.
     *
     * @ORM\Column(type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $module;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $controller;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $linktype;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $route;

    /**
     * @ORM\OneToMany(targetEntity="RolesHasResourcesHasPrivilege", mappedBy="resource")
     * @ORM\JoinColumn(name="resources_id", referencedColumnName="id", nullable=false)
     */
    protected $rolesHasResourcesHasPrivileges;

    /**
     * @ORM\OneToMany(targetEntity="UsersHasResource", mappedBy="resource")
     * @ORM\JoinColumn(name="resources_id", referencedColumnName="id", nullable=false)
     */
    protected $usersHasResources;

    /**
     * @ORM\ManyToMany(targetEntity="Privilege", mappedBy="resources")
     */
    protected $privileges;

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
        $this->privileges = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Application\Entity\Resource
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
     * Set the value of is_navigation.
     *
     * @param boolean $is_navigation
     * @return \Application\Entity\Resource
     */
    public function setIsNavigation($is_navigation)
    {
        $this->is_navigation = $is_navigation;

        return $this;
    }

    /**
     * Get the value of is_navigation.
     *
     * @return boolean
     */
    public function getIsNavigation()
    {
        return $this->is_navigation;
    }

    /**
     * Set the value of label.
     *
     * @param string $label
     * @return \Application\Entity\Resource
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get the value of label.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return \Application\Entity\Resource
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
     * Set the value of module.
     *
     * @param string $module
     * @return \Application\Entity\Resource
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get the value of module.
     *
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set the value of controller.
     *
     * @param string $controller
     * @return \Application\Entity\Resource
     */
    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * Get the value of controller.
     *
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set the value of title.
     *
     * @param string $title
     * @return \Application\Entity\Resource
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of linktype.
     *
     * @param string $linktype
     * @return \Application\Entity\Resource
     */
    public function setLinktype($linktype)
    {
        $this->linktype = $linktype;

        return $this;
    }

    /**
     * Get the value of linktype.
     *
     * @return string
     */
    public function getLinktype()
    {
        return $this->linktype;
    }

    /**
     * Set the value of route.
     *
     * @param string $route
     * @return \Application\Entity\Resource
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get the value of route.
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Add RolesHasResourcesHasPrivilege entity to collection (one to many).
     *
     * @param \Application\Entity\RolesHasResourcesHasPrivilege $rolesHasResourcesHasPrivilege
     * @return \Application\Entity\Resource
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
     * @return \Application\Entity\Resource
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
     * Add Privilege entity to collection.
     *
     * @param \Application\Entity\Privilege $privilege
     * @return \Application\Entity\Resource
     */
    public function addPrivilege(Privilege $privilege)
    {
        $this->privileges[] = $privilege;

        return $this;
    }

    /**
     * Get Privilege entity collection.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrivileges()
    {
        return $this->privileges;
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
                'name' => 'is_navigation',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'label',
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
                'name' => 'module',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'controller',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'title',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'linktype',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'route',
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
        return array('id', 'is_navigation', 'label', 'name', 'module', 'controller', 'title', 'linktype', 'route');
    }
}