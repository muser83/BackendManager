/**
 * LoginForm.js
 * Created on Oct 18, 2012 11:14:45 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.view.application.authentication.form.Login', {
    extend: 'Ext.form.Panel',
    border: false,
    bodyPadding: 5,
    defaults: {
        width: 300,
        allowOnlyWhitespace: false,
        maxLength: 50,
        hideEmptyLabel: false,
        labelWidth: 70,
        msgTarget: 'under'
    },
    items: [{
            xtype: 'textfield',
            name: 'identity',
            fieldLabel: 'Username',
            allowBlank: false,
            maxLength: 100,
            vtype: 'alphanum'
        }, {
            xtype: 'textfield',
            inputType: 'password',
            name: 'credential',
            fieldLabel: 'Password',
            allowBlank: false,
            maxLength: 128
        }],
    initComponent: function() {
        this.callParent();
    }
});