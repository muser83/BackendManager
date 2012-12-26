/**
 * Roles.js
 * Created on Dec 27, 2012 12:17:48 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.model.<module>.Roles', {
    extend: 'Ext.data.Model',
    uses: [
        'associated_model_name'
    ],
    idProperty: 'id',
    persistenceProperty: 'data',
    hasMany: [{
        model: 'associated_model_name',
        name: 'getAssociatedModelStore', // GetModelStore ?
        associationKey: 'associated_data_name',
        foreignKey: 'id', // lowercased name of the owner model plus "_id".
        primaryKey: 'id', // Associated model primary key.
        autoLoad: false,
        filterProperty: undefined,
        storeConfig: undefined
    }],
    hasOne: [{
        model: 'associated_model_name',
        getterName: 'getAssociatedModel',
        setterName: 'setAssociatedModel',
        associationKey: 'associated_data_name',
        foreignKey: 'id', // lowercased name of the owner model plus "_id".
        primaryKey: 'id' // Associated model primary key.
    }],
    belongsTo: [{
        model: 'owner_model_name',
        getterName: 'getOwnerModel',
        setterName: 'setOwnerModel',
        associationKey: 'owner_data_name',
        foreignKey: 'id', // lowercased name of the owner model plus "_id".
        primaryKey: 'id' // Owner model primary key.
    }],
    validations: [],
    fields: [{
        name: 'id',
        type: 'auto', // auto | string | int | float | boolean | date;
        defaultValue: 0,
        mapping: 'associated.model.id',
        dateFormat: undefined, // If type is date.
        persist: true,
        useNull: false, // If int, float = 0; string = ''; boolean = false;
        sortDir: 'ASC',
        convert: function(value, record)
        {
        }
    }],
    listners: {},
    /*
     * Proxy types:
     * Server
     * _Ajax
     * __Rest
     * _Direct
     * _JsonP
     * Client
     * _WebStorage
     * __LocalStorage
     * __SessionStorage
     * _Memory
     * __Rest
     */
    proxy: { // Server proxy.
        type: 'ajax',
        url: '',
        startParam: 'start',
        limitParam: 'limit',
        pageParam: 'page',
        // Cache
        noCache: true,
        cacheString: '_dc',
        // Save
        idParam: 'id',
        batchActions: true,
        batchOrder: 'create,update,destroy',
        // Filter
        filterParam: 'filter',
        // Group
        groupParam: 'group',
        simpleGroupMode: false,
        groupDirectionParam: 'groupDir',
        // Sort
        sortParam: 'sort',
        simpleSortMode: false,
        directionParam: 'dir',
        listeners: {},
        api: {
            create: undefined,
            read: undefined,
            update: undefined,
            destroy: undefined
        },
        headers: {},
        extraParams: {},
        reader: { // Json reader defaults.
            type: 'json',
            root: 'data',
            idProperty: 'id',
            implicitIncludes: true,
            readRecordsOnFailure: true,
            useSimpleAccessors: false,
            messageProperty: 'message',
            metaProperty: 'metaData',
            successProperty: 'success',
            totalProperty: 'total'
        },
        writer: {
            type: 'json',
            nameProperty: 'name',
            writeAllFields: true,
            allowSingle: true,
            encode: false,
            root: 'data'
        }
    }
});