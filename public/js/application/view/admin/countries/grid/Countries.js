/**
 * Index.js
 * Created on Dec 4, 2012 9:58:43 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */

Ext.define('App.view.admin.countries.grid.Countries', {
    extend: 'Ext.grid.Panel',
    viewConfig: {
        style: {
            overflow: 'auto',
            overflowX: 'hidden'
        }
    },
    columns: [{
            text: 'ID',
            dataIndex: 'id',
            hidden: true
        }, {
            text: 'Continents ID',
            dataIndex: 'continentsId',
            hideable: false,
            editor: {
                xtype: 'combobox',
                store: 'admin.Continents',
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
            text: 'Currencies ID',
            dataIndex: 'currenciesId',
            hideable: false,
            editor: {
                xtype: 'combobox',
                store: 'admin.Currencies',
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
            text: 'Visible',
            type: 'boolean',
            dataIndex: 'isVisible',
            hideable: false,
            editor: {
                xtype: 'checkbox',
                allowBlank: false
            }
        }, {
            text: 'Name',
            locked: true,
            dataIndex: 'name',
            hideable: false,
            width: 200,
//            flex: 1,
            editor: {
                xtype: 'textfield',
                allowBlank: false
            }
        }, {
            text: 'Local name',
            dataIndex: 'localName',
            hideable: false,
            flex: 1,
            editor: {
                xtype: 'textfield',
                allowBlank: false
            }
        }, {
            text: 'ISO 3166-2',
            dataIndex: 'iso31662',
            hideable: false,
            editor: {
                xtype: 'textfield',
                allowBlank: false
            }
        }, {
            text: 'ISO 3166-3',
            dataIndex: 'iso31663',
            hideable: false,
            editor: {
                xtype: 'textfield',
                allowBlank: false
            }
        }, {
            text: 'Tld',
            dataIndex: 'tld',
            hideable: false,
            editor: {
                xtype: 'textfield',
                allowBlank: false
            }
        }, {
            text: 'Calling code',
            dataIndex: 'callingCode',
            hideable: false,
            editor: {
                xtype: 'textfield',
                allowBlank: false
            }
        }],
    border: false,
    emptyText: 'No countries found.',
    listeners: {
        'selectionchange': function(countriesGrid, selected) {
            this.down('toolbar button[action=edit]').setDisabled(
                !selected.length);

            this.down('toolbar button[action=delete]').setDisabled(
                !selected.length);
        }
    },
    initComponent: function()
    {
        this.callParent();
    }
});