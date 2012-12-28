/**
 * Translate.js
 * Created on Dec 28, 2012 5:38:11 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */

Ext.create('Ext.data.Store', {
    storeId: 'translateStore',
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

Ext.define('App.view.admin.translate.grid.Translate', {
    extend: 'Ext.grid.Panel',
    store: Ext.data.StoreManager.lookup('rolesStore'),
    scroll: false,
    viewConfig: {
        style: {
            overflow: 'auto',
            overflowX: 'hidden'
        }
    },
    emptyText: '',
    border: false,
    columns: [{
            text: 'ID',
            dataIndex: 'id'
        }, {
            text: 'Orginal',
            dataIndex: 'orginal',
            hideable: false,
            flex: 1
        }, {
            text: 'Translation',
            dataIndex: 'translation',
            hideable: false,
            flex: 1
        }],
    /* */
    initComponent: function()
    {
        this.callParent();
    }
});