<?php

/**
 * Messages.php
 * Created on Mar 13, 2013 11:12:50 PM
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
    Zend\InputFilter\InputFilterInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="messages")
 */
class Messages
    extends Helper\Helper
    implements InputFilterAwareInterface
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=11, unique=true, nullable=false)
     * @ORM\GeneratedValue
     *
     * @method Application\Entity\Messages setId(int $id)
     * @method int getId()
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", length=11, unique=true, nullable=false)
     *
     * @method Messages setToPersonsId(integer $to_persons_id)
     * @method integer getToPersonsId()
     * @var integer
     */
    protected $to_persons_id;

    /**
     * @ORM\Column(type="integer", length=11, unique=true, nullable=true)
     *
     * @method Messages setFromPersonsId(integer $from_persons_id)
     * @method integer getFromPersonsId()
     * @var integer
     */
    protected $from_persons_id;

    /**
     * @ORM\Column(type="boolean")
     *
     * @method Messages setIsRead(boolean $is_read)
     * @method boolean getIsRead()
     * @var boolean
     */
    protected $is_read = false;

    /**
     * @ORM\Column(type="boolean")
     *
     * @method Messages setIsTrash(boolean $is_trash)
     * @method integer getIsTrash()
     * @var boolean
     */
    protected $is_trash = false;

    /**
     * @ORM\Column(type="boolean")
     *
     * @method Messages setIsDeleted(boolean $is_deleted)
     * @method boolean getIsDeleted()
     * @var boolean
     */
    protected $is_deleted = false;

    /**
     * @ORM\Column(type="string", length=1001, unique=false, nullable=false)
     *
     * @method Messages setSubject(string $subject)
     * @method string getSubject()
     * @var string
     */
    protected $subject;

    /**
     * @ORM\Column(type="text", nullable=false)
     *
     * @method Messages setMessage(text $message)
     * @method string getMessage()
     * @var text
     */
    protected $message;

    /**
     * @ORM\Column(type="datetime")
     *
     * @method Messages setCdate(datetime $cdate)
     * @method datetime getCdate()
     * @var datetime
     */
    protected $cdate;

    /**
     * COMMENTME
     *
     * @var InputFilter
     */
    private $inputFilter;

    /**
     * COMMENTME
     * 
     * @param \Application\Entity\Persons $person
     * @param string $subject
     * @param string $message
     */
    public function __construct(\Application\Entity\Persons $person, $subject, $message)
    {
        $this->to_persons_id = $person->getId();
        $this->subject = (string) $subject;
        $this->message = (string) $message;
        $this->cdate = new \DateTime();
    }

    /**
     * COMMENTME
     * 
     * @param \Zend\InputFilter\InputFilterInterface $inputFilter
     * @throws \Exception
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        // End.
        throw new \Exception("Not used.");
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
        );

        $this->inputFilter = $factory->createInputFilter($filters);

        // End.
        return $this->inputFilter;
    }

}

