/**
 * Personal.js
 * Created on Nov 5, 2012 11:25:22 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.view.account.settings.PersonalForm', {
    extend: 'Ext.form.Panel',
    icon: '/images/icons/user.png',
    title: 'Personal',
    shrinkWrap: 3,
//    height: 500,
    width: 420,
    bodyPadding: 10,
//    bubbleEvents: [],
//    listeners: {},
    defaults: {
        anchor: '100%'
    },
    fieldDefaults: {
        labelAlign: 'top',
        labelWidth: 100,
        hideEmptyLabel: false,
        width: 200
    },
    items: [{
            xtype: 'container',
            layout: 'hbox',
            items: [{
                    xtype: 'container',
                    flex: 1,
                    border: false,
                    layout: 'anchor',
                    items: [{
                            xtype: 'textfield',
                            fieldLabel: 'Firstname',
                            anchor: '95%'
                        }, {
                            xtype: 'textfield',
                            fieldLabel: 'Midlename',
                            anchor: '95%'
                        }, {
                            xtype: 'textfield',
                            fieldLabel: 'Lastname',
                            anchor: '95%'
                        }, {
                            xtype: 'combobox',
                            fieldLabel: 'Gender',
                            anchor: '95%'
                        }]
                }, {
                    xtype: 'container',
                    flex: 1,
                    border: false,
                    layout: 'anchor',
                    items: [{
                            xtype: 'datefield',
                            fieldLabel: 'Birthday'
                        }, {
                            xtype: 'combobox',
                            fieldLabel: 'Function title'
                        }, {
                            xtype: 'combobox',
                            fieldLabel: 'Department'
                        }, {
                            xtype: 'checkbox',
                            fieldLabel: 'Newsletter'
                        }]
                }]
        }, {
            xtype: 'tabpanel',
            plain: true,
            activeTab: 0,
            shrinkWrap: 3,
            defaults: {
                bodyPadding: 10
            },
            items: [{
                    icon: '/images/icons/globe.png',
                    title: 'Address information',
                    shrinkWrap: 3,
                    items: [{
                            xtype: 'container',
                            layout: 'hbox',
                            items: [{
                                    xtype: 'container',
                                    flex: 1,
                                    border: false,
                                    layout: 'anchor',
                                    items: [{
                                            xtype: 'combobox',
                                            fieldLabel: 'Country',
                                            anchor: '95%'
                                        }, {
                                            xtype: 'combobox',
                                            fieldLabel: 'Province',
                                            anchor: '95%'
                                        }, {
                                            xtype: 'textfield',
                                            fieldLabel: 'Address',
                                            anchor: '95%'
                                        }]
                                }, {
                                    xtype: 'container',
                                    flex: 1,
                                    border: false,
                                    layout: 'anchor',
                                    items: [{
                                            xtype: 'textfield',
                                            fieldLabel: 'Postal code',
                                            anchor: '95%'
                                        }, {
                                            xtype: 'textfield',
                                            fieldLabel: 'City',
                                            anchor: '95%'
                                        }]
                                }]
                        }]
                }, {
                    icon: '/images/icons/adress_book.png',
                    title: 'Contact information',
                    shrinkWrap: 3,
                    items: [{
                            xtype: 'container',
                            layout: 'hbox',
                            items: [{
                                    xtype: 'container',
                                    flex: 1,
                                    border: false,
                                    layout: 'anchor',
                                    items: [{
                                            xtype: 'textfield',
                                            fieldLabel: 'Phone',
                                            anchor: '95%'
                                        }, {
                                            xtype: 'textfield',
                                            fieldLabel: 'Mobile',
                                            anchor: '95%'
                                        }, {
                                            xtype: 'textfield',
                                            fieldLabel: 'Fax',
                                            anchor: '95%'
                                        }, {
                                            xtype: 'textfield',
                                            fieldLabel: 'Skype',
                                            anchor: '95%'
                                        }]
                                }, {
                                    xtype: 'container',
                                    flex: 1,
                                    border: false,
                                    layout: 'anchor',
                                    items: [{
                                            xtype: 'textfield',
                                            fieldLabel: 'Facebook',
                                            anchor: '95%'
                                        }, {
                                            xtype: 'textfield',
                                            fieldLabel: 'Twitter',
                                            anchor: '95%'
                                        }, {
                                            xtype: 'textfield',
                                            fieldLabel: 'Linkedin',
                                            anchor: '95%'
                                        }, {
                                            xtype: 'textfield',
                                            fieldLabel: 'Website',
                                            anchor: '95%'
                                        }]
                                }]
                        }]
                }]
        }],
    //
    initComponent: function()
    {
        this.callParent();
    }
});