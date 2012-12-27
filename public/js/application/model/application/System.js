/**
 * System.js
 * Created on Dec 27, 2012 12:17:48 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.model.application.System', {
    extend: 'Ext.data.Model',
    uses: [
        'App.model.Users'
    ],
    hasOne: [{
            model: 'App.model.Users',
            getterName: 'getUsers',
            setterName: 'setUsers',
            associationKey: 'users',
            foreignKey: 'users_id',
            primaryKey: 'id'
        }],
//    validations: [],
    fields: [{
            name: 'bootTime',
            type: 'date',
            defaultValue: 0
        }, {
            name: 'logonTime',
            type: 'date',
            defaultValue: 0
        }, {
            name: 'logoffTime',
            type: 'date',
            defaultValue: 0
        }, {
            name: 'navigation',
            type: 'string',
            persist: false,
            defaultValue: ''
        }, {
            name: 'toolbar',
            type: 'object',
            persist: false,
            defaultValue: {}
        }, {
            name: 'bebug',
            type: 'object',
            defaultValue: {}
        }],
    proxy: {
        type: 'ajax',
        url: '~system',
        reader: {
            type: 'json',
            root: 'system',
            messageProperty: 'message'
        },
        writer: {
            type: 'json',
            nameProperty: 'name',
            writeAllFields: true,
            allowSingle: true,
            encode: false,
            root: 'system',
            getRecordData: function(record) {
                Ext.apply(record.data, record.getAssociatedData());
                return record.data;
            }
        }
    }
});