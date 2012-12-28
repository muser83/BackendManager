<?php

/**
 * SystemController.php
 * Created on Dec 24, 2012 10:22:04 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   LGPL
 * @copyright 2012 witteStier.nl
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\JsonModel,
    Doctrine\ORM\EntityManager;

/**
 * Controller description
 *
 * @package    name
 * @subpackage name
 */
class SystemController
    extends AbstractActionController
{

    /**
     * Instance of \Doctrine\ORM\EntityManager.
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;
    private $isAuthenticated = true;
    private $navigation = '<li><a href="#!">Dashboard</a></li>
<li><a href="tab/1" type="text/html">Tab one</a><ul><li><a href="tab/2" type="text/html">Tab one A</a></li><li><a href="tab/3" type="text/html">Tab one B</a></li></ul></li><li><a href="tab/4" type="text/html" >Tab two</a><ul><li><a href="tab/5" type="text/html">Tab two a</a></li><li><a href="tab/6" type="text/html">Tab two b</a></li></ul></li><li ><a href="tab/7" type="text/html" >Tab three</a><ul><li><a href="tab/8" type="text/html">Tab three a</a></li><li><a href="tab/9" type="text/html">Tab three b</a></li></ul></li>
<li>
<a href="admin">Admin</a>
<ul>
<li><a href="admin/users" icon="group">Users</a></li>
<li><a href="admin/roles" icon="group">Roles</a></li>
<li><a href="admin/countries" icon="globe">Countries</a></li>
<li><a href="admin/locales" icon="globe">Locales</a></li>
<li><a href="admin/translate" icon="flag">Translate</a></li>
</ul>
</li>';
    private $toolbar = array(
        'adminCountries' => array(
            'items' => array(
                '<b><div>Countries</div></b>',
                '-',
                array('text' => 'Add', 'action' => 'add'),
                array('text' => 'Edit', 'action' => 'edit'),
                array('text' => 'Delete', 'action' => 'delete'),
                array('text' => 'Continents', 'action' => 'continents'),
                array('text' => 'Currencies', 'action' => 'currencies'),
            )
        ),
        'adminLocales' => array(
            'items' => array(
                '<b><div>Locales</div></b>',
                '-',
                array('text' => 'Add', 'action' => 'add'),
                array('text' => 'Edit', 'action' => 'edit'),
                array('text' => 'Delete', 'action' => 'delete'),
                array('text' => 'Languages', 'action' => 'languages')
            )
        )
    );
    private $settings = array(
        'defaultAction' => array(
            'module' => 'application',
            'controller' => 'dashboard',
            'action' => 'startup',
            'args' => array()
        ),
        'loadDefaultActionOnEmptyUri' => true
    );
    private $persons = array(
        'id' => 1,
        'addressesId' => 0,
        'communicationsId' => 0,
        'firstname' => 'Boy',
        'middlename' => 'van',
        'lastname' => 'Moorsel',
        'gender' => 1,
        'birthday' => ''
    );
    private $users = array(
        'id' => 1,
        'localesId' => 1,
        'personsId' => 1,
        'identity' => 'WitteStier',
        'credential' => null,
        'salt' => null,
        'verifyToken' => null,
        'isVerified' => true,
        'isActive' => true,
        'persons' => array()
    );

    /**
     * Set an instance of \Doctrine\ORM\EntityManager.
     *
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @return \Album\Controller\AlbumController
     */
    public function setEntityManager(EntityManager $entityManagerm)
    {
        $this->entityManager = $entityManager;

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
        if (null === $this->entityManager) {
            $this->entityManager = $this->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');
        }

        // End.
        return $this->entityManager;
    }

    /**
     * COMMENTME
     *
     * @return \Zend\View\Model\JsonModel
     */
    public function indexAction()
    {
        $user = $this->users;
        $user['persons'] = $this->persons;

        $systemData = array(
            'userId' => 1,
            'navigation' => $this->navigation,
            'toolbar' => $this->toolbar,
            'settings' => $this->settings,
            'user' => $user
        );

        return new JsonModel(
            array(
            'success' => $this->isAuthenticated,
            'messages' => 'test msg',
            'system' => $systemData
            )
        );
    }

    /**
     *
     */
    public function getUserAction()
    {
        $user = $this->users;
        $user['persons'] = $this->persons;

        return new JsonModel(
            array(
            'success' => $this->isAuthenticated,
            'messages' => 'test msg',
            'user' => $user
            )
        );
    }

}