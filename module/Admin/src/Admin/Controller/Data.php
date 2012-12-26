<?php

/**
 * Data.php
 * Created on Dec 9, 2012 11:20:11 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   LGPL
 * @copyright 2012 witteStier.nl
 */
return array(
    'countries' => array(
        'id' => 11,
        'continents_id' => 6,
        'currencies_id' => 1,
        'is_visible' => 1,
        'name' => 'Netherlands',
        'local_name' => 'Nederland',
        'iso31662' => 'NL',
        'iso31663' => 'NLD',
        'tld' => '.nl',
        'calling_code' => '+31',
        'continents' => array(
            'id' => 6,
            'is_visible' => 1,
            'name' => 'Europe',
        ),
        'currencies' => array(
            'id' => 1,
            'is_visible' => 1,
            'name' => 'euro',
            'iso4217' => 'EUR',
            'symbol' => '€',
        ),
        'timezones' => array(
            0 => array(
                'id' => 311,
                'is_visible' => 1,
                'name' => 'Europe/Amsterdam',
            ),
            1 => array(
                'id' => 317,
                'is_visible' => 1,
                'name' => 'Europe/Brussels',
            ),
        ),
    )
);