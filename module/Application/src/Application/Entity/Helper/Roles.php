<?php

/**
 * Roles.php
 * Created on Mar 5, 2013 12:03:13 AM
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
class Roles
    extends Helper\Helper
//    implements InputFilterAwareInterface
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=11, unique=true, nullable=false)
     * @ORM\GeneratedValue
     *
     * @method Application\Entity\Roles setId(int $id)
     * @method int getId()
     * @var integer
     */
    protected $id;

}

