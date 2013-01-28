/**
 * application-dev.js
 * Created on Sep 26, 2012 10:23:59 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */

Ext.Loader.setConfig({
    enable: true,
    paths: {
        'App': '/js/application',
        'Ext.ux': '/js/ux'
    }
});

// Preload required system file classes.
Ext.require([
    'App.navigation.Navigation',
    // App
    // Button
    // Chart
    // Container
    'Ext.container.Viewport',
    // Data
    'Ext.data.association.*',
    'Ext.data.proxy.*',
    'Ext.data.reader.*',
    'Ext.data.writer.*',
    // Dd
    // Direct
    // Dom
    // Draw
    // Enums
    // Flash
    // Form
    'Ext.form.*',
    // Fx
    // Grid
    'Ext.grid.plugin.RowEditing',
    // Layout
    'Ext.layout.container.Border',
    // Menu
    // Panel
    // Picker
    // Resizer
    // Selection
    // Slider
    // State
    // Tab
    // Tip
    // Toolbar
    'Ext.toolbar.Toolbar',
    'Ext.toolbar.Paging',
    // Tree
    // Util
    'Ext.util.History',
    // Ux
    // View
    'Ext.view.AbstractView',
    // Window
    'Ext.window.MessageBox',
    // Ajax
    'Ext.Ajax',
    // Models
    'App.model.application.System'
]);

