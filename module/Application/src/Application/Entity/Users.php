<?php

/**
 * Users.php
 * Created on Nov 18, 2012 11:55:30 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   LGPL
 * @copyright 2012 witteStier.nl
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM,
    WS\Entity\Entity;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class Users
    extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=11, unique=true, nullable=false)
     * @ORM\GeneratedValue
     *
     * @var type
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100, unique=false, nullable=false)
     *
     * @var type
     */
    protected $identity;

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     *
     * @var type
     */
    protected $credential;

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     *
     * @var type
     */
    protected $salt;

}