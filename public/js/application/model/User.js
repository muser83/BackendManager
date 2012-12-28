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
    uses: [
        'App.model.Person'
    ],
//    idProperty: 'id',
//    persistenceProperty: 'data',
//    hasMany: [{
//            model: 'associated_model_name',
//            name: 'getAssociatedModelStore', // GetModelStore ?
//            associationKey: 'associated_data_name',
//            foreignKey: 'id', // lowercased name of the owner model plus "_id".
//            primaryKey: 'id', // Associated model primary key.
//            autoLoad: false,
//            filterProperty: undefined,
//            storeConfig: undefined
//        }],
    hasOne: [{
            model: 'App.model.Person',
            getterName: 'getPerson',
            setterName: 'setPerson',
            associationKey: 'person',
            foreignKey: 'personsId',
            primaryKey: 'id'
        }],
//    belongsTo: [{
//            model: 'owner_model_name',
//            getterName: 'getOwnerModel',
//            setterName: 'setOwnerModel',
//            associationKey: 'owner_data_name',
//            foreignKey: 'id', // lowercased name of the owner model plus "_id".
//            primaryKey: 'id' // Owner model primary key.
//        }],
//    validations: [],
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
    proxy: {
        type: 'ajax',
        url: '~system/get-user',
        reader: {// Json reader defaults.
            type: 'json',
            root: 'user',
            messageProperty: 'message'
        },
        writer: {
            type: 'json',
            nameProperty: 'name',
            writeAllFields: true,
            allowSingle: true,
            encode: true,
            root: 'user',
            getRecordData: function(record) {
                Ext.apply(record.data, record.getAssociatedData());
                return record.data;
            }
        }
    }
});