<?php

/**
 * DataController.php
 * Created on Dec 9, 2012 9:03:07 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   LGPL
 * @copyright 2012 witteStier.nl
 */

namespace Admin\Controller;

//use
//Zend\Mvc\Controller\AbstractActionController,
//    Zend\View\Model\ViewModel,
use Zend\Mvc\Controller\AbstractRestfulController,
    Zend\View\Model\JsonModel,
    Zend\Json\Decoder AS JsonDecode,
    Doctrine\ORM\EntityManager,
    Admin\Doctrine\Helper AS EntityHelper;

/**
 * Controller description
 *
 * @package    name
 * @subpackage name
 */
class DataController
    extends AbstractRestfulController
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

    /**
     * Return list of resources
     *
     * @return mixed
     */
    public function getList()
    {
        $entityNamespace = 'Admin\Entity\\';
        $entityName = $this->params('entity', false);
        if (!$entityName) {
            // End.
            return new JsonModel(
                array(
                'success' => false,
                'messages' => 'Missing source identifier.\n' .
                'Make sure the first argument is an valid data source name.'
                )
            );

            // TODO Remove
            throw new \Zend\Mvc\Exception\DomainException(
            'Missing data identifier.' .
            'Make sure the first argument is an valid Entity name.'
            );
        }

        $entityClass = ($entityNamespace . $entityName);
        if (!class_exists($entityClass)) {
            // End.
            return new JsonModel(
                array(
                'success' => false,
                'messages' => 'Unknown source identifier.\n' .
                'Make sure the first argument is an valid data source name.'
                )
            );

            // TODO Remove
            throw new \Zend\Mvc\Exception\DomainException(
            "Entity '{$entityClass}' does not exists." .
            'Make sure the first argument is an valid Entity name.'
            );
        }
        $criteria = array('isVisible' => true);
        $orderBy = array('id' => 'ASC');
        $limit = $this->params()->fromQuery('limit', 25);
        $offset = $this->params()->fromQuery('start', 0);

        try {
            $repository = $this->getEntityManager()->getRepository($entityClass);
            $entities = $repository->findBy($criteria, $orderBy, $limit, $offset);
            $data = EntityHelper::toArrayRecursive($entities);
            $total = $this->getEntityManager()
                ->createQuery('SELECT COUNT(t) FROM ' . $entityClass . ' AS t')
                ->getSingleScalarResult();
        } catch (\Exception $e) {
            // End.
            return new JsonModel(
                array(
                'success' => false,
                'messages' => 'Unexpected exception in file: ' . $e->getFile() .
                '.\nWith messages:\n' . $e->getMessage()
                )
            );
        }

        // End.
        return new JsonModel(
            array(
            'success' => true,
            'source' => $entityName,
            'total' => $total,
            'data' => $data,
            )
        );
    }

    /**
     * Return single resource
     *
     * @param  mixed $id
     * @return mixed
     */
    public function get($id)
    {
        $entityName = $this->params('entity', false);
        if (!$entityName) {
            throw new \Zend\Mvc\Exception\DomainException(
            'Missing data identifier.' .
            'Make sure the first argument is an valid Entity name.'
            );
        }

        return new JsonModel(
            array(
            'success' => true,
            'action' => 'get',
            'id' => $id
            )
        );
    }

    /**
     * Create a new resource
     *
     * @param  mixed $data
     * @return mixed
     */
    public function create($data)
    {
        $entityName = $this->params('entity', false);
        if (!$entityName) {
            throw new \Zend\Mvc\Exception\DomainException(
            'Missing data identifier.' .
            'Make sure the first argument is an valid Entity name.'
            );
        }

        return new JsonModel(
            array(
            'success' => true,
            'action' => 'create',
            'data' => $data
            )
        );
    }

    /**
     * Update an existing resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return mixed
     */
    public function update($id, $data)
    {
        $entityNamespace = 'Admin\Entity\\';
        $entityName = $this->params('entity', false);
        if (!$entityName) {
            throw new \Zend\Mvc\Exception\DomainException(
            'Missing data identifier.' .
            'Make sure the first argument is an valid Entity name.'
            );
        }

        $entityClass = ($entityNamespace . $entityName);
        if (!class_exists($entityClass)) {
            throw new \Zend\Mvc\Exception\DomainException(
            "Entity '{$entityClass}' does not exists." .
            'Make sure the first argument is an valid Entity name.'
            );
        }


        $dataJson = (string) isset($data['data']) ? $data['data'] : $data;

        // Find entity
        // Populate entity with new data.
        // Save entity.

        return new JsonModel(
            array(
            'success' => true,
            'messages' => 'updated.',
            'data' => JsonDecode::decode($dataJson)
            )
        );
    }

    /**
     * Delete an existing resource
     *
     * @param  mixed $id
     * @return mixed
     */
    public function delete($id)
    {
        $entityName = $this->params('entity', false);
        if (!$entityName) {
            throw new \Zend\Mvc\Exception\DomainException(
            'Missing data identifier.' .
            'Make sure the first argument is an valid Entity name.'
            );
        }

        return new JsonModel(
            array(
            'success' => true,
            'action' => 'delete',
            'id' => $id,
            'data' => $this->request->getContent()
            )
        );
    }

}