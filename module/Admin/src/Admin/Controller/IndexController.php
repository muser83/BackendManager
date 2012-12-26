<?php

/**
 * IndexController.php
 * Created on Sep 16, 2012 11:12:26 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   LGPL
 * @copyright 2012 witteStier.nl
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Doctrine\ORM\EntityManager,
    Admin\Entity\Timezones;

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
        $timezones = $this->getEntityManager()->getRepository('Admin\Entity\Countries')->find(1);
        print '<pre>';
        var_dump($timezones);

        // Toggle
        $timezones->isVisible()
                ? $timezones->setIsVisible(false)
                : $timezones->setIsVisible(true);

        var_dump($timezones->toJson());


        $this->getEntityManager()->flush();
        die;

//        $variables = array(
//            'key' => 'value'
//        );
//
//        $viewModel = new ViewModel($variables);
//
//        // End.
//        return $viewModel;
//
//        // Or
//        return array(
//            'key' => 'value'
//        );
    }

}