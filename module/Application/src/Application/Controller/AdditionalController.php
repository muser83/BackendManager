<?php

/**
 * AdditionalController.php
 * Created on Sep 23, 2012 10:21:04 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   LGPL
 * @copyright 2012 witteStier.nl
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Zend\View\Model\JsonModel,
    Doctrine\ORM\EntityManager;

/**
 * Controller description
 *
 * @package    name
 * @subpackage name
 */
class AdditionalController
    extends AbstractActionController
{

    /**
     * Instance of \Doctrine\ORM\EntityManager.
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

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

    public function indexAction()
    {
        return array('content' => 'test');
    }

    /**
     * Common action description.
     *
     * @return Zend\View\Model\JsonModel
     */
    public function getNavigationAction()
    {
        $navigationModel = array(
            'navigationDOM' => '
<li>
    <a href="#tab/1" type="text/html">Tab one</a>
    <ul>
        <li>
            <a href="#tab/2" type="text/html">Tab one A</a>
        </li>
        <li>
            <a href="#tab/3" type="text/html">Tab one B</a>
        </li>
    </ul>
</li>
<li>
    <a href="#tab/4" type="text/html" >Tab two</a>
    <ul>
        <li>
            <a href="#tab/5" type="text/html">Tab two a</a>
        </li>
        <li>
            <a href="#tab/6" type="text/html">Tab two b</a>
        </li>
    </ul>
</li>
<li >
    <a href="#tab/7" type="text/html" >Tab three</a>
    <ul>
        <li>
            <a href="#tab/8" type="text/html">Tab three a</a>
        </li>
        <li>
            <a href="#tab/9" type="text/html">Tab three b</a>
        </li>
    </ul>
</li>
<li>
    <a href="#admin">Admin</a>
    <ul>
        <li>
            <a href="#admin/users">Users</a>
        </li>
        <li>
            <a href="#admin/roles">Roles</a>
        </li>
        <li>
            <a href="#admin/countries">Countries</a>
        </li>
        <li>
            <a href="#admin/locales">Locales</a>
        </li>
        <li>
            <a href="#admin/translate">Translate</a>
        </li>
    </ul>
</li>');

        return new JsonModel(
            array(
            'message' => 'Authenticated.',
            'success' => true,
            'navigation' => $navigationModel
            )
        );
    }

    /**
     * Common action description.
     *
     * @return Zend\View\Model\JsonModel
     */
    public function getSystemInfoAction()
    {
        $systemModel = array(
            'id' => 0,
            'settings_id' => 1,
            'person_id' => 1,
            'navigation' => '<li><a href="tab/1" type="text/html">Tab one</a><ul><li><a href="tab/2" type="text/html">Tab one A</a></li><li><a href="tab/3" type="text/html">Tab one B</a></li></ul></li><li><a href="tab/4" type="text/html" >Tab two</a><ul><li><a href="tab/5" type="text/html">Tab two a</a></li><li><a href="tab/6" type="text/html">Tab two b</a></li></ul></li><li ><a href="tab/7" type="text/html" >Tab three</a><ul><li><a href="tab/8" type="text/html">Tab three a</a></li><li><a href="tab/9" type="text/html">Tab three b</a></li></ul></li>
<li>
    <a href="admin">Admin</a>
    <ul>
        <li>
            <a href="admin/users" icon="group">Users</a>
        </li>
        <li>
            <a href="admin/roles" icon="group">Roles</a>
        </li>
        <li>
            <a href="admin/countries" icon="globe">Countries</a>
        </li>
        <li>
            <a href="admin/locales" icon="globe">Locales</a>
        </li>
        <li>
            <a href="admin/translate" icon="flag">Translate</a>
        </li>
    </ul>
</li>',
            'toolbar' => array(
                'adminCountries' => array(
                    'items' => array(
                        '<b><div>Countries</div></b>',
                        '-',
                        array(
                            'text' => 'Add',
                            'action' => 'add'
                        ),
                        array(
                            'text' => 'Edit',
                            'action' => 'edit'
                        ),
                        array(
                            'text' => 'Delete',
                            'action' => 'delete'
                        ),
                        array(
                            'text' => 'Continents',
                            'action' => 'continents'
                        ),
                        array(
                            'text' => 'Currencies',
                            'action' => 'currencies'
                        ),
                    )
                ),
                'adminLocales' => array(
                    'items' => array(
                        '<b><div>Locales</div></b>',
                        '-',
                        array(
                            'text' => 'Add',
                            'action' => 'add'
                        ),
                        array(
                            'text' => 'Edit',
                            'action' => 'edit'
                        ),
                        array(
                            'text' => 'Delete',
                            'action' => 'delete'
                        ),
                        array(
                            'text' => 'Languages',
                            'action' => 'languages'
                        )
                    )
                )
            ),
            'settings' => array(
                'id' => 1,
                'action' => array(
                    'module' => 'application',
                    'controller' => 'dashboard',
                    'action' => 'startup',
                    'args' => array()
                )
            ),
            'user' => array(
                'id' => 2,
                'is_authenticated' => true,
                'is_verified' => true,
                'auth_identity' => 'WitteStier',
                'auth_credential' => null,
                'cdate' => strtotime(date('Y-m-d H:i:d')),
                'udate' => strtotime(date('Y-m-d H:i:d')),
            ),
            'person' => array(
                'id' => 1,
                'users_id' => 1,
                'addresses_id' => 1,
                'communications_id' => 1,
                'image' => 'https://lh4.googleusercontent.com/-5hmVYhkDcLA/AAAAAAAAAAI/AAAAAAAAAAA/mmJ4bNyNHAQ/s96-c/photo.jpg',
                'firstname' => 'Boy',
                'middlename' => 'van',
                'lastname' => 'Moorsel',
                'gender' => 1
            )
        );

//        $this->response->setStatusCode(404);

        return new JsonModel(
            array(
            'success' => true,
            'system' => $systemModel
            )
        );
    }

    /**
     * Common action description.
     *
     * @return Zend\View\Model\ViewModel
     */
    public function queryAction()
    {
        return array('content' => 'test');
    }

}