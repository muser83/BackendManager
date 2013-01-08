/**
 * Currencies.js
 * Created on Jan 1, 2013 8:15:33 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */

Ext.define('App.model.Currencies', {
    extend: 'Ext.data.Model',
    validations: [],
    fields: [{
            name: 'id',
            type: 'int',
            useNull: true
        }, {
            name: 'isVisible',
            type: 'boolean',
            defaultValue: false
        }, {
            name: 'name',
            type: 'string'
        }, {
            name: 'iso4217',
            type: 'string'
        }, {
            name: 'symbol',
            type: 'string'
        }, ]
});