<?php

/**
 * Countries.php
 * Created on Dec 12, 2012 12:11:49 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   LGPL
 * @copyright 2012 witteStier.nl
 */

namespace Admin\Entity;

use Zend\Json\Json,
    Doctrine\Common\Collections\ArrayCollection,
    Doctrine\ORM\Mapping AS ORM,
    Admin\Doctrine\Helper AS EntityHelper;

/**
 * @ORM\Entity
 * @ORM\Table(name="countries")
 */
class Countries
    extends EntityHelper
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(name="continents_id", type="integer", unique=true, nullable=false)
     * @var type
     */
    protected $continentsId;

    /**
     * @ORM\Column(name="currencies_id", type="integer", unique=true, nullable=false)
     * @var type
     */
    protected $currenciesId;

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
     * @ORM\Column(name="local_name", type="string", length=50, nullable=false)
     * @var string
     */
    protected $localName;

    /**
     * @ORM\Column(type="string", length=2, nullable=false)
     * @var string
     */
    protected $iso31662;

    /**
     * @ORM\Column(type="string", length=3, nullable=false)
     * @var string
     */
    protected $iso31663;

    /**
     * @ORM\Column(type="string", length=10)
     * @var string
     */
    protected $tld;

    /**
     * @ORM\Column(name="calling_code", type="string", length=5)
     * @var string
     */
    protected $callingCode;

    /**
     * @ORM\ManyToOne(targetEntity="Continents", cascade={"all"}, fetch="EAGER")
     * @ORM\JoinColumn(name="continents_id", referencedColumnName="id")
     *
     * @var Countries
     */
    protected $continents;

    public function __construct()
    {
//        $this->continents = new ArrayCollection();
    }

    public function getContinents()
    {
        return $this->continents->getFieldValues();
    }

}