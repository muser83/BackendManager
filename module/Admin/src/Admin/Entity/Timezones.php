<?php

/**
 * Timezones.php
 * Created on Dec 12, 2012 12:12:47 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   LGPL
 * @copyright 2012 witteStier.nl
 */

namespace Admin\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="timezones")
 */
class Timezones
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(name="is_visible", type="boolean", nullable=false)
     * @var bool
     */
    protected $isVisible = false;

    /**
     * @ORM\Column(type="string", length=50, unique=true, nullable=false)
     * @var string
     */
    protected $name;

}