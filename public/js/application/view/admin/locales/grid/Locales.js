/**
 * Index.js
 * Created on Dec 4, 2012 9:58:43 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */

Ext.create('Ext.data.Store', {
    storeId: 'localesStore',
    fields: [
        'id', 'languages_id', 'countries_id', 'is_visible', 'name'
    ],
    data: {
        items: []
    },
    proxy: {
        type: 'memory',
        reader: {
            type: 'json',
            root: 'items'
        }
    }
});

Ext.define('App.view.admin.locales.grid.Locales', {
    extend: 'Ext.grid.Panel',
    store: Ext.data.StoreManager.lookup('localesStore'),
    scroll: false,
    viewConfig: {
        style: {overflow: 'auto', overflowX: 'hidden'}
    },
    emptyText: '',
    border: false,
    columns: [{
            text: 'ID',
            dataIndex: 'id'
        }, {
            text: 'Languages ID',
            dataIndex: 'languages_id'
        }, {
            text: 'Countries ID',
            dataIndex: 'countries_id'
        }, {
            text: 'Is visible',
            dataIndex: 'is_visible'
        }, {
            text: 'Name',
            dataIndex: 'name',
            hideable: false,
            flex: 1
        }],
    initComponent: function()
    {
        this.callParent();
    }
});