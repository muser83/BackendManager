<?php

/**
 * Settings.php
 * Created on Mar 5, 2013 12:20:01 AM
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
 * @ORM\Table(name="settings")
 */
class Settings
    extends Helper\Helper
//    implements InputFilterAwareInterface
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=11, unique=true, nullable=false)
     * @ORM\GeneratedValue
     *
     * @method Application\Entity\Settings setId(int $id)
     * @method int getId()
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", length=3, unique=false, nullable=false)
     *
     * @method Application\Entity\Settings setLockSystemAfter(integer $lock_system_after)
     * @method integer getLockSystemAfter()
     * @var integer
     */
    protected $lock_system_after;

    /**
     * @ORM\Column(type="integer", length=3, unique=false, nullable=false)
     *
     * @method Application\Entity\Settings setShutdownSystemAfter(integer $shutdown_system_after)
     * @method integer getShutdownSystemAfter()
     * @var integer
     */
    protected $shutdown_system_after;

}

