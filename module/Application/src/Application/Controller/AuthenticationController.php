<?php

/**
 * AuthenticationController.php
 * Created on Sep 23, 2012 10:19:19 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   LGPL
 * @copyright 2012 witteStier.nl
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\Json\Json,
    Zend\View\Model\JsonModel,
    Zend\Session\Container AS sessionContainer,
    Doctrine\ORM\EntityManager;

/**
 * Controller description
 *
 * @package    name
 * @subpackage name
 */
class AuthenticationController
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
//    public function setEntityManager(EntityManager $entityManager)
//    {
//        $this->entityManager = $entityManager;
//
//        // End.
//        return $this;
//    }

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
        return array();
    }

    /**
     *
     */
    public function _loginAction()
    {
        $request = $this->getRequest();

        if (!$request->isPost() || (null === $request->getPost('user'))) {
            return new JsonModel(
                array(
                'message' => 'No authentication credentials received.',
                'success' => false
                )
            );
        }

        $postData = Json::decode(
                $request->getPost('user', '{}'), Json::TYPE_ARRAY
        );

        $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        $adapter = $authService->getAdapter();
        $adapter->setIdentityValue($postData['auth_identity']);
        $adapter->setCredentialValue($postData['auth_credential']);

        $authResult = $authService->authenticate();

        if (!$authResult->isValid()) {
            var_dump($authResult);
            die('Not logged in.');
        }

        die('Logged in.');
    }

    /**
     * Common action description.
     *
     * @return Zend\View\Model\ViewModel
     */
    public function loginAction()
    {
        $user = 'WitteStier';
        $pass = '123456';

        $request = $this->getRequest();

        if (!$request->isPost() || (null === $request->getPost('user'))) {
            return new JsonModel(
                array(
                'message' => 'No authentication credentials received.',
                'success' => false
                )
            );
        }

        $userModel = Json::decode(
                $request->getPost('user', '{}'), Json::TYPE_ARRAY
        );

        if (($user != $userModel['identity']) || ($pass != $userModel['credential'])) {
            return new JsonModel(
                array(
                'message' => 'Invalid username or password.',
                'success' => false
                )
            );
        }

        $session = new sessionContainer('dev');
        $session->setExpirationHops(5);
        $session->offsetSet('isAuthenticated', true);

        return $this->forward()->dispatch('system', array('action' => 'get-user'));
    }

    /**
     * Common action description.
     *
     * @return Zend\View\Model\ViewModel
     */
    public function logoutAction()
    {
        // Remove the session userObject
    }

}