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
    Zend\Json\Json,
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
    private $navigation = '
<li>
<a href="#!">Dashboard</a>
</li>
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
        'applicationDashboard' => array(
            'items' => array(
                '<b><div>Dashboard</div></b>',
                '-'
            )
        ),
        'adminUsers' => array(
            'items' => array(
                '<b><div>Users</div></b>',
                '-',
                array('text' => 'Add', 'action' => 'add'),
                array('text' => 'Edit', 'action' => 'edit', 'disabled' => true),
                array('text' => 'Delete', 'action' => 'delete', 'disabled' => true)
            )
        ),
        'adminRoles' => array(
            'items' => array(
                '<b><div>Roles</div></b>',
                '-',
                array('text' => 'Add', 'action' => 'add'),
                array('text' => 'Edit', 'action' => 'edit', 'disabled' => true),
                array('text' => 'Delete', 'action' => 'delete', 'disabled' => true)
            )
        ),
        'adminCountries' => array(
            'items' => array(
                '<b><div>Countries</div></b>',
                '-',
                array('text' => 'Add', 'action' => 'add'),
                array('text' => 'Edit', 'action' => 'edit', 'disabled' => true),
                array('text' => 'Delete', 'action' => 'delete', 'disabled' => true),
                '-',
                array('text' => 'Continents', 'action' => 'continents'),
                array('text' => 'Currencies', 'action' => 'currencies'),
            )
        ),
        'adminLocales' => array(
            'items' => array(
                '<b><div>Locales</div></b>',
                '-',
                array('text' => 'Add', 'action' => 'add'),
                array('text' => 'Edit', 'action' => 'edit', 'disabled' => true),
                array('text' => 'Delete', 'action' => 'delete', 'disabled' => true),
                '-',
                array('text' => 'Languages', 'action' => 'languages')
            )
        ),
        'adminTranslate' => array(
            'items' => array(
                '<b><div>Translate</div></b>',
                '-',
                array('text' => 'Add', 'action' => 'add'),
                array('text' => 'Edit', 'action' => 'edit', 'disabled' => true),
                array('text' => 'Delete', 'action' => 'delete', 'disabled' => true)
            )
        ),
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
    private $person = array(
        'id' => 1,
        'addressesId' => 0,
        'communicationsId' => 0,
        'image' => 'https://lh4.googleusercontent.com/-5hmVYhkDcLA/AAAAAAAAAAI/AAAAAAAAALg/mSeImjP68c8/s48-c-k/photo.jpg',
        'firstname' => 'Boy',
        'middlename' => 'van',
        'lastname' => 'Moorsel',
        'gender' => 1,
        'birthday' => ''
    );
    private $user = array(
        'id' => 1,
        'localesId' => 1,
        'personsId' => 1,
        'isVerified' => true,
        'isActive' => true,
        'identity' => 'WitteStier',
        'credential' => null,
        'salt' => null,
        'verifyToken' => null,
        'person' => array()
    );

    /**
     * Set an instance of \Doctrine\ORM\EntityManager.
     *
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @return \Album\Controller\AlbumController
     */
    public function setEntityManager(EntityManager $entityManager)
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
        $request = $this->getRequest();

        if ($request->isPost()) {
            $systemData = Json::decode(
                    $request->getPost('system', '{}'), Json::TYPE_ARRAY
            );

            // End.
            return new JsonModel(
                array(
                'success' => $this->isAuthenticated,
                'system' => $systemData
                )
            );
        }



        $user = $this->user;
        $user['person'] = $this->person;

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
        $user = $this->user;
        $user['person'] = $this->person;

        return new JsonModel(
            array(
            'success' => $this->isAuthenticated,
            'messages' => 'test msg',
            'user' => $user
            )
        );
    }

}