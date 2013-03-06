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
            name: 'addresses_id',
            type: 'int',
            useNull: true
        }, {
            name: 'communications_id',
            type: 'int',
            useNull: true
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
        }]
});