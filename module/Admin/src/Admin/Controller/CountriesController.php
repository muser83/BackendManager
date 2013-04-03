<?php

/**
 * CountriesController.php
 *
 * Created on Jan 31, 2013 10:03:29 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   LGPL
 * @copyright WitteStier - witteStier.nl
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Zend\View\Model\JsonModel,
    Doctrine\ORM\EntityManager,
    Admin\Doctrine\Helper AS EntityHelper;

/**
 * COMMENTME
 */
class CountriesController
    extends AbstractActionController
{

    /**
     * Instance of \Doctrine\ORM\EntityManager.
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * Set an instance of \Doctrine\ORM\EntityManager.
     *
     * @param \Doctrine\ORM\EntityManager $em
     * @return \Admin\Controller\CountriesController
     */
    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;

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
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');
        }

        // End.
        return $this->em;
    }

    /**
     * Common action description.
     *
     * @return Zend\View\Model\JsonModel
     */
    public function indexAction()
    {
//        $criteria = array('isVisible' => true);
//        $orderBy = array('id' => 'ASC');
//        $limit = $this->params()->fromQuery('limit', 25);
//        $offset = $this->params()->fromQuery('start', 0);
//
//        try {
//            $repository = $this->getEntityManager()->getRepository('Admin\Entity\Countries');
//            $entities = $repository->findBy($criteria, $orderBy, $limit, $offset);
//            $data = EntityHelper::toArrayRecursive($entities);
//            $total = $this->getEntityManager()
//                ->createQuery('SELECT COUNT(r) FROM Admin\Entity\Countries AS r')
//                ->getSingleScalarResult();
//        } catch (\Exception $e) {
//            // End.
//            return new JsonModel(
//                array(
//                'success' => false,
//                'message' => 'Unexpected exception in file: ' . $e->getFile() .
//                '.\nWith messages:\n' . $e->getMessage()
//                )
//            );
//        }
        // End.
        return new JsonModel(
            array(
            'success' => true,
            'message' => 'Ok.',
//            'total' => $total,
//            'countries' => $data,
            )
        );
    }

}

