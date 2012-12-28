/**
 * Roles.js
 * Created on Dec 28, 2012 5:32:52 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.create('Ext.data.Store', {
    storeId: 'rolesStore',
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

Ext.define('App.view.admin.roles.grid.Roles', {
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
            text: 'Parent ID',
            dataIndex: 'languages_id'
        }, {
            text: 'Is visible',
            dataIndex: 'is_visible'
        }, {
            text: 'Name',
            dataIndex: 'name',
            hideable: false,
            flex: 1
        }, {
            text: 'Descr',
            dataIndex: 'descr',
            flex: 1
        }],
    /* */
    initComponent: function()
    {
        this.callParent();
    }
});