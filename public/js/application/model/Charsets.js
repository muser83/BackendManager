/**
 * Charsets.js
 * Created on Jan 6, 2013 10:32:41 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.model.Charsets', {
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
//    validations: [],
    fields: [{
            name: 'id',
            type: 'int'
        }, {
            name: 'isVisible',
            type: 'boolean',
            defaultValue: false
        }, {
            name: 'name',
            type: 'string'
        }]
});