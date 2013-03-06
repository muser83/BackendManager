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
            name: 'locales_id',
            type: 'int'
        }, {
            name: 'persons_id',
            type: 'int'
        }, {
            name: 'is_verified',
            type: 'boolean',
            defaultValue: false
        }, {
            name: 'is_active',
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
            name: 'verify_token',
            type: 'string'
        }]
});