/**
 * User.js
 * Created on Jan 20, 2013 11:58:59 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.model.application.User', {
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
        }],
//    validations: [],
    proxy: {
        type: 'ajax',
        url: '~authentication/login',
        reader: {
            type: 'json',
            root: 'user',
            messageProperty: 'message'
        },
        writer: {
            type: 'json',
            nameProperty: 'mapping',
//            allowSingle: true,
            encode: true,
            root: 'user'
        }
    }

});