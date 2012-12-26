/**
 * AccountForm.js
 * Created on Nov 7, 2012 11:24:20 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.view.account.settings.AccountForm', {
    extend: 'Ext.form.Panel',
    icon: '/images/icons/keys.png',
    title: 'Account',
//    shrinkWrap: 2,
//    height: 500,
//    width: 400,
    bodyPadding: 10,
    //
    layout: 'anchor',
    anchorSize: undefined, // If Anchor layout.

    bubbleEvents: [],
    listeners: {},
    defaults: {},
    items: [{
            xtype: 'combobox',
            fieldLabel: 'Account'
        }],
    //
    initComponent: function()
    {
        this.callParent();
    }
});