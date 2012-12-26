<?php

/**
 * Module.php
 * Created on Sep 16, 2012 6:00:14 PM
 *
 * Note:
 * This ZF2 module template file is a part of the required ZF2 module
 * configuration. Please respect the Create date, Author and Copyright of the
 * module logical files like controllers and models.
 *
 * Extra information:
 * http://framework.zend.com
 * /manual/2.0/en/modules/zend.module-manager.module-manager.html
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @copyright 2012 witteStier.nl
 */

namespace Admin;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface,
    Zend\ModuleManager\Feature\ConfigProviderInterface,
    Zend\ModuleManager\Feature\InitProviderInterface,
    Zend\ModuleManager\Feature\LocatorRegisteredInterface,
    Zend\ModuleManager\Feature\BootstrapListenerInterface,
    Zend\ModuleManager\Feature\ServiceProviderInterface,
    Zend\ModuleManager\ModuleManagerInterface,
    Zend\EventManager\EventInterface;

class Module
    implements AutoloaderProviderInterface,
               ConfigProviderInterface,
               InitProviderInterface,
               LocatorRegisteredInterface,
               BootstrapListenerInterface,
               ServiceProviderInterface
{
    //

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
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php'
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
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
        // End.
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
        // End.
        return array();
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
        return array();
    }

}