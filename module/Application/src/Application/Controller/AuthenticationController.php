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
    Application\Entity\User,
    Application\Entity\Messages;

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

    private $invalidLoginResponseMessage = 'Invalid username or password.';
    private $lockoutResponseMessage = 'Your account is temporary blocked until %s.';
    private $lockoutMessageSubject = 'Your account is temporary blocked.';
    private $lockoutMessage = 'Your account is temporary blocked until %s.';

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
            return $this->getIvalidLoginResponse();
        }

        $user = new User();
        $user->populate($postData);

        $identity = $this->getEntityManager()->getRepository('Application\Entity\User')
            ->findOneBy(array(
            'identity' => $user->getIdentity()
        ));

        $identity instanceof Entity\User;

        if (!$identity) {
            // End.
            return $this->getIvalidLoginResponse();
        }

        // Check if the user is locked out.
        if ($identity->isLockedOut()) {
            $this->invalidLoginResponseMessage = sprintf(
                $this->lockoutResponseMessage, $identity->getLockoutDateTime()->format('r')
            );

            $this->increaseAttept($identity);

            // End.
            return $this->getIvalidLoginResponse();
        }

        // The user does exists, now check the credential.
        $user->saltCredential($identity);

        if ($user->getCredential() !== $identity->getCredential()) {
            $this->increaseAttept($identity);

            // End. the credentials do not match.
            return $this->getIvalidLoginResponse(false);
        }

        if ($identity->getAttempts() >= $identity->getAttemptsToLockout()) {
            $person = $identity->getPersons();
            $message = new Messages(
                $person, $this->lockoutMessageSubject, sprintf($this->lockoutMessage, $identity->getLockoutDateTime()->format('r'))
            );

            $this->entityManager->persist($message);
            $this->entityManager->flush();
        }

        $identity->setAttempts(0);
        $this->getEntityManager()->flush();

        // Store the identity in a session object.
        $session = new AuthSession();
//        $session->clear();
//        $session->write($identity);
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

        $user = new User();
        $filter = $user->getAuthenticateInputFilter();
        $filter->setData($postData);
        $userIsValid = $filter->isValid();

        // End.
        return ((true === $csrfIsValid) && (true === $userIsValid));
    }

    /**
     * COMMENTME
     * 
     * @param \Application\Entity\User $user
     * @param boolean $sleep
     * @return \Zend\View\Model\JsonModel
     */
    private function getIvalidLoginResponse($sleep = true)
    {
        $csrf = new CsrfValidator();
        $csrfToken = $csrf->getHash(true);

        $user = new User();
        $user->setVerifyToken($csrfToken);

        $responseConfig = array(
            'success' => true,
            'message' => $this->invalidLoginResponseMessage,
            'user' => $user->getArrayCopy(array('identity', 'credential', 'verify_token'))
        );

        // Sleep for security reasons.
        if ($sleep) {
            sleep(1);
        }

        // Send a authentication shell.
        return new JsonModel($responseConfig);
    }

    /**
     * COMMENTME
     * 
     * @param Application\Entity\User $identity
     * @return boolean
     */
    private function increaseAttept(\Application\Entity\User $identity)
    {
        $identity->increaseAttept();
        $identity->setLastAttempt(new \DateTime());
        $this->getEntityManager()->flush();

        // End.
        return true;
    }

}

