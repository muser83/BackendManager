/**
 * Settings.js
 * Created on Nov 7, 2012 11:24:35 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.view.account.settings.SettingsForm', {
    extend: 'Ext.form.Panel',
    icon: '/images/icons/settings.png',
    title: 'Setting',
    border: false,
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
            fieldLabel: 'Settings'
        }],
    //
    initComponent: function()
    {
        this.callParent();
    }
});