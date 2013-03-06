<?php

/**
 * Users.php
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
class Users
    extends Helper\Helper
    implements InputFilterAwareInterface
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=11, unique=true, nullable=false)
     * @ORM\GeneratedValue
     *
     * @method Application\Entity\Users setId(int $id)
     * @method int getId()
     * @var type
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", length=11, unique=false, nullable=false)
     *
     * @method Application\Entity\Users setLocalesId(integer $locales_id)
     * @method integer getLocalesId()
     * @var integer
     */
    protected $locales_id;

    /**
     * @ORM\Column(type="integer", length=11, unique=true, nullable=true)
     *
     * @method Application\Entity\Users setPersonsId(integer $persons_id)
     * @method integer getPersonsId()
     * @var integer
     */
    protected $persons_id;

    /**
     * @ORM\Column(type="integer", length=3, unique=false, nullable=false)
     *
     * @method Application\Entity\Users setSettingsId(integer $settings_id)
     * @method integer getSettingsId()
     * @var integer
     */
    protected $settings_id;

    /**
     * @ORM\Column(type="boolean")
     *
     * @method Application\Entity\Users setIsVerified(boolean $is_verified)
     * @method boolean getIsVerified()
     * @var boolean
     */
    protected $is_verified;

    /**
     * @ORM\Column(type="boolean")
     *
     * @method Application\Entity\Users setIsActive(boolean $is_active)
     * @method boolean getIsActive()
     * @var boolean
     */
    protected $is_active;

    /**
     * @ORM\Column(type="string", length=100, unique=false, nullable=false)
     *
     * @method Application\Entity\Users setIdentity(string $identity)
     * @method string getIdentity()
     * @var type
     */
    protected $identity;

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     *
     * @method Application\Entity\Users setCredential(string $credential)
     * @method string getCredential()
     * @var type
     */
    protected $credential;

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     *
     * @method Application\Entity\Users setSalt(string $salt)
     * @var type
     */
    protected $salt;

    /**
     * @ORM\Column(type="string", length=25, unique=false, nullable=false)
     *
     * @method Application\Entity\Users setVerifyToken(string $verify_token)
     * @method string getVerifyToken()
     * @var string
     */
    protected $verify_token;

    /**
     * @ORM\ManyToOne(targetEntity="Locales", cascade={"all"}, fetch="EAGER")
     * 
     * @method Application\Entity\Users setLocales()
     * @method Application\Entity\Locales getLocales()
     * @var Application\Entity\Locales
     */
    protected $locales;

    /**
     * @ORM\ManyToOne(targetEntity="Persons", cascade={"all"}, fetch="EAGER")
     * 
     * @method Application\Entity\Users setPersons()
     * @method Application\Entity\Persons getPersons()
     * @var Application\Entity\Persons
     */
    protected $persons;

    /**
     * @ORM\ManyToOne(targetEntity="Settings", cascade={"all"}, fetch="EAGER")
     * 
     * @method Application\Entity\Users setSettings()
     * @method Application\Entity\Settings getSettings()
     * @var Application\Entity\Settings
     */
    protected $settings;

    /**
     * COMMENTME
     *
     * @var InputFilter
     */
    private $inputFilter;

    public function saltCredential($identity)
    {
        $bcrypt = new Bcrypt();
        $bcrypt->setCost(15);
        $bcrypt->setSalt($identity->getSalt());

        $this->credential = $bcrypt->create($this->credential);

        // End.
        return $this->credential;
    }

    /**
     * COMMENTME
     * 
     * @param \Zend\InputFilter\InputFilterInterface $inputFilter
     * @throws Exception
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        // End.
        throw new Exception("Not used.");
    }

    /**
     * COMMENTME
     * 
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {
        if ($this->inputFilter instanceof InputFilterInterface) {
            // End.
            return $this->inputFilter;
        }
        $factory = new InputFactory();

        // Input filter configuration.
        $filters = array(
            array(
                'name' => 'id',
                'required' => false,
                'filters' => array(
                    array('name' => 'Int'),
                ),
                'validators' => array(),
            ),
            array(
                'name' => 'identity',
                'required' => true,
                'filters' => array(
                    array('name' => 'StringTrim'),
                ),
                'validators' => array()
            ),
            array(
                'name' => 'credential',
                'required' => true,
                'filters' => array(
                    array('name' => 'StringTrim'),
                ),
                'validators' => array()
            ),
            array(
                'name' => 'salt',
                'required' => false,
                'filters' => array(
                    array('name' => 'StringTrim'),
                ),
                'validators' => array()
            ),
        );

        $this->inputFilter = $factory->createInputFilter($filters);

        // End.
        return $this->inputFilter;
    }

    /**
     * COMMENTME
     * 
     * @return string
     */
    public function getSalt()
    {
        if (!$this->salt) {
            $this->salt = Rand::getBytes(Bcrypt::MIN_SALT_SIZE);
        }

        // End.
        return $this->salt;
    }

    public function getSecureArrayCopy()
    {
        $this->excludeFields(array(
            'credential', 'salt', 'verify_token'
        ));

        $arrayCopy = $this->getArrayCopy();

        return $arrayCopy;
    }

}

