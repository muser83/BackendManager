<?php

/**
 * Locales.php
 * Created on Mar 5, 2013 12:03:06 AM
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
 * @ORM\Table(name="locales")
 */
class Locales
    extends Helper\Helper
//    implements InputFilterAwareInterface
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=11, unique=true, nullable=false)
     * @ORM\GeneratedValue
     *
     * @method Application\Entity\Locales setId(int $id)
     * @method int getId()
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", length=11, unique=false, nullable=false)
     *
     * @method Application\Entity\Locales setLanguagesId(integer $languages_id)
     * @method integer getLanguagesId()
     * @var integer
     */
    protected $languages_id;

    /**
     * @ORM\Column(type="integer", length=11, unique=false, nullable=false)
     *
     * @method Application\Entity\Locales setCountriesId(integer $countries_id)
     * @method integer getCountriesId()
     * @var integer
     */
    protected $countries_id;

    /**
     * @ORM\Column(type="integer", length=11, unique=false, nullable=false)
     *
     * @method Application\Entity\Locales setCharsetsId(integer $charsets_id)
     * @method integer getCharsetsId()
     * @var integer
     */
    protected $charsets_id;

    /**
     * @ORM\Column(type="integer", length=11, unique=false, nullable=false)
     *
     * @method Application\Entity\Locales setIsVisible(integer $is_visible)
     * @method integer getIsVisible()
     * @var integer
     */
    protected $is_visible;

    /**
     * @ORM\Column(type="string", length=5, unique=true, nullable=false)
     *
     * @method Application\Entity\Locales setName(string $name)
     * @method string getName()
     * @var string
     */
    protected $name;

}
