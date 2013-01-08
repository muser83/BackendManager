/**
 * Timezones.js
 * Created on Dec 27, 2012 12:17:48 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.model.Timezones', {
    extend: 'Ext.data.Model',
//    uses: [
//        'associated_model_name'
//    ],
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
//    hasOne: [{
//            model: 'associated_model_name',
//            getterName: 'getAssociatedModel',
//            setterName: 'setAssociatedModel',
//            associationKey: 'associated_data_name',
//            foreignKey: 'id', // lowercased name of the owner model plus "_id".
//            primaryKey: 'id' // Associated model primary key.
//        }],
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
            type: 'int',
            useNull: true
        }, {
            name: 'is_visible',
            type: 'boolean',
            defaultValue: false
        }, {
            name: 'name',
            type: 'string'
        }]
});