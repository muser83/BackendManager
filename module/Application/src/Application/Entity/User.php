<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface,
    Zend\Crypt\Password\Bcrypt,
    Zend\Math\Rand;

/**
 * Application\Entity\User
 *
 * @ORM\Entity()
 * @ORM\Table(name="users", indexes={@ORM\Index(name="fk_users_persons_idx", columns={"persons_id"}), @ORM\Index(name="fk_users_locales1_idx", columns={"locales_id"}), @ORM\Index(name="fk_users_roles1_idx", columns={"roles_id"}), @ORM\Index(name="fk_users_settings1_idx", columns={"settings_id"})}, uniqueConstraints={@ORM\UniqueConstraint(name="identity_UNIQUE", columns={"identity"}), @ORM\UniqueConstraint(name="persons_id_UNIQUE", columns={"persons_id"}), @ORM\UniqueConstraint(name="settings_id_UNIQUE", columns={"settings_id"})})
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
     * 
     * @ORM\Column(type="integer")
     */
    protected $roles_id;

    /**
     * 
     * @ORM\Column(type="integer")
     */
    protected $locales_id;

    /**
     * 
     * @ORM\Column(type="integer")
     */
    protected $persons_id;

    /**
     * 
     * @ORM\Column(type="integer")
     */
    protected $settings_id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $is_verified;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $is_active;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $identity;

    /**
     * $bcrypt->create('300609');
     *
     * @ORM\Column(type="string", length=60)
     */
    protected $credential;

    /**
     * substr(hash('sha512', '300609', 0, 22);
     *
     * @ORM\Column(type="string", length=22)
     */
    protected $salt;

    /**
     * hash('sha512', '300609');
     *
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    protected $verify_token;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $attempts;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $last_attempt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $last_active;

    /**
     * @ORM\OneToMany(targetEntity="Log", mappedBy="user")
     * @ORM\JoinColumn(name="users_id", referencedColumnName="id")
     */
    protected $logs;

    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="users")
     * @ORM\JoinColumn(name="roles_id", referencedColumnName="id", nullable=false)
     */
    protected $role;

    /**
     * @ORM\ManyToOne(targetEntity="Locale", inversedBy="users")
     * @ORM\JoinColumn(name="locales_id", referencedColumnName="id", nullable=false)
     */
    protected $locale;

    /**
     * @ORM\OneToOne(targetEntity="Person", inversedBy="user")
     * @ORM\JoinColumn(name="persons_id", referencedColumnName="id", nullable=false)
     */
    protected $person;

    /**
     * @ORM\ManyToOne(targetEntity="Setting", inversedBy="users")
     * @ORM\JoinColumn(name="settings_id", referencedColumnName="id", nullable=false)
     */
    protected $setting;

    /**
     * Instance of InputFilterInterface.
     *
     * @var InputFilter
     */
    private $_inputFilter;

    public function __construct()
    {
        $this->logs = new ArrayCollection();
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
     * Set the value of settings_id.
     *
     * @param integer $settings_id
     * @return \Application\Entity\User
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
     * Set the value of last_active.
     *
     * @param datetime $last_active
     * @return \Application\Entity\User
     */
    public function setLastActive($last_active)
    {
        $this->last_active = $last_active;

        return $this;
    }

    /**
     * Get the value of last_active.
     *
     * @return datetime
     */
    public function getLastActive()
    {
        return $this->last_active;
    }

    /**
     * Add Log entity to collection (one to many).
     *
     * @param \Application\Entity\Log $log
     * @return \Application\Entity\User
     */
    public function addLog(Log $log)
    {
        $this->logs[] = $log;

        return $this;
    }

    /**
     * Get Log entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLogs()
    {
        return $this->logs;
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
     * Set Person entity (one to one).
     *
     * @param \Application\Entity\Person $person
     * @return \Application\Entity\User
     */
    public function setPerson(Person $person = null)
    {
        $person->setUser($this);
        $this->person = $person;

        return $this;
    }

    /**
     * Get Person entity (one to one).
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
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'is_verified',
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'is_active',
                'required' => false,
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
                'required' => false,
                'filters' => array(),
                'validators' => array(),
            ),
            array(
                'name' => 'attempts',
                'required' => false,
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
                'name' => 'last_active',
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
        $dataFields = array('id', 'roles_id', 'locales_id', 'persons_id', 'settings_id', 'is_verified', 'is_active', 'identity', 'credential', 'salt', 'verify_token', 'attempts', 'last_attempt', 'last_active');
        $relationFields = array('person', 'locale', 'role', 'setting');
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
        return array('id', 'roles_id', 'locales_id', 'persons_id', 'settings_id', 'is_verified', 'is_active', 'identity', 'credential', 'salt', 'verify_token', 'attempts', 'last_attempt', 'last_active');
    }

    // Custom methods //////////////////////////////////////////////////////////

    /**
     * Salt and crypt the credential.
     * 
     * @param Users $identity
     * @return \Application\Entity\User
     */
    public function saltCredential(User $identity)
    {
        $salt = $identity->getSalt()
            ? $identity->getSalt()
            : md5(Rand::getBytes(Bcrypt::MIN_SALT_SIZE));

        $bcrypt = new Bcrypt();
        $bcrypt->setCost(15);
        $bcrypt->setSalt($salt);

        $this->credential = $bcrypt->create($this->credential);

        // End.
        return $this;
    }

    /**
     * COMMENTME
     * 
     * @return boolean
     */
    public function isLockedOut()
    {
        $lockoutTime = $this->getLockoutDateTime()->getTimestamp();
        $dt = new \DateTime();
        $now = $dt->getTimestamp();

        if (($this->attempts >= $this->getAttemptsToLockout()) && ($now <= $lockoutTime)) {
            // End.
            return true;
        }

        // End.
        return false;
    }

    /**
     * COMMENTME
     * 
     * @return integer
     */
    public function increaseAttempt()
    {
        $this->attempts += 1;

        // End.
        return $this->attempts;
    }

    /**
     * COMMENTME
     * 
     * @return InputFilterInterface
     */
    public function getAuthenticateInputFilter()
    {
        $factory = new InputFactory();
        $filters = array(
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
                'name' => 'verify_token',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
        );
        $inputFilter = $factory->createInputFilter($filters);

        // End.
        return $inputFilter;
    }

    /**
     * COMMENTME
     * 
     * @return \DateTime
     */
    public function getLockoutDateTime()
    {
        $lockoutTime = 2400;
        $dt = new \DateTime();

        if (!$this->last_attempt instanceof \DateTime) {
            $this->last_attempt = $dt;
        }

        $lastAttemptTime = $this->last_attempt->getTimestamp();
        $lockoutTime = $lastAttemptTime + ($this->attempts * ($lockoutTime / 1000));
        $dt->setTimestamp($lockoutTime);

        // End.
        return $dt;
    }

    /**
     * COMMENTME
     * 
     * @return boolean Void.
     */
    public function getAttemptsToLockout()
    {
        // End.
        return 5; // 25
    }

}
