/**
 * Charsets.js
 * Created on Jan 6, 2013 10:34:14 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */

Ext.define('App.store.Charsets', {
    extend: 'Ext.data.Store',
    // Config
    model: 'App.model.Charsets',
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
    data: []
});