// Bootstrap system.
Ext.application({
    /**
     * Whatever the system is in development.
     */
    inDevelopment: true,
    /**
     * Whatever the user is logged on and the system config is initialized.
     */
    loggedon: false,
    /**
     * Whatever the system is started up.
     */
    startedup: false,
    /**
     * Define the system classes folder, here the system will search for all
     * needed classes.
     */
    appFolder: '/js/application',
    /**
     * The name of this system, this is also the system namespace
     * for all views, controllers, models and stores.
     */
    name: 'App',
    /**
     * Enable quick tips flag, if true the system will automatically
     * Initialize the quick tip messager.
     */
    enableQuickTips: true,
    /**
     * Define all controllers, Be aware that the init method will be called
     * of all defined controllers before the system launch.
     * Define controllers as modulename.Controllername.
     */
    controllers: [
        'application.Authentication',
        'application.Dashboard',
//        'application.Issue',
        'admin.Countries',
        'admin.Locales',
        'admin.Roles',
        'admin.Translate',
        'admin.Users'
    ],
    /**
     * Array of models to require from AppName.model namespace.
     */
    models: [
        'application.System',
        'application.User'
    ],
    /**
     * App.view.Viewport Viewport class.
     * @see Ext.Viewport
     */
    viewport: undefined,
    /**
     * App.navigation.Navigation Navigation class.
     * @see App.navigation.Navigation
     */
    navigation: undefined,
    /**
     * This model will contain all system data like toolbar and navigation
     * config, boot and log times and assiciations with ...
     * COMMENTME
     *
     * App.model.System
     */
    systemModel: undefined,
    /**
     * COMMENTME
     */
    activeController: undefined,
    /**
     * Contains all system delayed task instances.
     */
    tasks: {
    },
    /**
     * Initialize the system.
     *
     * @public
     * @return {Boolean} False, Prevent the system dispatch the configured
     *                   startup controller and action.
     */
    launch: function()
    {
        this.systemModel = this.getApplicationSystemModel().create();

        // First initialize the system model before debug messages can be loged.
        this.debug('Bootstrap system.', 'info');

        this.getSystemModel().set('bootTime', Ext.Date.now());

        this.viewport = Ext.create('App.view.Viewport');

        this.navigation = Ext.create('App.navigation.Navigation');

        this.initOverriders();

        this.initErrorHandler();

        this.initLoadListner();

        this.initUriListner();

        this.initTasks();

        this.logon();

        // End.
        return false;
    },
    /**
     * Helper methods.
     */

    /**
     * Return true, if and only if, the inDevelopment flag is set to true.
     *
     * @public
     * @return {Boolean}
     */
    isInDevelopment: function()
    {
        // End.
        return (true === this.inDevelopment)
            ? true
            : false;
    },
    /**
     * Return true, if and only if, the loggedon flag is set to true.
     *
     * @public
     * @return {Boolean}
     */
    isLoggedon: function()
    {
        // End.
        return (true === this.loggedon)
            ? true
            : false;
    },
    /**
     * Returns true, if and only if, the user is authenticated by the server..
     *
     * isActive is an status that only tells if the current user is
     * authenticated by the server.
     * This means, the given login credentials are authorized for this instance
     * and there is an login session, identified by the login cookie on the
     * client.
     *
     * @public
     * @return {Boolean}
     */
    isAuthenticated: function()
    {
        var isActive = this.getUserModel().get('isActive');

        if (true !== isActive) {
            this.debug('The user is not authenticated by the server.', 'warning');

            // End.
            return false;
        }

        // End.
        return true;
    },
    /**
     * Returns true, if and only if, the startedup flag is set to true.
     *
     * @public
     * @return {Boolean}
     */
    isStartedup: function()
    {
        // End.
        return (true === this.startedup)
            ? true
            : false;
    },
    /**
     * Return a instance or App.view.Viewport
     * or false if the viewport do not exist.
     *
     * @public
     * @return {App.view.Viewport|Boolean}
     */
    getViewport: function()
    {
        // End.
        return (this.viewport.isViewport)
            ? this.viewport
            : false;
    },
    /**
     * Return a instance of App.navigation.Navigation
     * or false if the navigation do not exist.
     *
     * @public
     * @return {App.navigation.Navigation|Boolean}
     */
    getNavigation: function()
    {
        // End.
        return (this.navigation)
            ? this.navigation
            : false;
    },
    /**
     * Return a instance of App.model.application.System
     * or false if the system model do not exist.
     * This system model can be used to store or access system infomation.
     *
     * @public
     * @return {SAM.model.System|Boolean}
     */
    getSystemModel: function()
    {
        // End.
        return (this.systemModel.isModel)
            ? this.systemModel
            : false;
    },
    /**
     * Return a instance of App.model.User
     * or false if the user model do not exist.
     *
     * @public
     * @return {App.model.User|false} User model or false if the user model do
     *                                not exist.
     */
    getUserModel: function()
    {
        var userModel = this.getSystemModel().getUser();

        // End.
        return (userModel.isModel)
            ? userModel
            : false;
    },
    /**
     * Return a instance of App.model.Person
     * or false if the person model doe not exist.
     *
     * @public
     * @return {App.model.Person} Person model of false if the person model do
     *                            not exist.
     */
    getPersonModel: function()
    {
        var personModel = this.getSystemModel().getPerson();

        // End.
        return (personModel.isModel)
            ? personModel
            : false;
    },
    /**
     * Return a Ext.CompositeElement instance of the system header logo dom.
     *
     * @public
     * @return Ext.CompositeElement
     */
    getLoaderDOM: function()
    {
        // End.
        return Ext.select('#application-header-loader');
    },
    /**
     * Return a Ext.CompositeElement instance of the system header navigation
     * dom.
     *
     * @public
     * @param {boolean} returnId Whatever to return the navigation DOM id or Element.
     * @return Ext.CompositeElement
     */
    getNavigationDOM: function(returnId)
    {
        var id = 'application-header-navigation';

        // End.
        return (true === returnId)
            ? id
            : Ext.select('#' + id);
    },
    /**
     * Return a Ext.CompositeElement instance of the system header user info dom.
     *
     * @public
     * @param {boolean} returnId Whatever to return the user info DOM id or Element.
     * @return Ext.CompositeElement
     */
    getUserInfoDOM: function(returnId)
    {
        var id = 'application-header-userinfo';

        // End.
        return (true === returnId)
            ? id
            : Ext.select('#' + id);
    },
    /**
     * System methods.
     */

    /**
     * Create a action object based on the given URI and dispatch the action
     * if the system is tarted up and user is logged on.
     *
     * @public
     * @param {String} uri The request URI.
     * @return {Boolean}
     */
    doRequest: function(uri)
    {
        var r,
            action;

        // Cancel this request call if the uri is empty or == !.
        if (!uri || ('!' === uri)) {
            r = ('!' === uri)
                ? 'equal to !'
                : 'empty.';
            this.debug(
                'Request canceled because the given uri is ' + r, 'warning'
                );
            // End.
            return false;
        }

        // Cancel this request if the system is not started
        // or the user is not authenticated.
        if (this.isStartedup() && this.isLoggedon()) {
            this.logoff();

            // End.
            return false;
        }

        // Add the given uri to the history manager.
        if (uri !== Ext.History.getToken()) {
            Ext.History.add(uri);
        }

        action = this.buildAction(uri);

        this.dispatch(action);

        // Highlight the navigation hoes match the disoatched uir.
        this.navigation.highlightTab(uri);

        // End.
        return true;
    },
    /**
     * Log a messages that will form the system debug trace.
     * If this system instance is in debug mode, the messages will also be
     * logged to the browser console. (console.log)
     *
     * @public
     * @param {String} msg Debug messages.
     * @param {String} level Possible values: System, Error, User
     * @param {Object} dump Debug dump object.
     * @return {Boolean}
     */
    debug: function(msg, level, dump)
    {
        var l,
            debugLogs,
            systemModel = this.getSystemModel(),
            msg = msg || 'Unknown messages',
            dump = dump || {
        };

        switch (level.toLowerCase()) {
            case 'detail':
            case 'info':
            case 'warning':
            case 'error':
            default:
                'unknown';
        }

        // Send the given message to the browser console if this system instance
        // is in development mode.
        if (this.isInDevelopment()) {
            l = Ext.String.capitalize(level);

            console.log((l + ': ' + msg), [dump]);
        }

        // Can't store a messages if the system storage does not exist.
        if (!systemModel) {
            // End.
            return false;
        }

        debugLogs = systemModel.get('debug');

        // Group the messages on level.
        if (!debugLogs.hasOwnProperty(level)) {
            debugLogs[level] = {
            };
        }

        // Add the messages to the collection.
        debugLogs[level][Ext.Date.now()] = {
            msg: msg,
            dump: dump
        };

        this.getSystemModel().set('debug', debugLogs);

        // End.
        return true;
    },
    /**
     * Call the application.authentication.login action but does not destroy the
     * session on the server.
     *
     * @public
     * @param {String} msg Pre logoff message.
     * @return {Boolean} Void
     */
    preLogoff: function(msg)
    {
        this.debug('Prepare system logoff.', 'info');

        var loginAction = {
            module: 'application',
            controller: 'authentication',
            action: 'login',
            silent: true,
            args: {
                msg: Ext.isString(msg)
                    ? msg
                    : undefined
            }
        };

        this.loggedon = false;
        this.systemModel = this.getApplicationSystemModel().create();

        this.tasks.preLogoff.cancel();

        this.dispatch(loginAction);

        // End.
        return true;
    },
    /**
     * Set the loggedOn flags to false and call the
     * application.authentication.login action that will ask the server to
     * destroy the login session and show an login window
     *
     * @public
     * @param {String} msg Logoff message.
     * @return {Boolean} Void
     */
    logoff: function(msg)
    {
        this.debug('System Logoff.', 'info');

        var loginAction = {
            module: 'application',
            controller: 'authentication',
            action: 'login', // TODO Do not call the login action, but only the startup action.
            silent: true,
            args: {
                logoutFirst: true,
                msg: Ext.isString(msg)
                    ? msg
                    : undefined
            }
        };

        this.loggedon = false;
        this.systemModel = this.getApplicationSystemModel().create();

        this.getSystemModel().set('logoffTime', Ext.Date.now());

        this.shutdown();

        this.dispatch(loginAction);

        // End.
        return true;
    },
    /**
     * Load the system model, once loaded the given callback method will be
     * called with the system model as argument.
     *
     * @public
     * @param {Function} callback
     * @return {Booleand} Void
     */
    loadSystemInfo: function(callback)
    {
        this.debug('Load system configuration and personal settings.', 'info');

        var operation = new Ext.data.Operation({
            action: 'read'
        });

        this.getSystemModel().getProxy().read(operation, function(operation)
        {
            var systemModel;

            if (!operation.wasSuccessful()) {
                this.debug(
                    'Could not load system information:', 'warning', operation);

                Ext.callback(callback, this);

                // End.
                return false;
            }

            systemModel = operation.getRecords()[0];

            if (!systemModel || !systemModel.isModel) {
                Ext.Error.raise({
                    addSuffix: false,
                    closable: false,
                    modal: true,
                    multiline: false,
                    title: 'System error',
                    msg: 'The required system storage could not be loaded',
                    icon: Ext.Msg.ERROR,
                    cls: 'x-fix-msg-msg',
                    animateTarget: Ext.get('application-header-logo'),
                    buttons: Ext.Msg.OK,
                    buttonText: {
                        ok: 'Relaunch System'
                    },
                    fn: function(buttonId)
                    {
                        if ('ok' === buttonId) {
                            this.saveSystemInfo();
                            window.location.href = '/';
                        }

                        // End.
                        return true;
                    }
                });

                // End.
                return false;
            }

            systemModel.set('bootTime', this.getSystemModel().get('bootTime'));
            systemModel.set('logonTime', this.getSystemModel().get('logonTime'));
            systemModel.set('logoffTime', this.getSystemModel().get('logoffTime'));
            systemModel.set('debug', this.getSystemModel().get('debug'));

            // Replace the systemModel.
            this.systemModel = systemModel;

            Ext.callback(callback, this, [systemModel]);

            // End.
            return true;
        }, this);
    },
    /**
     * Submit the current data in the system model to the server.
     *
     * @public
     * @returns {Boolean} Void
     */
    saveSystemInfo: function()
    {
        this.debug('Save system information.', 'info');

        // Remove unnecessary system data before submitting it to the server.
        this.getSystemModel().set('navigation', '');
        this.getSystemModel().set('toolbar', {
        });

        this.getSystemModel().save();

        // End.
        return true;
    },
    /**
     * If the user is authenticated by the server,
     * the navigation and user info will be build and showed, the doRequest
     * method will be called with the current URI as argument.
     * else,
     * this logoff method will be called.
     *
     * @private
     * @return {Boolean} Void
     */
    logon: function()
    {
        this.debug('Attempt to logon.', 'info');

        this.resetLogoffTimer();

        this.loadSystemInfo(function()
        {
            if (this.isAuthenticated()) {
                this.debug('System logon.', 'info');

                this.systemModel.set('logonTime', Ext.Date.now());

                this.loggedon = true;

                this.startup();
            } else {
                this.logoff();
            }

            // End.
            return true;
        });

        // End.
        return true;
    },
    /**
     * Dispatch the given action, the action can split up into 2 parts,
     * the controller and the action.
     * If the controller does not exist an exception will be thrown. Otherwise
     * the controller startup action and if exist the action will be called.
     *
     * @param {Object} action This action contains the module, controller
     *                 and action name.
     * @return {Boolean} Void
     */
    dispatch: function(action)
    {
        this.debug('Dispatch new action:', 'info', action);

        var moduleName = Ext.String.uncapitalize(action.module),
            controllerName = Ext.String.capitalize(action.controller),
            moduleControllerName = moduleName + '.' + controllerName,
            actionName = Ext.String.uncapitalize(action.action) + 'Action',
            controller = this.controllers.get(moduleControllerName),
            silent = action.silent;

        actionName = ('Action' === actionName)
            ? false
            : actionName;

        if (!controller) {
            Ext.Error.raise({
                title: 'System dispatch error.',
                msg: 'Could not dispatch controller ' + controllerName + '.',
                closable: false,
                addSuffix: false,
                buttons: Ext.Msg.YESNO,
                buttonText: {
                    yes: 'Relaunch System',
                    no: 'Report issue'
                }
            });

            // End.
            return false;
        }

        if (controllerName !== this.activeController) {
            controller['startupAction'](action.args);

            if (!silent) {
                this.activeController = controllerName;
            }
        }

        if (!actionName) {
            // End.
            return true;
        }

        if ((undefined === controller[actionName])) {
            this.debug('Action ' + actionName + ' do not exist in controller '
                + controllerName + '.', 'warning'
                );

            // End.
            return false;
        }

        controller[actionName](action.args);

        // End.
        return true;
    },
    /**
     * Create an dispatchable action object based on the given URI.
     * If the URI does not cover all expected action segments, segments from the
     * default action will be used.
     *
     * @private
     * @param {String} uri description
     * @returns {Boolean} Void
     */
    buildAction: function(uri)
    {
        var segments;
        var segment;
        var segmentsMatchingRegex = new RegExp(/\/([0-9A-Za-z\_]*)/g);
        // Default action.
        var action = {
            module: 'application',
            controller: 'dashboard',
            action: '',
            args: {
            }
        };

        uri = '/' + uri;
        uri = uri.replace(/^\/\//, '/');

        segments = uri.match(segmentsMatchingRegex) || [];

        Ext.Array.each(segments, function(value, key)
        {
            segments[key] = value.replace(/^\//, '');
        });

        Ext.Object.each(action, function(key)
        {
            if ('args' === key) {
                // End.
                return false;
            }

            segment = segments.splice(0, 1).toString();

            if (segment) {
                action[key] = segment;
            }
        });

        if (segments) {
            action['args'] = segments;
        }

        // End.
        return action;

    },
    /**
     * Inject the navigation HTML in the navigation container and initialize the
     * navigation class.
     * The navigation HTML will be received from the system information storage
     * and is different for each user.
     *
     * @private
     * @return {Boolean} Void
     */
    buildNavigation: function()
    {
        this.debug('Build navigation.', 'info');

        var nagigationHTML = this.getSystemModel().get('navigation');

        this.getNavigationDOM().setHTML(nagigationHTML);

        this.navigation.init();

        this.getNavigationDOM().show(true);

        // End.
        return true;
    },
    /**
     * COMMENTME
     * Create a user information template and inject this in the user info
     * container.
     * The user information will be received from the system information storage
     * and is different for each user.
     *
     * @private
     * @return {Booleand} Void
     */
    buildUserInfo: function()
    {
        this.debug('Build user infomation.', 'info');
        var userInfoButton,
            userInfoDOMId = this.getUserInfoDOM(true),
            userNavigation = this.getSystemModel().get('userNavigation'),
            personModel = this.getPersonModel(),
            fullname = personModel.get('fullname');

        // Create a new button and add the to the user info DOM.
        userInfoButton = new Ext.button.Button({
            icon: personModel.get('image'),
            renderTo: userInfoDOMId,
            text: '<span style="color:#FFF;">' + fullname + '<span>',
            scale: 'large',
            style: {
                background: 'none',
                border: 'none',
                color: '#FFFFFF'
            },
            menu: {
                items: userNavigation
            }
        });

        // TMP
        var userInfoDOMId = this.getUserInfoDOM(true),
            accountQuery = userInfoDOMId + ' buttun[action=account]',
            settingsQuery = userInfoDOMId + ' buttun[action=settings]',
            messagesQuery = userInfoDOMId + ' buttun[action=messages]',
            changeimageQuery = userInfoDOMId + ' buttun[action=changeimage]',
            reportbugQuery = userInfoDOMId + ' buttun[action=reportbug]',
            logoffQuery = userInfoButton.menu.child('[action=logoff]');

        logoffQuery.on('click', this.logoff, this);

        this.getUserInfoDOM().show(true);

    },
    /**
     * Cancel and reset the logoff and preLogoff delayed tasks.
     *
     * @private
     * @returns {Booleand} Void
     */
    resetLogoffTimer: function()
    {
        var preLogoffTime = ((60 * 1000) * 30), // 30 min.
            logoffTime = ((60 * 1000) * 45); // 45 min.

        this.tasks.preLogoff.cancel();
        this.tasks.preLogoff.delay(preLogoffTime);

        this.tasks.logoff.cancel();
        this.tasks.logoff.delay(logoffTime);

        // End.
        return true;

    },
    /**
     * Configure a default error message and initialize an error listener that
     * will display all thrown errors in a messages box.
     *
     * @private
     * @return {Boolean} Void.
     */
    initErrorHandler: function()
    {
        this.debug('Initialize system error handler.', 'info');

        var self = this;
        var errorDefault = {
            scope: this,
            addSuffix: true,
            closable: true,
            modal: true,
            multiline: false,
            title: 'System error',
            msg: 'Undefined error message',
            icon: Ext.Msg.ERROR,
            cls: 'x-fix-msg-msg',
            animateTarget: Ext.get('application-header-logo'),
            buttons: Ext.Msg.YESNOCANCEL,
            buttonText: {
                yes: 'Relaunch System',
                no: 'Report issue',
                cancel: 'Continue'
            },
            fn: function(buttonId)
            {
                if ('yes' === buttonId) {
                    this.saveSystemInfo();
                    window.location.href = '/';
                }

                if ('no' === buttonId) {
                    // TODO Dispatch the report issue action and log the system model.
                    this.dispatch({
                        module: 'application',
                        controller: 'issue',
                        action: 'report',
                        silent: true
                    });
                }

                // End.
                return true;
            }
        };

        // Initialize the error listner.
        Ext.Error.handle = function(error)
        {
            Ext.apply(errorDefault, error);
            if (error.addSuffix) {
                error.msg += '\n\'Report issue\' to help debugging this system.\n\
\'Continue\' otherwise.';
            }

            if (!error.showError || false !== error.showError) {

                self.debug('Throw system error:', 'error', {
                    errorMsg: error.msg
                });

                Ext.Msg.show(errorDefault);
            }

            // End.
            return true;
        };

        // End.
        return true;
    },
    /**
     * Initialize several load listners that will trigger the beforeRequest,
     * requestComplete or requestException actions.
     *
     * @private
     * @return {Boolean} Void.
     */
    initLoadListner: function()
    {
        this.debug('Initialize server connection provider.', 'info');

        this.getLoaderDOM().hide();

        Ext.Ajax.disableCaching = true;
        Ext.Ajax.disableCachingParam = '_';
        Ext.Ajax.method = 'GET';
        Ext.Ajax.extraParams = {
        };

        Ext.Ajax.on('beforerequest', this.beforeRequest, this);

        Ext.Ajax.on('requestcomplete', this.requestComplete, this);

        Ext.Ajax.on('requestexception', this.requestException, this);

        // End.
        return true;
    },
    /**
     * Initialize an change listener that will call the doRequest method if the
     * URI changes.
     *
     * @private
     * @return {Boolean} Void.
     */
    initUriListner: function()
    {
        this.debug('Initialize URI listner.', 'info');

        Ext.History.init();

        Ext.History.on('change', this.doRequest, this);

        if (!Ext.History.getToken()) {
            Ext.History.add('!', true);
        }

        // End.
        return true;
    },
    /**
     * Initialize all the delayed tasks for this system.
     *
     * @private
     * @return {Boolean} Void.
     */
    initTasks: function()
    {
        this.debug('Initialize system tasks.', 'info');

        this.tasks.preLogoff = new Ext.util.DelayedTask(function()
        {
            // Do not shutdown the system.
            this.preLogoff("The system isn't used for 30 minutes or longer.");

            // End.
            return true;
        }, this);

        this.tasks.logoff = new Ext.util.DelayedTask(function()
        {
            // Shutdown the system.
            this.logoff("The system isn't used for 45 minutes or longer.");
            // End.
            return true;
        }, this);

        // End.
        return true;
    },
    /**
     * Override ExtJs 4.1.* classes to get the wished behaviors.
     *
     * @private
     * @return {Boolean} Void.
     */
    initOverriders: function()
    {
        this.debug('Override framework classes.', 'info');

        // ExtJs 4.1 does not support the loadMask anymore.
        // With this override the loadMask is enabled again.
        Ext.override(Ext.view.AbstractView, {
            onRender: function()
            {
                this.callOverridden();

                if (this.mask && Ext.isObject(this.store)) {
                    this.setMaskBind(this.store);
                }

                // End.
                return true;
            }
        });

        // End.
        return true;
    },
    /**
     * Reset the logoff timer and shows the loader animation.
     *
     * @private
     * @param {Ext.data.Connection} conn
     * @param {Object} options
     * @return {Boolean} Void.
     */
    beforeRequest: function(conn, options)
    {
        this.resetLogoffTimer();

        this.debug('Connect to the server:', 'info', {
            action: options.action,
            method: options.method,
            url: options.url
        });

        this.getLoaderDOM().show();

        // End.
        return true;
    },
    /**
     * Hides the loader animation.
     *
     * @private
     * @param {Ext.data.Connection} conn
     * @param {Object} response
     * @param {Object} options
     * @return {Boolean} Void.
     */
    requestComplete: function(conn, response, options)
    {
        this.debug('Connecting with the server closed:', 'info', {
            contentLength: response.getResponseHeader('content-length'),
            status: response.status,
            url: options.url
        });

        this.getLoaderDOM().hide();

        // End.
        return true;
    },
    /**
     * If the response status code == 401 the system will be logged off
     * otherwise a error messages will be shown.
     *
     * @private
     * @param {Ext.data.Connection} conn
     * @param {Object} response
     * @param {Object} options
     * @return {Boolean} Void.
     */
    requestException: function(conn, response, options)
    {

        this.getLoaderDOM().hide();

        switch (response.status) {
            case -1:
                this.debug('Connection with the server is forced closed.', 'warning', {
                    status: response.status || '',
                    url: options.url || ''
                });
                break;
            case 401:
                this.debug('The user is not authenticated by the server.', 'warning');

                // TODO, if a user is logged in, add a message to the logoff.
                // System logout.
                this.logoff();
                break;
            default:
                this.debug('Connecting with the server closed.', 'error', {
                    status: response.status || '',
                    url: options.url || ''
                });

                Ext.Error.raise({
                    title: 'System load error.',
                    msg: 'Error while loading data from the server.\n\
The server didn\'t answered with the expected data.'
                });
        }

        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     *
     * @private
     * @return {Boolean} Void.
     */
    startup: function()
    {
        this.debug('System startup.', 'info');

        this.buildNavigation();

        this.buildUserInfo();

        if ('!' === Ext.History.getToken()) {
            Ext.History.add('/');
        }

        this.doRequest(
            Ext.History.getToken(), true
            );

        // End.
        return true;
    },
    /**
     * Shutdown all active processes and destroy all open windows and views
     *
     * @private
     * @return {Boolean} Void.
     */
    shutdown: function()
    {
        this.debug('System shutdown.', 'info');

        var openWindows = Ext.ComponentQuery.query('window');
        // Reset system properties.
        this.debug('Reset system configuration.', 'detail');
        this.activeController = undefined;
        // Cancel system tasks.
        this.debug('Cancel system tasks.', 'detail');
        this.tasks.preLogoff.cancel();
        this.tasks.logoff.cancel();
        // Abort all ajax calls.
        this.debug('Close open connections with the server.', 'detail');
        Ext.Ajax.abortAll();
        // Remove navigation DOM.
        this.debug('Remove navigation.', 'detail');
        this.getNavigationDOM()
            .hide()
            .setHTML('<li></li>');
        // Remove user/ personal info DOM.
        this.debug('Remove user infomation.', 'detail');
        this.getUserInfoDOM()
            .hide()
            .setHTML('');
        // Remove all viewport center views.
        this.debug('Remove all views and open windows.', 'detail');
        this.getViewport().down('[region=center]').removeAll();

        Ext.each(openWindows, function(window) {
            if (window.rendered) {
                window.close();
            }

            // End.
            return true;
        }, this);
        // TODO Save the systemModel.

        // End.
        return true;
    }

});