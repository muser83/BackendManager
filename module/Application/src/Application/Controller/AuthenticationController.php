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
    Application\Entity\Message,
    Application\Entity\Log;

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
    private $logMessage;
    private $logUser;

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
     * COMMENTME
     * 
     * @return \Zend\Mvc\Controller\Plugin\Forward
     */
    public function loginAction()
    {
        $request = $this->getRequest();


        if (!$request->isPost() || (null === $request->getPost('user'))) {
            // End.
            return $this->getIvalidLoginResponse(false, 'Request for authentication shell.');
        }

        $postData = Json::decode(
                $request->getPost('user', '{}'), Json::TYPE_ARRAY
        );

        $user = new User();
        $user->populate($postData);

        // Check if the login attempt is valid.
        $isValidAttempt = $this->isValidLogin($user);
        if (!$isValidAttempt) {
            // End.
            return $this->getIvalidLoginResponse(true, 'Invalid post data.');
        }

        $identity = $this->getEntityManager()->getRepository('Application\Entity\User')
            ->findOneBy(array(
            'identity' => $user->getIdentity()
        ));

        $identity instanceof Entity\User;

        if (!$identity) {

            // End.
            return $this->getIvalidLoginResponse(true, 'No identity found.');
        }

        // Check if the user is locked out.
        if ($identity->isLockedOut()) {
            $this->invalidLoginResponseMessage = sprintf(
                $this->lockoutResponseMessage, $identity->getLockoutDateTime()->format('r')
            );

            $this->increaseAttept($identity);

            // End.
            return $this->getIvalidLoginResponse(true, 'User is locked out.', $identity);
        }

        $user->saltCredential($identity);

        if ($user->getCredential() !== $identity->getCredential()) {
            $this->increaseAttept($identity);

            // End. the credentials doesn't match.
            return $this->getIvalidLoginResponse(false, 'Invalid authentication credential.', $identity);
        }

        if ($identity->getAttempts() >= $identity->getAttemptsToLockout()) {
            $person = $identity->getPerson();
            $subject = $this->lockoutMessageSubject;
            $messageStr = sprintf($this->lockoutMessage, $identity->getLockoutDateTime()->format('r'));

            $message = new Message();
            $message->write($person, $subject, $messageStr);

            $this->getEntityManager()->persist($message);
            $this->getEntityManager()->flush();
        }

        $identity
            ->setIsActive(true)
            ->setAttempts(0)
            ->setLastActive(new \DateTime());

        $this->log('Successful authentication.', $identity);

        $this->getEntityManager()->flush();

        // Store the identity in a session object.
        $session = new AuthSession();
        $session->clear();
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
     * @param string $message
     * @param \Application\Entity\User $user
     * @return \Application\Controller\AuthenticationController
     */
    private function log($message, User $user = null)
    {
        $em = $this->getEntityManager();
        $logEvent = $this->getEntityManager()->getReference('Application\Entity\Logevent', 3);

        $log = new Log();
        $log->write($message, $logEvent, $user);

        $em->persist($log);
        $em->flush();

        // End.
        return $this;
    }

    /**
     * COMMENTME
     * 
     * @param \Application\Entity\User $user
     * @return type
     */
    private function isValidLogin(User $user)
    {
        $csrf = new CsrfValidator();
        $csrfIsValid = $csrf->isValid($user->getVerifyToken());
        $csrf->getHash(true); // Flush csrf token.

        $filter = $user->getAuthenticateInputFilter();
        $filter->setData($user->getArrayCopy());
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
    private function getIvalidLoginResponse($sleep = true, $logMessage = null, $logUser = null)
    {
        if (is_string($logMessage)) {
            $this->log($logMessage, $logUser);
        }

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

