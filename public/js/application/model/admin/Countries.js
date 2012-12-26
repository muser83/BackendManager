/**
 * Countries.js
 * Created on Dec 27, 2012 12:17:48 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.model.admin.Countries', {
    extend: 'Ext.data.Model',
    uses: [
//        'App.model.admin.Continents',
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
            getterName: 'getContinentsModel',
            setterName: 'setContinents',
            associationKey: 'continents',
            foreignKey: 'continents_id',
            // lowercased name of the owner model plus "_id".
            primaryKey: 'id' // Associated model primary key.
//        },
//        {
//            model: 'App.model.admin.Currencies',
//            getterName: 'getCurrenciesModel',
//            setterName: 'setCurrenciesModel',
//            associationKey: 'currencies',
//            foreignKey: 'currencies_id',
//            // lowercased name of the owner model plus "_id".
//            primaryKey: 'id' // Associated model primary key.
        }
    ],
//    belongsTo: [{
//        model: 'owner_model_name',
//        getterName: 'getOwnerModel',
//        setterName: 'setOwnerModel',
//        associationKey: 'owner_data_name',
//        foreignKey: 'id', // lowercased name of the owner model plus "_id".
//        primaryKey: 'id' // Owner model primary key.
//    }],
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
        }, {
            name: 'continent',
            mapping: 'continents.name'
        }],
    listners: {},
    proxy: {// Server proxy.
        type: 'rest',
        url: '/admin/data/countries',
//        startParam: 'start',
//        limitParam: 'limit',
//        pageParam: 'page',
        // Cache
//        noCache: true,
//        cacheString: '_dc',
        // Save
//        idParam: 'id',
//        batchActions: true,
//        batchOrder: 'create,update,destroy',
        // Filter
//        filterParam: 'filter',
        // Group
//        groupParam: 'group',
//        simpleGroupMode: false,
//        groupDirectionParam: 'groupDir',
        // Sort
//        sortParam: 'sort',
//        simpleSortMode: false,
//        directionParam: 'dir',
//        listeners: {},
//        api: {
//            create: undefined,
//            read: undefined,
//            update: undefined,
//            destroy: undefined
//        },
//        headers: {},
//        extraParams: {},
        reader: {
            type: 'json',
            root: 'data',
            idProperty: 'id',
//            implicitIncludes: true,
//            readRecordsOnFailure: true,
//            useSimpleAccessors: false,
//            messageProperty: 'message',
//            metaProperty: 'metaData',
//            successProperty: 'success',
//            totalProperty: 'total'
        },
        writer: {
            type: 'json',
//            nameProperty: 'name',
//            writeAllFields: true,
//            allowSingle: true,
//            encode: false,
            root: 'data'
        }
    }
});