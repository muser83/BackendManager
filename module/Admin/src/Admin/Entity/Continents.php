<?php

/**
 * Continents.php
 * Created on Dec 12, 2012 12:11:40 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   LGPL
 * @copyright 2012 witteStier.nl
 */

namespace Admin\Entity;

use Doctrine\ORM\Mapping AS ORM,
    Admin\Doctrine\Helper AS EntityHelper;

/**
 * @ORM\Entity
 * @ORM\Table(name="continents")
 */
class Continents
    extends EntityHelper
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