/**
 * LoginForm.js
 * Created on Oct 18, 2012 11:14:45 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.view.application.authentication.from.Login', {
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
            name: 'auth_identity',
            fieldLabel: 'Username',
            allowBlank: false,
            vtype: 'alphanum'
        }, {
            xtype: 'textfield',
            inputType: 'password',
            name: 'auth_credential',
            fieldLabel: 'Password',
            allowBlank: false
        }, {
            xtype: 'checkbox',
            name: 'auth_remember',
            boxLabel: 'Remember my credentials',
            inputValue: true,
            uncheckedValue: false
        }],
    initComponent: function() {
        this.callParent();
    }
});