/**
 * Person.js
 * Created on Dec 27, 2012 12:17:48 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.model.Person', {
    extend: 'Ext.data.Model',
    fields: [{
            name: 'id',
            type: 'int'
        }, {
            name: 'addressesId',
            type: 'int',
            useNull: true
        }, {
            name: 'communicationsId',
            type: 'int',
            useNull: true
        }, {
            name: 'image',
            type: 'string'
        }, {
            name: 'firstname',
            type: 'string'
        }, {
            name: 'middlename',
            type: 'string'
        }, {
            name: 'lastname',
            type: 'string'
        }, {
            name: 'gender',
            type: 'int',
            useNull: true
        }, {
            name: 'fullname',
            convert: function(value, record)
            {
                var fullname = record.get('firstname') + ' ' +
                    record.get('middlename') + ' ' +
                    record.get('lastname');

                return fullname;
            }
        }],
    proxy: {
        type: 'ajax',
        url: '~system/get-person',
        reader: {
            type: 'json',
            root: 'person',
            messageProperty: 'message'
        },
        writer: {
            type: 'json',
            nameProperty: 'name',
            writeAllFields: true,
            allowSingle: true,
            encode: false,
            root: 'person',
            getRecordData: function(record) {
                Ext.apply(record.data, record.getAssociatedData());
                return record.data;
            }
        }
    }
});