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
    border: false,
    emptyText: 'No Countries found.',
    plugins: [rowEditingPlugin],
    initComponent: function()
    {
        // TODO Query to the continents and currencies columns and add an store.
        this.columns = [{
                text: 'ID',
                dataIndex: 'id',
                hidden: true
            }, {
                text: 'Continents ID',
                dataIndex: 'continentsId',
                hideable: false,
                editor: {
                    xtype: 'combobox',
                    store: Ext.create('App.store.admin.Continents'),
                    displayField: 'name',
                    valueField: 'id',
                    editable: false,
                    allowBlank: false
                },
                renderer: function(value, metaData, record) {
                    var continentsStore = this.continentsStore,
                        continentModel = record.getContinents();

                    if (continentsStore.getCount() > 0) {
                        continentModel = continentsStore.findRecord('id', value);
                    }

                    // End.
                    return continentModel.get('name');
                }
            }, {
                text: 'Currencies ID',
                dataIndex: 'currenciesId',
                hideable: false,
                editor: {
                    xtype: 'combobox',
                    store: Ext.create('App.store.admin.Currencies'),
                    displayField: 'name',
                    valueField: 'id',
                    editable: false,
                    allowBlank: false
                },
                renderer: function(value, metaData, record) {
                    var currenciesStore = this.currenciesStore,
                        currencyModel = record.getCurrencies();

                    if (currenciesStore.getCount() > 0) {
                        currencyModel = currenciesStore.findRecord('id', value);
                    }

                    // End.
                    return currencyModel.get('name');
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
            }];

        this.callParent();
    }
});