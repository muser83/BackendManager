/**
 * Authentication.js
 * Created on Oct 4, 2012 11:36:57 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.controller.application.Authentication', {
    extend: 'Ext.app.Controller',
    models: [
        'application.authentication.User'
    ],
    stores: [],
    views: [
        'application.authentication.Window',
        'application.authentication.LoginForm'
    ],
    refs: [
    ],
    listners: {},
    invalidLoginText: 'The given username or password is invalid.',
    /**
     * COMMENTME
     *
     * @param Object Ext.app.Application
     * @return Boolean Void
     */
    init: function(application)
    {
        this.control({
            'loginWindow button[action=authenticate]': {
                click: this.authenticateAction
            },
            'loginWindow textfield': {
                specialkey: function(field, event)
                {
                    if (event.getKey() == event.ENTER) {
                        this.authenticateAction(field);
                    }
                }
            }
        });
        return true;
    },
    /**
     * COMMENTME
     *
     * @return Boolean Void
     */
    startupAction: function()
    {
        return true;
    },
    /**
     * COMMENTME
     *
     * @return Boolean Void
     */
    loginAction: function(args)
    {
        var window = this.getApplicationAuthenticationWindowView().create();
        var loginForm = this.getApplicationAuthenticationLoginFormView()
            .create();
        var userModel = this.getApplicationAuthenticationUserModel().create();

        if (args.msg) {
            var logoutMessage = 'you are logged off because of the following reason:\n'
                + args.msg;

            loginForm.add({
                xtype: 'panel',
                border: false,
                bodyCls: 'logout-message',
                html: logoutMessage
            });
        }

        loginForm.loadRecord(userModel);

        window.add(loginForm);
        window.show();

        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     * @return Boolean Void
     */
    authenticateAction: function(target)
    {
        var window = target.up('window');
        var loginForm = window.down('form').getForm();
        var userModel = loginForm.getRecord();
        var credentialField = loginForm.findField('auth_credential');

        if (loginForm.isValid()) {
            loginForm.updateRecord(userModel);

            userModel.save({
                scope: this,
                callback: function(userModel, operation)
                {
                    if (!operation.wasSuccessful()) {

                        credentialField.reset();
                        credentialField.markInvalid(
                            operation.getError()
                            );

                        // End.
                        return false;
                    }

                    if (true !== userModel.get('is_authenticated')) {
                        this.application.logoff();

                        // End.
                        return false;
                    }

                    this.application.logon(userModel);

                    window.close();

                    // End.
                    return true;
                }
            });
        }
        return true;
    },
    /**
     * COMMENTME
     *
     * @return Boolean Void
     */
    logoutAction: function()
    {
        // Show confirmation.
        // Send logout request to the server.
        return true;
    }

});