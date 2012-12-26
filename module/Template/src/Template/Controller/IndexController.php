<?php

/**
 * IndexController.php
 * Created on Sep 16, 2012 11:12:26 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   LGPL
 * @copyright 2012 witteStier.nl
 */

namespace Template\Controller; // TODO Replace Template with the modulename.

use Zend\Mvc\Controller\AbstractActionController,
    Zend\Mvc\Controller\AbstractRestfulController,
    Zend\View\Model\ViewModel,
    Doctrine\ORM\EntityManager;

class IndexController
    extends AbstractActionController
{

    /**
     * Instance of \Doctrine\ORM\EntityManager.
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * Set an instance of \Doctrine\ORM\EntityManager.
     *
     * @param \Doctrine\ORM\EntityManager $em
     * @return \Album\Controller\AlbumController
     */
    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;

        // End.
        return $this;
    }

    /**
     * Create and or get an instance of \Doctrine\ORM\EntityManager.
     *
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');
        }

        // End.
        return $this->em;
    }

    /**
     * Common action description.
     *
     * @return type
     */
    public function indexAction()
    {
        $variables = array(
            'key' => 'value'
        );

        $viewModel = new ViewModel($variables);

        // End.
        return $viewModel;

        // Or
        return array(
            'key' => 'value'
        );
    }

}