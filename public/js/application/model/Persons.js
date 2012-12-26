/**
 * Persons.js
 * Created on Dec 27, 2012 12:17:48 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.model.Persons', {
    extend: 'Ext.data.Model',
//    hasOne: [{
//        model: 'associated_model_name',
//        getterName: 'getAssociatedModel',
//        setterName: 'setAssociatedModel',
//        associationKey: 'associated_data_name',
//        foreignKey: 'id', // lowercased name of the owner model plus "_id".
//        primaryKey: 'id' // Associated model primary key.
//    }],
    fields: [{
            name: 'id',
            type: 'int'
        }, {
            name: 'users_id',
            type: 'int',
            useNull: true
        }, {
            name: 'addresses_id',
            type: 'int',
            useNull: true
        }, {
            name: 'communications_id',
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
        }]
//    proxy: {
//        type: 'ajax',
//        url: '',
//        api: {
//            create: undefined,
//            read: undefined,
//            update: undefined,
//            destroy: undefined
//        },
//        reader: {
//            type: 'json',
//            root: 'person',
//            messageProperty: 'message'
//        },
//        writer: {
//            type: 'json',
//            root: 'person'
//        }
//    }
});