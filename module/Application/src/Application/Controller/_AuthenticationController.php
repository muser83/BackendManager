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
    Zend\View\Model\ViewModel,
    Zend\Json\Json,
    Zend\View\Model\JsonModel,
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
        return array();
    }

    /**
     *
     */
    public function loginAction()
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
    public function _loginAction()
    {
        $user = 'WitteStier';
        $pass = '123456';

        $request = $this->getRequest();
        // User an form to validate the post request.
        // Use the user Entity to get the default user skeleton.
        $userModel = array(
            'id' => 0,
            'is_authenticated' => false,
            'is_verified' => false,
            'auth_identity' => '',
            'auth_credential' => '',
            'cdate' => strtotime(date('Y-m-d H:i:d')),
            'udate' => strtotime(date('Y-m-d H:i:d')),
        );

        if (!$request->isPost() || (null === $request->getPost('user'))) {
            return new JsonModel(
                array(
                'message' => 'No authentication credentials received.',
                'success' => false
                )
            );
        }

        $userModel = array_merge(
            $userModel,
            Json::decode(
                $request->getPost('user', '{}'), Json::TYPE_ARRAY
            )
        );

        if (($user != $userModel['auth_identity']) || ($pass != $userModel['auth_credential'])) {
            return new JsonModel(
                array(
                'message' => 'Invalid username or password.',
                'success' => false
                )
            );
        }

        $userModel = array_merge(
            $userModel,
            array(
            'id' => 1,
            'is_authenticated' => true,
            'is_verified' => true,
            'auth_credential' => null,
            )
        );

        return new JsonModel(
            array(
            'message' => 'Authenticated.',
            'success' => true,
            'user' => $userModel
            )
        );
        // Finaly, handle the login request.
        /**
         * TODO
         * Get the authPlugin
         * Get the auth adapter
         * Set the credentials
         * Authenticate.
         *
         * _If not authenticated
         * See Handle invalid todo.
         * _else
         * Load the User entity and store this information in an session.
         * and return the userObject.
         */
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

    /**
     * Common action description.
     *
     * @return Zend\View\Model\ViewModel
     */
    public function getUserInfoAction()
    {
        // TODO Get this info from an session.
        $userModel = array(
            'id' => 2,
            'is_authenticated' => true,
            'is_verified' => true,
            'auth_identity' => 'WitteStier',
            'auth_credential' => null,
            'cdate' => strtotime(date('Y-m-d H:i:d')),
            'udate' => strtotime(date('Y-m-d H:i:d')),
        );

        return new JsonModel(
            array(
            'message' => 'Authenticated.',
            'success' => true,
            'user' => $userModel
            )
        );
    }

}