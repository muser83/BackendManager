/**
 * Users.js
 * Created on Dec 28, 2012 5:43:08 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */

Ext.create('Ext.data.Store', {
    storeId: 'usersStore',
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

Ext.define('App.view.admin.users.grid.Users', {
    extend: 'Ext.grid.Panel',
    store: Ext.data.StoreManager.lookup('usersStore'),
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
            text: 'Locales ID',
            dataIndex: 'locales_id'
        }, {
            text: 'Persons ID',
            dataIndex: 'persons_id'
        }, {
            text: 'Is verified',
            dataIndex: 'isVerified'
        }, {
            text: 'Is active',
            dataIndex: 'isActive'
        }, {
            text: 'Identity',
            dataIndex: 'orginal',
            hideable: false,
            flex: 1
        }, {
            text: 'Verify token',
            dataIndex: 'orginal',
            flex: 1
        }],
    /* */
    initComponent: function()
    {
        this.callParent();
    }
});