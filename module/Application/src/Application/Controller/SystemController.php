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
    Zend\Json\Json,
    Zend\Authentication\Storage\Session as AuthSession,
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
        array('text' => 'Change image', 'icon' => '/images/icons/black/user_icon&16.png', 'action' => 'account/changeImage'),
        array('text' => 'Messages', 'icon' => '/images/icons/black/mail_icon&16.png', 'action' => 'messages'),
        '-',
        array('text' => 'Logoff', 'icon' => '/images/icons/black/padlock_closed_icon&16.png', 'action' => 'authentication/logoff'),
        '-',
        array('text' => 'About', 'icon' => '/images/icons/black/tag_icon&16.png', 'action' => 'about'),
        array('text' => 'Report a bug', 'icon' => '/images/icons/black/bug_icon&16.png', 'action' => 'issue')
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
                array('text' => 'Edit', 'icon' => '/images/icons/black/pencil_icon&16.png', 'action' => 'edit'),
                array('text' => 'Delete', 'icon' => '/images/icons/black/delete_icon&16.png', 'action' => 'delete')
            )
        ),
        'adminRoles' => array(
            'items' => array(
                '<b><div>Roles</div></b>',
                '-',
                array('text' => 'Add', 'icon' => '/images/icons/black/plus_icon&16.png', 'action' => 'add'),
                array('text' => 'Edit', 'icon' => '/images/icons/black/pencil_icon&16.png', 'action' => 'edit'),
                array('text' => 'Delete', 'icon' => '/images/icons/black/delete_icon&16.png', 'action' => 'delete')
            )
        ),
        'adminCountries' => array(
            'items' => array(
                '<b><div>Countries</div></b>',
                '-',
                array('text' => 'Add', 'icon' => '/images/icons/black/plus_icon&16.png', 'action' => 'add'),
                array('text' => 'Edit', 'icon' => '/images/icons/black/pencil_icon&16.png', 'action' => 'edit'),
                array('text' => 'Delete', 'icon' => '/images/icons/black/delete_icon&16.png', 'action' => 'delete'),
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
//                array('text' => 'Edit', 'icon' => '/images/icons/black/pencil_icon&16.png', 'action' => 'edit'),
                array('text' => 'Delete', 'icon' => '/images/icons/black/delete_icon&16.png', 'action' => 'delete'),
                '-',
                array('text' => 'Languages', 'icon' => '/images/icons/black/text_letter_t_icon&16.png', 'action' => 'languages')
            )
        ),
        'adminTranslate' => array(
            'items' => array(
                '<b><div>Translate</div></b>',
                '-',
                array('text' => 'Add', 'icon' => '/images/icons/black/plus_icon&16.png', 'action' => 'add'),
                array('text' => 'Edit', 'icon' => '/images/icons/black/pencil_icon&16.png', 'action' => 'edit'),
                array('text' => 'Delete', 'icon' => '/images/icons/black/delete_icon&16.png', 'action' => 'delete')
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
        'locales_id' => 1,
        'is_verified' => true,
        'is_active' => true,
        'identity' => '',
        'credential' => null,
        'salt' => null,
        'verify_token' => 'ajsdhflaksdhjflaksdhjflaskjdfh',
        'person' => array()
    );
    private $skeleton = array(
        'user' => array(),
        'locale' => array(),
        'settings' => array(),
        'navigation' => '',
        'userMenu' => array(),
        'toolbars' => array()
    );

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
        $identity = $this->getIdentity();

        if (!$identity) {
            // End.
            return new JsonModel($this->getNoIdentityResponse());
        }

        $localesModel = $identity->getLocales();
        $settingsModel = $identity->getSettings();

        $identity->excludeFields(array('locales', 'settings'));
        $userModel = $identity;

        $systemData = (object) $this->skeleton;
        $systemData->user = $userModel->getSecureArrayCopy();
        $systemData->locale = $localesModel->getArrayCopy();
//        $systemData->settings = $settingsModel->getArrayCopy();
        $systemData->navigation = $this->navigation;
        $systemData->userMenu = $this->userNavigation;
        $systemData->toolbars = $this->toolbar;

        return new JsonModel(
            array(
            'success' => true,
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
        $identity = $this->getIdentity();

        return new JsonModel(
            array(
            'success' => true,
            'user' => $identity->getSecureArrayCopy()
            )
        );
    }

    /**
     * COMMENTME
     * 
     * @return \Application\Entity\Users|null
     */
    private function getIdentity()
    {
        $authSession = new AuthSession();

        if ($authSession->isEmpty()) {
            // End.
            return null;
        }

        $identity = $authSession->read();

        // End.
        return $identity;
    }

    private function getNoIdentityResponse()
    {
        $responseConfig = array(
            'success' => true,
            'system' => $this->skeleton
        );

        // End.
        return $responseConfig;
    }

}

