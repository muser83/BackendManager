/**
 * Continents.js
 * Created on Dec 27, 2012 12:17:48 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.model.Continents', {
    extend: 'Ext.data.Model',
//    validations: [],
    fields: [{
            name: 'id',
            type: 'int',
            useNull: true
        }, {
            name: 'is_visible',
            type: 'boolean',
            defaultValue: false
        }, {
            name: 'name',
            type: 'string'
        }]
});