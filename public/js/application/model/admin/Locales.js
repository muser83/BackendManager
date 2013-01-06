/**
 * Locales.js
 * Created on Dec 27, 2012 12:17:48 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.model.admin.Locales', {
    extend: 'Ext.data.Model',
//    uses: [
//        'associated_model_name'
//    ],
//    idProperty: 'id',
//    persistenceProperty: 'data',
//    hasMany: [{
//        model: 'associated_model_name',
//        name: 'getAssociatedModelStore', // GetModelStore ?
//        associationKey: 'associated_data_name',
//        foreignKey: 'id', // lowercased name of the owner model plus "_id".
//        primaryKey: 'id', // Associated model primary key.
//        autoLoad: false,
//        filterProperty: undefined,
//        storeConfig: undefined
//    }],
//    hasOne: [{
//        model: 'associated_model_name',
//        getterName: 'getAssociatedModel',
//        setterName: 'setAssociatedModel',
//        associationKey: 'associated_data_name',
//        foreignKey: 'id', // lowercased name of the owner model plus "_id".
//        primaryKey: 'id' // Associated model primary key.
//    }],

    validations: [],
    fields: [{
            name: 'id',
            type: 'int'
        }, {
            name: 'languagesId',
            type: 'int'
        }, {
            name: 'countriesId',
            type: 'int'
        }, {
            name: 'charsetsId',
            type: 'int'
        }, {
            name: 'isVisible',
            type: 'boolean',
            defaultValue: false
        }, {
            name: 'name',
            type: 'string'
        }],
    listners: {
    },
    proxy: {
        type: 'ajax',
        url: '/admin/data/locales',
//        startParam: 'start',
//        limitParam: 'limit',
//        pageParam: 'page',
//        // Cache
//        noCache: true,
//        cacheString: '_dc',
//        // Save
//        idParam: 'id',
//        batchActions: true,
//        batchOrder: 'create,update,destroy',
//        // Filter
//        filterParam: 'filter',
//        // Group
//        groupParam: 'group',
//        simpleGroupMode: false,
//        groupDirectionParam: 'groupDir',
//        // Sort
//        sortParam: 'sort',
//        simpleSortMode: false,
//        directionParam: 'dir',
//        listeners: {
//        },
//        api: {
//            create: undefined,
//            read: undefined,
//            update: undefined,
//            destroy: undefined
//        },
//        headers: {
//        },
//        extraParams: {
//        },
        reader: {// Json reader defaults.
            type: 'json',
            root: 'data',
//            idProperty: 'id',
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
            writeAllFields: true,
//            allowSingle: true,
            encode: true,
            root: 'data',
            getRecordData: function(record) {
                // End.
                return record.getData(true);
            }
        }
    }
});