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
    Zend\Authentication\Storage\Session as AuthSession,
    Zend\Validator\Csrf as CsrfValidator,
    Doctrine\ORM\EntityManager,
    Application\Entity\Users;

/**
 * Controller description
 *
 * @package    name
 * @subpackage name
 */
class AuthenticationController
    extends AbstractActionController
{

    CONST AUTHENTICATION_SESSION_NAME = 'authentication';

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
    public function loginAction()
    {
        $request = $this->getRequest();

        if (!$request->isPost() || (null === $request->getPost('user'))) {
            // End.
            return $this->getIvalidLoginResponse(false);
        }

        $postData = Json::decode(
                $request->getPost('user', '{}'), Json::TYPE_ARRAY
        );

        // Check if the login attempt is valid.
        $isValidAttempt = $this->isValidLogin($postData);

        if (!$isValidAttempt) {
            // End.
//            return $this->getIvalidLoginResponse();
        }

        $user = new Users();
        $user->populate($postData);

        $repository = $this->getEntityManager()->getRepository('Application\Entity\Users');
        $identity = $repository->findOneBy(array(
            'identity' => $user->getIdentity()
        ));

        if (!$identity) {
            // End.
            return $this->getIvalidLoginResponse();
        }

        // The user does exists, now check the credential.
        $user->saltCredential($identity);

        if ($user->getCredential() !== $identity->getCredential()) {
            // End. the credentials do not match.
            return $this->getIvalidLoginResponse(false);
        }

        // Store the identity in a session object.
        $session = new AuthSession();
//        $session->clear();
        $session->write($identity);

        // End. forward to the system controller.
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

    /**
     * COMMENTME
     * 
     * @param array $postData
     * @return boolean
     */
    private function isValidLogin(array $postData)
    {
        $csrfToken = isset($postData['verify_token'])
            ? $postData['verify_token']
            : null;

        $csrf = new CsrfValidator();
        $csrfIsValid = $csrf->isValid($csrfToken);
        $csrf->getHash(true); // Flush csrf token.

        $user = new Users();
        $filter = $user->getInputFilter();
        $filter->setData($postData);
        $userIsValid = $filter->isValid();

        // End.
        return ((true === $csrfIsValid) && (true === $userIsValid));
    }

    /**
     * COMMENTME
     * 
     * @param \Application\Entity\Users $user
     * @param boolean $sleep
     * @return \Zend\View\Model\JsonModel
     */
    private function getIvalidLoginResponse($sleep = true)
    {
        $csrf = new CsrfValidator();
        $csrfToken = $csrf->getHash(true);

        $user = new Users();
        $user->setVerifyToken($csrfToken);
        $user->excludeFields(array(
            'id', 'locales_id', 'persons_id', 'settings_id', 'is_verified',
            'is_active', 'salt', 'locales', 'persons', 'settings'
        ));

        $responseConfig = array(
            'success' => true,
            'user' => $user->getArrayCopy()
        );

        // Sleep for security reasons.
        if ($sleep) {
            sleep(2);
        }

        // Send a authentication shell.
        return new JsonModel($responseConfig);
    }

}

