<?php

/**
 * Helper.php
 * Created on Feb 19, 2013 11:27:16 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   license.wittestier.nl
 * @copyright 2013 WitteStier - copyright.wittestier.nl
 */

namespace Application\Entity\Helper;

/**
 * COMMENTME
 */
class Helper
{

    /**
     * COMMENTME
     *
     * @var array
     */
    private $fields = array();

    /**
     * COMMENTME
     *
     * @var array 
     */
    private $blacklist = array();

    /**
     * COMMENTME
     * 
     * @var \ReflectionClass 
     */
    private $reflectionClass;

    /**
     * COMMENTME
     * 
     * @param string $method
     * @param array $arguments
     * @return mixed Helper | Field value
     * @throws \Exception
     */
    public function __call($method, $arguments)
    {
        $action = substr($method, 0, 3);
        $field = $this->underscoreField(
            substr($method, 3)
        );

        if (!$this->isField($field) || !in_array($action, array('set', 'get'))) {
            // End.
            return false;
            throw new \Exception("Field {$field} or method {$method} does not exists.");
        }

        if ('set' == $action) {
            $data = isset($arguments[0])
                ? $arguments[0]
                : null;

            $this->{$field} = $data;

            // End.
            return $this;
        }

        // End.
        return $this->{$field};
    }

    /**
     * COMMENTME
     * 
     * @return array
     */
    public function getArrayCopy()
    {
        $this->collectFieldsData();

        $copy = array();

        foreach ($this->fields as $field) {
            if (in_array($field, $this->blacklist)) {
                // Field is black listed.
                continue;
            }

            $getter = sprintf('get%s', ucfirst($field));

            $data = $this->$getter();

            if (is_object($data) && ($data instanceof self)) {
                $data = $data->getArrayCopy();
            }

            // TODO call the getter.
            $copy[$field] = $data;
        }

        // End.
        return $copy;
    }

    /**
     * COMMENTME
     * 
     * @param type $data
     * @return \Application\Entity\Helper\Helper
     */
    public function populate($data = array())
    {
        foreach ($data as $field => $value) {

            $field = $this->underscoreField($field);

            if (!$this->isField($field)) {
                die($field);
                continue;
            }

            $this->{$field} = $value;
        }

        // End.
        return $this;
    }

    /**
     * COMMENTME
     * 
     * @param string $field
     * @return \Application\Entity\Helper\Helper
     */
    public function excludeField($field)
    {
        if (!in_array($field, $this->blacklist)) {
            $this->blacklist[] = $field;
        }

        // End.
        return $this;
    }

    /**
     * COMMENTME
     * 
     * @param array $fields
     * @return \Application\Entity\Helper\Helper
     */
    public function excludeFields(array $fields)
    {
        foreach ($fields as $field) {
            $this->excludeField($field);
        }

        // End.
        return $this;
    }

    /**
     * COMMENTME
     * 
     * @param string $field
     * @return boolean
     */
    private function isField($field)
    {
        // The entity manager does not call the constructor.
        $this->collectFieldsData();

        // End.
        return (bool) in_array($field, $this->fields);
    }

    /**
     * COMMENTME
     * 
     * @param string $field
     * @return string
     */
    private function underscoreField($field)
    {
        // End.
        return lcfirst(
            trim(
                strtolower(
                    preg_replace('/([A-Z])/', '_$1', $field)
                ), '_'
            )
        );
    }

    /**
     * COMMENTME
     * 
     * @return \Application\Entity\Helper\Helper
     */
    public function collectFieldsData()
    {
        if ($this->fields) {
            // End.
            return $this;
        }

        if (!$this->reflectionClass instanceof \ReflectionClass) {
            $this->reflectionClass = new \ReflectionClass($this);
        }

        $fields = $this->reflectionClass->getProperties(
            \ReflectionProperty::IS_PROTECTED
        );

        foreach ($fields as $field) {
            $this->fields[] = $field->getName();
        }

        // End.
        return $this;
    }

}

