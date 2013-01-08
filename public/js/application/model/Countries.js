/**
 * Countries.js
 * Created on Dec 27, 2012 12:17:48 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.model.Countries', {
    extend: 'Ext.data.Model',
    uses: [
        'App.model.admin.Continents',
        'App.model.admin.Currencies',
//        'App.model.admin.Timezones'
    ],
//    hasMany: [{
//            model: 'App.model.admin.Timezones',
//            name: 'getTimezonesStore', // GetModelStore ?
//            associationKey: 'timezones',
//            foreignKey: 'timezones_id',
//            // lowercased name of the owner model plus "_id".
//            primaryKey: 'id', // Associated model primary key.
//            autoLoad: false,
////        filterProperty: undefined,
////        storeConfig: undefined
//        }],
    hasOne: [{
            model: 'App.model.admin.Continents',
            name: 'continents',
            getterName: 'getContinents',
            setterName: 'setContinents',
            associationKey: 'continents',
            foreignKey: 'continents_id',
            primaryKey: 'id'
        }, {
            model: 'App.model.admin.Currencies',
            name: 'currencies',
            getterName: 'getCurrencies',
            setterName: 'setCurrencies',
            associationKey: 'currencies',
            foreignKey: 'currencies_id',
            primaryKey: 'id'
        }],
//    validations: [],
    fields: [{
            name: 'id',
            type: 'int',
            useNull: true
        }, {
            name: 'continentsId',
            type: 'int',
            useNull: true
        }, {
            name: 'currenciesId',
            type: 'int',
            useNull: true
        }, {
            name: 'isVisible',
            type: 'boolean',
            defaultValue: false
        }, {
            name: 'name',
            type: 'string'
        }, {
            name: 'localName',
            type: 'string'
        }, {
            name: 'iso31662',
            type: 'string'
        }, {
            name: 'iso31663',
            type: 'string'
        }, {
            name: 'tld',
            type: 'string'
        }, {
            name: 'callingCode',
            type: 'string'
        }]
});