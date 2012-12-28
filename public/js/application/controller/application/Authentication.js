/**
 * Authentication.js
 * Created on Oct 4, 2012 11:36:57 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.controller.application.Authentication', {
    extend: 'App.controller.Abstract',
    models: [
        'User'
    ],
    stores: [],
    views: [
        'application.authentication.Window',
        'application.authentication.from.Login'
    ],
    listners: {
    },
    invalidLoginText: 'The given username or password is invalid.',
    /**
     * COMMENTME
     *
     * @param {Ext.app.Application} application
     * @return Boolean Void
     */
    init: function(application)
    {
        this.control({
            'window button[action=authenticate]': {
                click: this.authenticateAction
            },
            'window textfield': {
                specialkey: function(field, event)
                {
                    if (event.getKey() === event.ENTER) {
                        this.authenticateAction(field);
                    }
                }
            }
        });

        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     * @return Boolean Void
     */
    startupAction: function()
    {
        // End.
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
        var loginForm = this.getApplicationAuthenticationFromLoginView()
            .create();
        var userModel = this.getUserModel().create();

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
        var credentialField = loginForm.findField('credential');

        if (loginForm.isValid()) {
            loginForm.updateRecord(userModel);

            userModel.getProxy().url = '~authentication/login';
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

                    if (true !== userModel.get('isActive')) {
                        this.application.logoff();

                        // End.
                        return false;
                    }

                    this.application.logon();

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