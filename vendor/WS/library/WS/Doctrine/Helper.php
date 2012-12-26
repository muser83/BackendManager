<?php

/**
 * Helper.php
 * Created on Dec 16, 2012 9:55:06 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   LGPL
 * @copyright 2012 witteStier.nl
 */

namespace WS\Doctrine;

abstract class Helper
{

    /**
     * @param \WS\Doctrine\Entity\Helper $entity
     * @return array
     */
    public static function toArray(Helper $entity)
    {
        $data = array();

        // End.
        return $data;
    }

    /**
     * @param array $entities
     * @return array
     */
    public static function toArrayRecursive(array $entities)
    {
        $data = array();

        // End.
        return $data;
    }

    /**
     * @return array
     */
    public function getFieldValues()
    {
        // End.
        return get_class_vars($this);
    }

}