<?php

/**
 * module.config.php
 * Created on Sep 16, 2012 6:11:22 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   LGPL
 * @copyright 2012 witteStier.nl
 */

namespace Admin;

// End.
return array(
    'controllers' => array(
        'invokables' => array(
            // Define all invokable module controller.
            'Data' => 'Admin\Controller\DataController',
            'Countries' => 'Admin\Controller\CountriesController',
            'Locales' => 'Admin\Controller\LocalesController',
            'Admin\Controller\Index' => 'Admin\Controller\IndexController'
        ),
    ),
    'router' => array(
        'routes' => array(
            // Module route.
            'admin' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin[/:controller][/:action]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action' => 'index'
                    ),
                ),
            ),
            'data' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/data[/:entity[/:id]]',
                    'constraints' => array(
                        'entity' => '[a-z]*',
                        'id' => '[0-9]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Data',
                    ),
                ),
            )
        // End module route.
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'admin' => __DIR__ . '/../view'
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
    ),
);