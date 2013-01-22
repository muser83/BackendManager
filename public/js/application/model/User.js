/**
 * User.js
 * Created on Dec 27, 2012 12:17:48 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.model.User', {
    extend: 'Ext.data.Model',
    fields: [{
            name: 'id',
            type: 'int'
        }, {
            name: 'localesId',
            type: 'int'
        }, {
            name: 'personsId',
            type: 'int'
        }, {
            name: 'isVerified',
            type: 'boolean',
            defaultValue: false
        }, {
            name: 'isActive',
            type: 'boolean',
            defaultValue: false
        }, {
            name: 'identity',
            type: 'string'
        }, {
            name: 'credential',
            type: 'string'
        }, {
            name: 'salt',
            type: 'string'
        }, {
            name: 'verifyToken',
            type: 'string'
        }]
});