/**
 * Index.js
 * Created on Dec 4, 2012 9:58:43 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
var rowEditingPlugin = Ext.create('Ext.grid.plugin.RowEditing', {
    pluginId: 'adminCountriesEditor',
    clicksToMoveEditor: 1,
    errorSummary: false,
    autoCancel: false
});

Ext.define('App.view.admin.countries.grid.Countries', {
    extend: 'Ext.grid.Panel',
    viewConfig: {
        style: {
            overflow: 'auto',
            overflowX: 'hidden'
        }
    },
    loadMask: true,
    border: false,
    emptyText: 'No Countries found.',
    columns: [{
            text: 'ID',
            dataIndex: 'id',
            hidden: true
        }, {
            text: 'Continents ID',
            dataIndex: 'continentsId',
            editor: {
                xtype: 'combobox',
                store: Ext.create('App.store.admin.Continents'),
                displayField: 'name',
                valueField: 'id',
//                minChars: 4,
//                multiSelect: false,
//                forceSelection: false,
//                editable: true,
                allowBlank: false
            }
        }, {
            text: 'Currencies ID',
            dataIndex: 'currenciesId',
            editor: {
                xtype: 'combobox',
                allowBlank: false
            }
        }, {
            text: 'Visible',
            type: 'boolean',
            dataIndex: 'isVisible',
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
            editor: {
                xtype: 'textfield',
                allowBlank: false
            }
        }, {
            text: 'ISO 3166-3',
            dataIndex: 'iso31663',
            editor: {
                xtype: 'textfield',
                allowBlank: false
            }
        }, {
            text: 'Tld',
            dataIndex: 'tld',
            tooltipType: 'qtip',
            tooltip: 'Top Level Domainname',
            editor: {
                xtype: 'textfield',
                allowBlank: false
            }
        }, {
            text: 'Calling code',
            dataIndex: 'callingCode',
            editor: {
                xtype: 'textfield',
                allowBlank: false
            }
        }],
    plugins: [rowEditingPlugin],
    initComponent: function()
    {
        this.callParent();
    }
});