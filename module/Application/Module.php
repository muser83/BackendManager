<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface,
    Zend\ModuleManager\Feature\ConfigProviderInterface,
    Zend\ModuleManager\Feature\InitProviderInterface,
    Zend\ModuleManager\Feature\LocatorRegisteredInterface,
    Zend\ModuleManager\Feature\BootstrapListenerInterface,
    Zend\ModuleManager\Feature\ServiceProviderInterface,
    Zend\ModuleManager\ModuleManagerInterface,
    Zend\EventManager\EventInterface,
    Zend\Authentication\AuthenticationService;
use Zend\Mvc\ModuleRouteListener;

class Module
    implements AutoloaderProviderInterface,
    ConfigProviderInterface,
    InitProviderInterface,
    LocatorRegisteredInterface,
    BootstrapListenerInterface,
    ServiceProviderInterface
{

    /**
     * Return an array for passing to Zend\Loader\AutoloaderFactory.
     *
     * Listner:
     * ZendModuleManagerListenerAutoloaderListener
     *
     * Interface:
     * Zend\ModuleManager\Feature\AutoloaderProviderInterface
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        // End.
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * Listner:
     * ZendModuleManagerListenerConfigListener
     *
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * Initialize workflow.
     *
     * Trigger:
     * ZendModuleManagerListenerInitTrigger
     *
     * Interface:
     * Zend\ModuleManager\Feature\InitProviderInterface
     *
     * @param  ModuleManagerInterface $manager
     * @return void
     */
    public function init(ModuleManagerInterface $manager)
    {
        
    }

    /**
     * Listen to the bootstrap event
     *
     * Listner:
     * ZendModuleManagerListenerOnBootstrapListener
     *
     * Interface:
     * Zend\ModuleManager\Feature\BootstrapListenerInterface
     *
     * @return array
     */
    public function onBootstrap(EventInterface $e)
    {
//        die('foobar');
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * Listner:
     * ZendModuleManagerListenerServiceListener
     *
     * Interface:
     * ServiceProviderInterface
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        // End.
        return array(
            'factories' => array(
                'Zend\Authentication\AuthenticationService' => function($serviceManager) {
                    return $serviceManager->get('doctrine.authenticationservice.orm_default');
                }
            ),
        );
    }

}
