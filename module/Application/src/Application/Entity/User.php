<?php

/**
 * User.php
 * Created on Nov 18, 2012 11:55:30 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   license.wittestier.nl
 * @copyright 2013 WitteStier - copyright.wittestier.nl
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM,
    Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface,
    Zend\Crypt\Password\Bcrypt,
    Zend\Math\Rand;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
    implements InputFilterAwareInterface
{
    /**
     * Allowed attempts before lockout.
     */

    const ATTEMPTS_TO_LOCKOUT = 5; // 25

    /**
     * Lockout time in miliseconds.
     * The total lockout time will be (attempts * lockout time.)
     * Notice that attempts >= self::ATTEMPTS_TO_LOCKOUT
     */
    const LOCKOUT_TIME = 2400;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $roles_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $locales_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $persons_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $settings_id;

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
     * @ORM\ManyToOne(targetEntity="Locale", inversedBy="users")
     * @ORM\JoinColumn(name="locales_id", referencedColumnName="id", nullable=false)
     */
//    protected $locale;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="users")
     * @ORM\JoinColumn(name="persons_id", referencedColumnName="id", nullable=false)
     */
//    protected $person;

    /**
     * @ORM\ManyToOne(targetEntity="Setting", inversedBy="users")
     * @ORM\JoinColumn(name="settings_id", referencedColumnName="id")
     */
//    protected $setting;

    /**
     * COMMENTME
     *
     * @var InputFilter
     */
    private $_inputFilter;

    /**
     * COMMENTME
     * 
     * @return \Application\Entity\Users
     */
    public function __construct()
    {
        // End.
        return $this;
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
     * Salt and crypt the credential.
     * 
     * @param Users $identity
     * @return \Application\Entity\User
     */
    public function saltCredential(User $identity)
    {
        $bcrypt = new Bcrypt();
        $bcrypt->setCost(15);
        $bcrypt->setSalt($identity->getSalt());

        $this->credential = $bcrypt->create($this->credential);

        // End.
        return $this;
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
        if (!$this->salt) {
            $this->salt = Rand::getBytes(Bcrypt::MIN_SALT_SIZE);
        }

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

        if (($this->attempts >= self::ATTEMPTS_TO_LOCKOUT) && ($now <= $lockoutTime)) {
            // End.
            return true;
        }

        // End.
        return false;
    }

    /**
     * COMMENTME
     * 
     * @return \DateTime
     */
    public function getLockoutDateTime()
    {
        $dt = new \DateTime();

        if (!$this->last_attempt instanceof \DateTime) {
            $this->last_attempt = $dt;
        }

        $lastAttemptTime = $this->last_attempt->getTimestamp();
        $lockoutTime = $lastAttemptTime + ($this->attempts * (self::LOCKOUT_TIME / 1000));
        $dt->setTimestamp($lockoutTime);

        // End.
        return $dt;
    }

    /**
     * COMMENTME
     * 
     * @return integer
     */
    public function increaseAttept()
    {
        $this->attempts += 1;

        // End.
        return $this->attempts;
    }

    /**
     * COMMENTME
     * 
     * @return array
     */
    public function getSecureArrayCopy()
    {
        $privateFields = array('credential', 'salt', 'verify_token');
        $secureFields = array();

        foreach ($this->getArrayCopy() as $field => $value) {
            if (in_array($field, $privateFields)) {
                continue;
            }

            $secureFields[$field] = $value;
        }

        return $secureFields;
    }

}

