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
    Zend\View\Model\ViewModel,
    Zend\View\Model\JsonModel,
    Zend\Json\Json,
    Zend\Session\Container AS sessionContainer,
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
    private $isAuthenticated = false;
    private $navigation = '
<li>
<a href="#!">Dashboard</a>
</li>
<li>
<a href="admin">Admin</a>
<ul>
<li><a href="admin/users" icon="users">Users</a></li>
<li><a href="admin/roles" icon="users">Roles</a></li>
<li><a href="admin/countries" icon="globe-2">Countries</a></li>
<li><a href="admin/locales" icon="flag">Locales</a></li>
<li><a href="admin/translate" icon="spechbubble-2">Translate</a></li>
</ul>
</li>';
    private $userNavigation = array(
        array('text' => 'Account', 'icon' => '/images/icons/black/contact_card_icon&16.png', 'action' => 'account'),
        array('text' => 'Settings', 'icon' => '/images/icons/black/wrench_icon&16.png', 'action' => 'settings'),
        array('text' => 'Change image', 'icon' => '/images/icons/black/user_icon&16.png', 'action' => 'changeImage'),
        array('text' => 'Messages', 'icon' => '/images/icons/black/mail_icon&16.png', 'action' => 'messages'),
        '-',
        array('text' => 'Logoff', 'icon' => '/images/icons/black/padlock_closed_icon&16.png', 'action' => 'logoff'),
        '-',
        array('text' => 'About', 'icon' => '/images/icons/black/tag_icon&16.png', 'action' => 'about'),
        array('text' => 'Report a bug', 'icon' => '/images/icons/black/bug_icon&16.png', 'action' => 'reportBug')
    );
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
                array('text' => 'Add', 'icon' => '/images/icons/black/plus_icon&16.png', 'action' => 'add'),
                array('text' => 'Edit', 'icon' => '/images/icons/black/pencil_icon&16.png', 'action' => 'edit', 'disabled' => true),
                array('text' => 'Delete', 'icon' => '/images/icons/black/delete_icon&16.png', 'action' => 'delete', 'disabled' => true)
            )
        ),
        'adminRoles' => array(
            'items' => array(
                '<b><div>Roles</div></b>',
                '-',
                array('text' => 'Add', 'icon' => '/images/icons/black/plus_icon&16.png', 'action' => 'add'),
                array('text' => 'Edit', 'icon' => '/images/icons/black/pencil_icon&16.png', 'action' => 'edit', 'disabled' => true),
                array('text' => 'Delete', 'icon' => '/images/icons/black/delete_icon&16.png', 'action' => 'delete', 'disabled' => true)
            )
        ),
        'adminCountries' => array(
            'items' => array(
                '<b><div>Countries</div></b>',
                '-',
                array('text' => 'Add', 'icon' => '/images/icons/black/plus_icon&16.png', 'action' => 'add'),
                array('text' => 'Edit', 'icon' => '/images/icons/black/pencil_icon&16.png', 'action' => 'edit', 'disabled' => true),
                array('text' => 'Delete', 'icon' => '/images/icons/black/delete_icon&16.png', 'action' => 'delete', 'disabled' => true),
                '-',
                array('text' => 'Continents', 'icon' => '/images/icons/black/pin_map_icon&16.png', 'action' => 'continents'),
                array('text' => 'Currencies', 'icon' => '/images/icons/black/cur_euro_icon&16.png', 'action' => 'currencies'),
            )
        ),
        'adminLocales' => array(
            'items' => array(
                '<b><div>Locales</div></b>',
                '-',
                array('text' => 'Add', 'icon' => '/images/icons/black/plus_icon&16.png', 'action' => 'add'),
                array('text' => 'Edit', 'icon' => '/images/icons/black/pencil_icon&16.png', 'action' => 'edit', 'disabled' => true),
                array('text' => 'Delete', 'icon' => '/images/icons/black/delete_icon&16.png', 'action' => 'delete', 'disabled' => true),
                '-',
                array('text' => 'Languages', 'icon' => '/images/icons/black/text_letter_t_icon&16.png', 'action' => 'languages')
            )
        ),
        'adminTranslate' => array(
            'items' => array(
                '<b><div>Translate</div></b>',
                '-',
                array('text' => 'Add', 'icon' => '/images/icons/black/plus_icon&16.png', 'action' => 'add'),
                array('text' => 'Edit', 'icon' => '/images/icons/black/pencil_icon&16.png', 'action' => 'edit', 'disabled' => true),
                array('text' => 'Delete', 'icon' => '/images/icons/black/delete_icon&16.png', 'action' => 'delete', 'disabled' => true)
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
        'image' => './images/icons/black/&32/user_icon&32.png',
        'firstname' => 'Boy',
        'middlename' => 'van',
        'lastname' => 'Moorsel',
        'gender' => 1,
        'birthday' => ''
    );
    private $user = array(
        'id' => 1,
        'localesId' => 1,
        'isVerified' => true,
        'isActive' => true,
        'identity' => 'WitteStier',
        'credential' => null,
        'salt' => null,
        'verifyToken' => null,
        'person' => array()
    );

    /**
     * Controller constructor
     *
     * @return boolean
     */
    public function __construct()
    {
        $session = new sessionContainer('dev');

        if ($session->offsetExists('isAuthenticated')) {
            $this->isAuthenticated = (bool) $session->offsetGet('isAuthenticated');
        }

        // End.
        return true;
    }

    /**
     * Set an instance of \Doctrine\ORM\EntityManager.
     *
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @return \Application\Controller\SystemController
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

        $systemData = array(
            'userId' => 1,
            'personId' => 1,
            'navigation' => $this->navigation,
            'userNavigation' => $this->userNavigation,
            'toolbar' => $this->toolbar,
            'settings' => $this->settings,
            'user' => $this->user,
            'person' => $this->person
        );

        if ($request->isPost()) {
            $systemData = Json::decode(
                    $request->getPost('system', '{}'), Json::TYPE_ARRAY
            );

            // End.
            return new JsonModel(
                array(
                'success' => true,
                'system' => $systemData
                )
            );
        }

        return new JsonModel(
            array(
            'success' => $this->isAuthenticated,
            'messages' => 'Not authenticated.',
            'system' => $systemData
            )
        );
    }

    /**
     * COMMENTME
     *
     * @return \Zend\View\Model\JsonModel
     */
    public function getUserAction()
    {
        $user = $this->user;

        return new JsonModel(
            array(
            'success' => $this->isAuthenticated,
            'messages' => 'test msg',
            'user' => $user
            )
        );
    }

    /**
     * COMMENTME
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function aboutAction()
    {
        $result = new ViewModel();
        $result->setTerminal(true);

        return $result;
    }

}