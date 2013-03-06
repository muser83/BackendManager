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
        'application.User'
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
            '#applicationAuthenticationWindow button[action=authenticate]': {
                click: this.authenticateAction
            },
            '#applicationAuthenticationWindow textfield': {
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
     *
     * @public
     * @param {Object} args
     * @return {Boolean} Void.
     */
    startupAction: function(args)
    {
        var loginForm = this.getApplicationAuthenticationFromLoginView().create(),
            window = this.getApplicationAuthenticationWindowView().create({
            itemId: 'applicationAuthenticationWindow'
        });

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

        this.getApplicationUserModel().load(null, {
            callback: function(userModel, operation)
            {
                loginForm.loadRecord(userModel);

                window.add(loginForm);
                window.show();
            }
        });

        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     * @public
     * @return {Boolean} Void.
     */
    authenticateAction: function()
    {
        var window = Ext.ComponentQuery.query('#applicationAuthenticationWindow'),
            window = window[0],
            loginFormPanel = window.down('form'),
            loginForm = loginFormPanel.getForm(),
            userModel = loginForm.getRecord(),
            credentialField = loginForm.findField('credential'),
            md5 = new App.crypt.Md5(),
            hash;

        var progressBar = Ext.create('Ext.ProgressBar', {
            border: false,
            dock: 'bottom'
        });

        if (loginForm.isValid()) {
            loginForm.updateRecord(userModel);

            loginFormPanel.disable();

            window.addDocked(progressBar);
            progressBar.wait({
                interval: 10,
                increment: 200,
                text: 'Authentication...'
            });

            hash = md5.hash(userModel.get('credential'));
            hash = md5.hash(hash);
            userModel.set('credential', hash);

            userModel.save({
                scope: this,
                callback: function(userModel, operation)
                {
                    var responseUserModel = operation.getResultSet().records;
                    responseUserModel = responseUserModel[0];

                    if (true !== responseUserModel.get('is_active')) {
                        progressBar.reset(true);
                        loginFormPanel.enable();
                        credentialField.reset();
                        credentialField.markInvalid(
                            "Invalid username or password.");

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

        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     * @return Boolean Void
     */
    logoffAction: function()
    {
        this.application.logoff();

        // End.
        return true;
    }

});