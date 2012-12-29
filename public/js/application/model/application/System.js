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
        'App.model.User'
    ],
    hasOne: [{
            model: 'App.model.User',
            getterName: 'getUser',
            setterName: 'setUser',
            associationKey: 'user',
            foreignKey: 'userId',
            primaryKey: 'id'
        }],
//    validations: [],
    fields: [{
            name: 'bootTime',
            type: 'int',
            defaultValue: 0
        }, {
            name: 'logonTime',
            type: 'int',
            defaultValue: 0
        }, {
            name: 'logoffTime',
            type: 'int',
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
            defaultValue: {
            }
        }, {
            name: 'bebug',
            type: 'array',
            defaultValue: []
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
            encode: true,
            root: 'system',
            getRecordData: function(record) {
                Ext.apply(record.data, record.getAssociatedData());
                return record.data;
            }
        }
    }
});