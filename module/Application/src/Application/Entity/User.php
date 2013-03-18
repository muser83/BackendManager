<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

/**
 * Application\Entity\User
 *
 * @ORM\Entity(repositoryClass="UserRepository")
 * @ORM\Table(name="users", indexes={@ORM\Index(name="fk_users_locales1_idx", columns={"locales_id"}), @ORM\Index(name="fk_users_persons1_idx", columns={"persons_id"}), @ORM\Index(name="fk_users_settings1_idx", columns={"settings_id"}), @ORM\Index(name="fk_users_roles1_idx", columns={"roles_id"})}, uniqueConstraints={@ORM\UniqueConstraint(name="identity_UNIQUE", columns={"identity"})})
 */
class User
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
    protected $roles_id;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $locales_id;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $persons_id;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $is_verified;

    /**
     * If false (0) the user is not allowed to authenticate.
     *
     * @ORM\Column(type="boolean")
     */
    protected $is_active;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $identity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $credential;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $salt;

    /**
     * @ORM\Column(type="string", length=25)
     */
    protected $verify_token;

    /**
     * @ORM\Column(type="integer")
     */
    protected $attempts;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $last_attempt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $last_login;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="user")
     * @ORM\JoinColumn(name="users_id", referencedColumnName="id", nullable=false)
     */
    protected $messages;

    /**
     * @ORM\OneToMany(targetEntity="UsersHasResource", mappedBy="user")
     * @ORM\JoinColumn(name="users_id", referencedColumnName="id", nullable=false)
     */
    protected $usersHasResources;

    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="usersRelatedByRolesId")
     * @ORM\JoinColumn(name="roles_id", referencedColumnName="id", nullable=false)
     */
    protected $role;

    /**
     * @ORM\ManyToOne(targetEntity="Locale", inversedBy="users")
     * @ORM\JoinColumn(name="locales_id", referencedColumnName="id", nullable=false)
     */
    protected $locale;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="users")
     * @ORM\JoinColumn(name="persons_id", referencedColumnName="id", nullable=false)
     */
    protected $person;

    /**
     * @ORM\ManyToOne(targetEntity="Setting", inversedBy="users")
     * @ORM\JoinColumn(name="settings_id", referencedColumnName="id")
     */
    protected $setting;

    /**
     * @ORM\ManyToMany(targetEntity="Priority", mappedBy="users")
     */
    protected $priorities;

    /**
     * @ORM\ManyToMany(targetEntity="Role", mappedBy="users")
     */
    protected $roles;

    /**
     * Instance of InputFilterInterface.
     *
     * @var InputFilter
     */
    private $_inputFilter;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->usersHasResources = new ArrayCollection();
        $this->priorities = new ArrayCollection();
        $this->roles = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Application\Entity\User
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
     * Set the value of roles_id.
     *
     * @param integer $roles_id
     * @return \Application\Entity\User
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
     * Set the value of locales_id.
     *
     * @param integer $locales_id
     * @return \Application\Entity\User
     */
    public function setLocalesId($locales_id)
    {
        $this->locales_id = $locales_id;

        return $this;
    }

    /**
     * Get the value of locales_id.
     *
     * @return integer
     */
    public function getLocalesId()
    {
        return $this->locales_id;
    }

    /**
     * Set the value of persons_id.
     *
     * @param integer $persons_id
     * @return \Application\Entity\User
     */
    public function setPersonsId($persons_id)
    {
        $this->persons_id = $persons_id;

        return $this;
    }

    /**
     * Get the value of persons_id.
     *
     * @return integer
     */
    public function getPersonsId()
    {
        return $this->persons_id;
    }

    /**
     * Set the value of is_verified.
     *
     * @param boolean $is_verified
     * @return \Application\Entity\User
     */
    public function setIsVerified($is_verified)
    {
        $this->is_verified = $is_verified;

        return $this;
    }

    /**
     * Get the value of is_verified.
     *
     * @return boolean
     */
    public function getIsVerified()
    {
        return $this->is_verified;
    }

    /**
     * Set the value of is_active.
     *
     * @param boolean $is_active
     * @return \Application\Entity\User
     */
    public function setIsActive($is_active)
    {
        $this->is_active = $is_active;

        return $this;
    }

    /**
     * Get the value of is_active.
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Set the value of identity.
     *
     * @param string $identity
     * @return \Application\Entity\User
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;

        return $this;
    }

    /**
     * Get the value of identity.
     *
     * @return string
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * Set the value of credential.
     *
     * @param string $credential
     * @return \Application\Entity\User
     */
    public function setCredential($credential)
    {
        $this->credential = $credential;

        return $this;
    }

    /**
     * Get the value of credential.
     *
     * @return string
     */
    public function getCredential()
    {
        return $this->credential;
    }

    /**
     * Set the value of salt.
     *
     * @param string $salt
     * @return \Application\Entity\User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get the value of salt.
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set the value of verify_token.
     *
     * @param string $verify_token
     * @return \Application\Entity\User
     */
    public function setVerifyToken($verify_token)
    {
        $this->verify_token = $verify_token;

        return $this;
    }

    /**
     * Get the value of verify_token.
     *
     * @return string
     */
    public function getVerifyToken()
    {
        return $this->verify_token;
    }

    /**
     * Set the value of attempts.
     *
     * @param integer $attempts
     * @return \Application\Entity\User
     */
    public function setAttempts($attempts)
    {
        $this->attempts = $attempts;

        return $this;
    }

    /**
     * Get the value of attempts.
     *
     * @return integer
     */
    public function getAttempts()
    {
        return $this->attempts;
    }

    /**
     * Set the value of last_attempt.
     *
     * @param datetime $last_attempt
     * @return \Application\Entity\User
     */
    public function setLastAttempt($last_attempt)
    {
        $this->last_attempt = $last_attempt;

        return $this;
    }

    /**
     * Get the value of last_attempt.
     *
     * @return datetime
     */
    public function getLastAttempt()
    {
        return $this->last_attempt;
    }

    /**
     * Set the value of last_login.
     *
     * @param datetime $last_login
     * @return \Application\Entity\User
     */
    public function setLastLogin($last_login)
    {
        $this->last_login = $last_login;

        return $this;
    }

    /**
     * Get the value of last_login.
     *
     * @return datetime
     */
    public function getLastLogin()
    {
        return $this->last_login;
    }

    /**
     * Add Message entity to collection (one to many).
     *
     * @param \Application\Entity\Message $message
     * @return \Application\Entity\User
     */
    public function addMessage(Message $message)
    {
        $this->messages[] = $message;

        return $this;
    }

    /**
     * Get Message entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Add UsersHasResource entity to collection (one to many).
     *
     * @param \Application\Entity\UsersHasResource $usersHasResource
     * @return \Application\Entity\User
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
     * Set Role entity (many to one).
     *
     * @param \Application\Entity\Role $role
     * @return \Application\Entity\User
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
     * Set Locale entity (many to one).
     *
     * @param \Application\Entity\Locale $locale
     * @return \Application\Entity\User
     */
    public function setLocale(Locale $locale = null)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get Locale entity (many to one).
     *
     * @return \Application\Entity\Locale
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set Person entity (many to one).
     *
     * @param \Application\Entity\Person $person
     * @return \Application\Entity\User
     */
    public function setPerson(Person $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get Person entity (many to one).
     *
     * @return \Application\Entity\Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set Setting entity (many to one).
     *
     * @param \Application\Entity\Setting $setting
     * @return \Application\Entity\User
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
     * Add Priority entity to collection.
     *
     * @param \Application\Entity\Priority $priority
     * @return \Application\Entity\User
     */
    public function addPriority(Priority $priority)
    {
        $this->priorities[] = $priority;

        return $this;
    }

    /**
     * Get Priority entity collection.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPriorities()
    {
        return $this->priorities;
    }

    /**
     * Add Role entity to collection.
     *
     * @param \Application\Entity\Role $role
     * @return \Application\Entity\User
     */
    public function addRole(Role $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * Get Role entity collection.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoles()
    {
        return $this->roles;
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
                'name' => 'roles_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'locales_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'persons_id',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'settings_id',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'is_verified',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'is_active',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'identity',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'credential',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'salt',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'verify_token',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'attempts',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'last_attempt',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'last_login',
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
        return array('id', 'roles_id', 'locales_id', 'persons_id', 'settings_id', 'is_verified', 'is_active', 'identity', 'credential', 'salt', 'verify_token', 'attempts', 'last_attempt', 'last_login');
    }
}