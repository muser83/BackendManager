/**
 * Countries.js
 * Created on Dec 27, 2012 12:17:48 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.model.admin.Countries', {
    extend: 'App.model.Countries',
    listners: {
    },
    proxy: {
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