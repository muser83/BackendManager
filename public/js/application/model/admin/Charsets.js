/**
 * Charsets.js
 * Created on Jan 6, 2013 10:32:41 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.model.admin.Charsets', {
    extend: 'App.model.Charsets',
    listners: {
    },
    proxy: {
        type: 'ajax',
        url: '/admin/data/charsets',
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
//            nameProperty: 'name',
//            writeAllFields: true,
//            allowSingle: true,
//            encode: false,
            root: 'data'
        }
    }
});