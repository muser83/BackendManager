/**
 * Index.js
 * Created on Dec 4, 2012 9:58:43 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */

Ext.define('App.view.admin.locales.grid.Locales', {
    extend: 'Ext.grid.Panel',
    viewConfig: {
        style: {
            overflow: 'auto',
            overflowX: 'hidden'
        }
    },
    emptyText: 'No locales found',
    border: false,
    columns: [{
            text: 'ID',
            dataIndex: 'id',
            hidden: true
        }, {
            text: 'Language ID',
            dataIndex: 'languagesId',
            hideable: false,
            editor: {
                xtype: 'combobox',
                store: 'admin.Languages',
                displayField: 'id',
                valueField: 'id',
                editable: false,
                allowBlank: false,
                tpl: Ext.create('Ext.XTemplate',
                    '<tpl for=".">',
                    '<div class="x-boundlist-item">{id} - {name}</div>',
                    '</tpl>'
                    )
            }
        }, {
            text: 'Country ID',
            dataIndex: 'countriesId',
            hideable: false,
            editor: {
                xtype: 'combobox',
                store: 'admin.Countries',
                displayField: 'id',
                valueField: 'id',
                editable: false,
                allowBlank: false,
                tpl: Ext.create('Ext.XTemplate',
                    '<tpl for=".">',
                    '<div class="x-boundlist-item">{id} - {name}</div>',
                    '</tpl>'
                    )
            }
        }, {
            text: 'Charset ID',
            dataIndex: 'charsetsId',
            hideable: false,
            editor: {
                xtype: 'combobox',
                store: 'admin.Charsets',
                displayField: 'id',
                valueField: 'id',
                editable: false,
                allowBlank: false,
                tpl: Ext.create('Ext.XTemplate',
                    '<tpl for=".">',
                    '<div class="x-boundlist-item">{id} - {name}</div>',
                    '</tpl>'
                    )
            }
        }, {
            text: 'Is visible',
            dataIndex: 'isVisible',
            hideable: false,
            editor: {
                xtype: 'checkbox',
                allowBlank: false
            }
        }, {
            text: 'Name',
            dataIndex: 'name',
            hideable: false,
            flex: 1,
            editor: {
                xtype: 'textfield',
                allowBlank: false
            }
        }],
    initComponent: function()
    {
        this.callParent();
    }
});