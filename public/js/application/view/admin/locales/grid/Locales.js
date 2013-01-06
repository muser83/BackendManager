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
            hideable: false
        }, {
            text: 'Country ID',
            dataIndex: 'countriesId',
            hideable: false
        }, {
            text: 'Charset ID',
            dataIndex: 'charsetsId',
            hideable: false
        }, {
            text: 'Is visible',
            dataIndex: 'is_visible',
            hideable: false
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