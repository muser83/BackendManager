<?php

/**
 * Persons.php
 * Created on Mar 4, 2013 11:27:05 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   license.wittestier.nl
 * @copyright 2013 WitteStier - copyright.wittestier.nl
 */

namespace Application\Entity;

use Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface,
    Zend\Crypt\Password\Bcrypt,
    Zend\Math\Rand,
    Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="persons")
 */
class Persons
    extends Helper\Helper
//    implements InputFilterAwareInterface
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=11, unique=true, nullable=false)
     * @ORM\GeneratedValue
     *
     * @method Application\Entity\Persons setId(int $id)
     * @method int getId()
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", length=11, unique=true, nullable=false)
     *
     * @method Application\Entity\Persons setAddressesId(integer $addresses_id)
     * @method integer getAddressesId()
     * @var integer
     */
    protected $addresses_id;

    /**
     * @ORM\Column(type="integer", length=11, unique=true, nullable=false)
     *
     * @method Application\Entity\Persons setCommunicationId(integer $communication_id)
     * @method integer getCommunicationId()
     * @var integer
     */
    protected $communication_id;

    /**
     * @ORM\Column(type="string", length=50, unique=false, nullable=false)
     *
     * @method Application\Entity\Persons setFirstname(string $firstname)
     * @method string getFirstname()
     * @var string
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string", length=25, unique=false, nullable=true)
     *
     * @method Application\Entity\Persons setMiddlename(string $middlename)
     * @method string getMiddlename()
     * @var string
     */
    protected $middlename;

    /**
     * @ORM\Column(type="string", length=50, unique=false, nullable=false)
     *
     * @method Application\Entity\Persons setLastname(string $lastname)
     * @method string getLastname()
     * @var string
     */
    protected $lastname;

    /**
     * @ORM\Column(type="integer", length=1, unique=false, nullable=true)
     *
     * @method Application\Entity\Persons setGender(integer $gender)
     * @method integer getGender()
     * @var integer
     */
    protected $gender;

}

