<?php

/**
 * Helper.php
 * Created on Dec 16, 2012 10:24:58 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   LGPL
 * @copyright 2012 witteStier.nl
 */

namespace Admin\Doctrine;

abstract class Helper
{

    /**
     * @param array $entities
     * @return array
     */
    public static function toArrayRecursive(array $entities)
    {
        $data = array();

        foreach ($entities as $entity) {
            $helperClass = get_class();
            if (!is_subclass_of($entity, $helperClass)) {
                $entityClassname = get_class($entity);
                throw new \Exception(
                "Entity '{$entityClassname}' need to be an instane of '{$helperClass}'."
                );
            }

            $data[] = $entity->getFieldValues();
        }

        // End.
        return $data;
    }

    /**
     * @return array
     */
    public function getFieldValues()
    {
        $fieldValues = array();

        foreach (get_object_vars($this) as $fieldName => $value) {
            if (is_array($value)) {
                $fieldValues[$fieldName] = self::toArrayRecursive($value);
                continue;
            }

            if (is_object($value)) {
                $fieldValues[$fieldName] = $value->getFieldValues();
                continue;
            }

            $fieldValues[$fieldName] = $value;
        }

        // End.
        return $fieldValues;
    }

}