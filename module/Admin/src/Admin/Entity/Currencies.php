<?php

/**
 * Currencies.php
 * Created on Dec 12, 2012 12:12:05 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   LGPL
 * @copyright 2012 witteStier.nl
 */

namespace Admin\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="currencies")
 */
class Currencies
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

    /**
     * @ORM\Column(type="string", length=3, nullable=false)
     * @var string
     */
    protected $iso4217;

    /**
     * @ORM\Column(type="string", length=10)
     * @var string
     */
    protected $symbol = null;

}