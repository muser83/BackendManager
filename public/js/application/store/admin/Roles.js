Ext.define('App.store.<module>.Roles', {
    extend: 'Ext.data.Store',
    // Config
    model: '',
    autoLoad: false,
    pageSize: 25,
    clearRemovedOnLoad: true,
    // Sync and save
    autoSync: false,
    batchUpdateMode: 'operation', // 'operation' | 'complete'
    // Preload and buffering
    buffered: false,
    leadingBufferZone: 200,
    trailingBufferZone: 25,
    purgePageCount: 5,
    clearOnPageLoad: true,
    // Filter
    filterOnLoad: true,
    remoteFilter: false,
    // Group
    groupDir: 'ASC', // 'ASC' | 'DESC'
    groupField: 'id',
    remoteGroup: false,
    // Sort
    sortOnLoad: true,
    sortOnFilter: false,
    remoteSort: false,
    filters: [],
    data: [],
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
            successProperty: 'sucess',
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