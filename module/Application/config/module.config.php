<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

// End.
return array(
    'controllers' => array(
        'invokables' => array(
            'Authentication' => 'Application\Controller\AuthenticationController',
            'Docs' => 'Application\Controller\DocsController',
            'Index' => 'Application\Controller\IndexController',
            'System' => 'Application\Controller\SystemController'
        ),
    ),
    'router' => array(
        'routes' => array(
            'default' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'application' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/~',
                    'defaults' => array(
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                        ),
                    ),
                ),
            ),
            'docs' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/~docs',
                    'defaults' => array(
                        'controller' => 'Docs',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'docsId' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/:documentId',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'documentId' => 'applicationDefault',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'application/system/about' => __DIR__ . '/../view/application/system/about.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
//    'service_manager' => array(
//        'factories' => array(
//            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
//        ),
//    ),
//    'translator' => array(
//        'locale' => 'en_US',
//        'translation_file_patterns' => array(
//            array(
//                'type' => 'gettext',
//                'base_dir' => __DIR__ . '/../language',
//                'pattern' => '%s.mo',
//            ),
//        ),
//    ),
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
        'authentication' => array(
            'orm_default' => array(
                'object_manager' => 'Doctrine\ORM\Entity\Manager',
                'identity_class' => 'Application\Entity\Users',
                'identity_property' => 'identity',
                'credential_property' => 'credential',
                'credentialcallable' => 'Application\Entity\Users::saltCredential'
            ),
        ),
    ),
);
