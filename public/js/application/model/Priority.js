/**
 * Priority.js
 * Created on Feb 4, 2013 1:01:16 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.model.Priority', {
    extend: 'Ext.data.Model',
    validations: [],
    fields: [{
            name: 'id',
            type: 'int'
        }, {
            name: 'name',
            type: 'string'
        }, {
            name: 'desc',
            type: 'string'
        }],
    listners: {
    }
});