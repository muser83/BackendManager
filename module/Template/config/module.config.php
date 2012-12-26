<?php

/**
 * module.config.php
 * Created on Sep 16, 2012 6:11:22 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   LGPL
 * @copyright 2012 witteStier.nl
 */

namespace Template\Controller; // TODO Replace Template with the modulename.

// End.
return array(
    'controllers' => array(
        'invokables' => array(
            // Define all invokable module controller.
            'Template\Controller\Index' => 'Template\Controller\IndexController', // TODO Replace Template with the modulename.
        ),
    ),
    'router' => array(
        'routes' => array(
            // Module route.
            'template' => array(// TODO Replace template with the modulename.
                'type' => 'segment',
                'options' => array(
                    'route' => '/template[/:controller][/:action]', // TODO Replace template with the modulename.
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Template\Controller\Index', // TODO Replace Template with the modulename.
                        'action' => 'index',
                    ),
                ),
            ),
        // End module route.
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'template' => __DIR__ . '/../view', // TODO Replace Template with the modulename.
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver',
                ),
            ),
        ),
    ),
);