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
     * Auto create viewport flag, if true the system will automatically
     * create a viewport before the system launch.
     */
    autoCreateViewport: false,
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
        'application.System'
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
     * Contains all system delayed task instances.
     */
    tasks: {
    },
    /**
     * Initialize the system.
     *
     * @return {Boolean} False, Prevent the system dispatch the configured
     *                   startup controller and action.
     */
    launch: function()
    {
        this.initSystemInfo();

        this.getSystemModel().set('bootTime', Ext.Date.now());

        // First initialize the system model before debug messages can be loged.
        this.debug('Launch.', 'system');

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
     * Public methods.
     */

    /**
     * COMMENTME
     */
    isInDevelopment: function()
    {
        // End.
        return this.inDevelopment;
    },
    /**
     * COMMENTME
     */
    isLoggedon: function()
    {
        // End.
        return this.loggedon;
    },
    /**
     * Returns a boolean true if the user is authenticated by the server,
     * false otherwise.
     *
     * isActive is an status that only tells if the current user is
     * authenticated by the server.
     * This means, the given login credentials are authorized for this instance
     * and there is an login session, identified by the login cookie on the
     * client.
     *
     * @return {Boolean} True if the user is authenticated by the server.
     */
    isAuthenticated: function()
    {
        // End.
        return this.getUserModel().get('isActive');
    },
    /**
     * COMMENTME
     */
    getViewport: function()
    {
        // End.
        return this.viewport;
    },
    /**
     * COMMENTME
     */
    getNavigation: function()
    {
        // End.
        return this.navigation;
    },
    /**
     * COMMENTME
     */
    getSystemModel: function()
    {
        // End.
        return this.systemModel;
    },
    /**
     * COMMENTME
     */
    getUserModel: function()
    {
        // End.
        return this.getSystemModel().getUser();
    },
    /**
     * COMMENTME
     */
    getPersonModel: function()
    {
        // End.
        return this.getUserModel().getPerson();
    },
    /**
     * Return a Ext.CompositeElement instance of the system header logo dom.
     *
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
     * @return Ext.CompositeElement
     */
    getNavigationDOM: function()
    {
        // End.
        return Ext.select('#application-header-navigation');
    },
    /**
     * Return a Ext.CompositeElement instance of the system header user info dom.
     *
     * @return Ext.CompositeElement
     */
    getUserInfoDOM: function()
    {
        // End.
        return Ext.select('#application-header-userinfo');
    },
    /**
     * Create and action object based on the given URI and dispatch the action
     * if the user is logged on and the given uri is not ! or empty.
     *
     * @param {String} uri The request URI.
     * @param {Boolean} force force to dispaths the given URI.
     * @return {Boolean} Void.
     */
    doRequest: function(uri, force)
    {
        var action;

        if (!uri || ('!' === uri)) {
            // End.
            return false;
        }

        if (true !== this.isLoggedon()) {
            this.logoff();

            // End.
            return false;
        }

        action = this.getAction(uri);

        this.navigation.highlightTab(uri);

        this.dispatch(action);

        // End.
        return true;
    },
    /**
     * Call the application.authentication.login action but does not destroy the
     * session on the server.
     *
     * @param {String} msg Pre logoff message.
     * @return {Boolean} Void
     */
    preLogoff: function(msg)
    {
        this.debug('Pre-logoff.', 'System');

        var loginAction = {
            module: 'application',
            controller: 'authentication',
            action: 'login',
            args: {
                msg: Ext.isString(msg)
                    ? msg
                    : undefined
            }
        };

        this.tasks.preLogoff.cancel();

        this.dispatch(loginAction);

        // End.
        return true;
    },
    /**
     * Abort all load calls, destroy the navigationDOM, userInfoDOM, viewport
     * center region, all rendered windows, submit and reset the system model,
     * set the loggedOn flags to false and call the
     * application.authentication.login action that will ask the server to
     * destroy the login session and show an login window
     *
     * @param {String} msg Logoff message.
     * @return {Boolean} Void
     */
    logoff: function(msg)
    {
        this.debug('Logoff.', 'System');

        var openWindows = Ext.ComponentQuery.query('window');
        var loginAction = {
            module: 'application',
            controller: 'authentication',
            action: 'login',
            args: {
                logoutFirst: true,
                msg: Ext.isString(msg)
                    ? msg
                    : undefined
            }
        };
        this.loggedon = false;

        this.debug('Abort load requests.', 'System');
        Ext.Ajax.abortAll();

        this.debug('Remove navigation.', 'System');
        this.getNavigationDOM()
            .hide()
            .setHTML('<li></li>');

        this.debug('Remove user infomation.', 'System');
        this.getUserInfoDOM()
            .hide()
            .setHTML('');

        this.debug('Remove all views and open windows.', 'System');
        this.getViewport().down('[region=center]').removeAll();

        Ext.each(openWindows, function(window) {
            if (window.rendered) {
                window.close();
            }
        }, this);

        this.debug('Goodbye.', 'System');

        this.getSystemModel().set('logoffTime', Ext.Date.now());
        this.saveSystemInfo();
        // Reset system data.
        this.initSystemInfo();

        this.tasks.preLogoff.cancel();
        this.tasks.logoff.cancel();

        this.dispatch(loginAction);

        // End.
        return true;
    },
    /**
     * Log a messages that will form the system debug trace.
     *
     * @param {String} msg Debug messages.
     * @param {String} level Possible values: System, Error, User
     * @param {Object} dump Debug dump object.
     * @return {Booleand} Void
     */
    debug: function(msg, level, dump)
    {
        if (!level) {
            level = 'Unknown';
        }

        level = Ext.String.capitalize(level);

        dump = dump || {
        };

        // TODO use levels.

        var debugLogs = this.getSystemModel().get('debug');

        Ext.Array.insert(debugLogs, Ext.Date.now(), [{
                time: Ext.Date.now(),
                msg: msg,
                dump: dump
            }]);

        this.getSystemModel().set('debug', debugLogs);

        console.info((level + ': ' + msg), [dump]);

        // End.
        return true;
    },
    /**
     * System methods.
     * Public methods.
     */

    /**
     * Load the system model, once loaded the given callback method will be
     * called with the system model as argument.
     *
     * @param {Function} callback
     * @return {Booleand} Void
     */
    loadSystemInfo: function(callback)
    {
        this.debug('Load system info.', 'System');

        var operation = new Ext.data.Operation({
            action: 'read'
        });

        this.getSystemModel().getProxy().read(operation, function(operation)
        {
            if (operation.wasSuccessful()) {
                var systemModel = operation.getRecords()[0];
                // Copy all event times and debug logs to the new system model.
                systemModel.set('bootTime', this.getSystemModel().get('bootTime'));
                systemModel.set('logonTime', this.getSystemModel().get('logonTime'));
                systemModel.set('logoffTime', this.getSystemModel().get('logoffTime'));
                systemModel.set('debug', this.getSystemModel().get('debug'));

                // Replace the systemModel.
                this.systemModel = systemModel;
            }

            Ext.callback(callback, this, [this.getSystemModel()]);

        }, this);

        // End.
        return true;
    },
    /**
     * Submit the current data in the system model to the server.
     *
     * @returns {Booleand} Void
     */
    saveSystemInfo: function()
    {
        this.debug('Save system info.', 'System');

        // Remove unnecessary system data.
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
     *
     * else,
     * this logoff method will be called.
     *
     *
     * @return {Boolean} Void
     */
    logon: function()
    {
        var logon = function()
        {
            this.debug('Logon.', 'System');

            this.systemModel.set('logonTime', Ext.Date.now());

            this.loggedon = true;

            this.buildNavigation();

            this.buildUserInfo();

            if ('!' === Ext.History.getToken()) {
                Ext.History.add('/');
            }

            this.doRequest(
                Ext.History.getToken(), true
                );
        };

        this.resetLogoffTimer();

        this.loadSystemInfo(function()
        {
            if (this.isAuthenticated()) {
                logon.call(this);
            } else {
                this.logoff();
            }

        });

        // End.
        return true;
    },
    /**
     * Dispatch the given action.
     * If either the Module, Controller or Action does not exists an exception
     * will be thrown.
     *
     * @param {Object} action This action contains the module, controller
     * and action name.
     * @return {Boolean} Void
     */
    dispatch: function(action)
    {
        this.debug('New action dispatched:', 'System', action);

        var moduleName = Ext.String.uncapitalize(action.module);
        var controllerName = Ext.String.capitalize(action.controller);
        var moduleControllerName = moduleName + '.' + controllerName;
        var actionName = Ext.String.uncapitalize(action.action) + 'Action';
        var controller = this.controllers.get(moduleControllerName);

        if (undefined === controller || undefined === controller[actionName]) {
            Ext.Error.raise({
                title: 'System dispatch error.',
                msg: 'Could not dispatch action ' + controllerName + '.' +
                    actionName + '.'
            });
        }

        // Call the module controller action.
        controller[actionName](action.args);

        // End.
        return true;
    },
    /**
     * Inject the navigation HTML in the navigation container and initialize the
     * navigation class.
     *
     * @return {Booleand} Void
     */
    buildNavigation: function()
    {
        this.debug('Build navigation.', 'System');

        var nagigationHTML = this.getSystemModel().get('navigation');

        this.getNavigationDOM().setHTML(nagigationHTML);

        this.navigation.init();

        this.getNavigationDOM().show(true);

        // End.
        return true;
    },
    /**
     * Create a user information template and inject this in the user info
     * container.
     *
     * @return {Booleand} Void
     */
    buildUserInfo: function()
    {
        this.debug('Build user infomation.', 'System');

        var imageId = Ext.id();
        var fullnameId = Ext.id();
        var logoffId = Ext.id();
        var settingsId = Ext.id();
        var personModel = this.getPersonModel();
        var userInfo = new Ext.Template(
            '<img src="{src}" alt="{fullname}" id={imageId} height="41" width="41" />' +
            '<p id="{fullnameId}">{fullname}</p>' +
            '<span id="{logoffId}"><span class="application-icon icon-lock"></span>Logoff</span> ' +
            '<span id="{settingsId}"><span class="application-icon icon-settings"></span>Settings</span>'
            );

        userInfo = userInfo.apply({
            src: personModel.get('image'),
            fullname: personModel.get('fullname'),
            imageId: imageId,
            fullnameId: fullnameId,
            logoffId: logoffId,
            settingsId: settingsId
        });

        this.getUserInfoDOM().setHTML(userInfo).show(true);

        // Define click handlers.
        Ext.fly(logoffId).on('click', this.logoff, this);

        Ext.fly(settingsId).on('click', function()
        {
            var settingsAction = {
                module: 'account',
                controller: 'settings',
                action: 'startup'
            };

            this.dispatch(settingsAction);

            // End.
            return;
        }, this);

    },
    /**
     * Cancel and reset the logoff and preLogoff delayed tasks.
     *
     * @returns {Booleand} Void
     */
    resetLogoffTimer: function()
    {
        var preLogoffTime = ((60 * 1000) * 1); // 30 min.
        var logoffTime = ((60 * 1000) * 45); // 45 min.

        this.tasks.preLogoff.cancel();
        this.tasks.preLogoff.delay(preLogoffTime);

        this.tasks.logoff.cancel();
        this.tasks.logoff.delay(logoffTime);

        // End.
        return true;

    },
    /**
     * Create an dispatchable action object based on the given URI.
     * If the URI does not cover all expected action segments, segments from the
     * default action will be used.
     *
     * @param {String} uri description
     * @returns {Boolean} Void
     */
    getAction: function(uri)
    {
        var segments;
        var segment;
        var segmentsMatchingRegex = new RegExp(/\/([0-9A-Za-z\_]*)/g);
        // Default action.
        var action = {
            module: 'application',
            controller: 'dashboard',
            action: 'startup',
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
     * System methods.
     * Private methods.
     */

    /**
     * Create and store a new system model instance.
     * This method can also be used to reset the system model.
     *
     * @return {Boolean} Void.
     */
    initSystemInfo: function()
    {
        this.systemModel = this.getApplicationSystemModel().create();

        this.debug('Initialize system information model.', 'System');

        // End.
        return true;
    },
    /**
     * Configure a default error message and initialize an error listener that
     * will display all thrown errors in a messages box.
     *
     * @return {Boolean} Void.
     */
    initErrorHandler: function()
    {
        this.debug('Initialize error handler.', 'System');

        var self = this;
        var errorDefault = {
            scope: this,
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
                    window.location.href = '/';
                }

                if ('no' === buttonId) {
                    // Dispatch the report issue action.
                    this.dispatch({
                        module: 'application',
                        controller: 'issue',
                        action: 'report'
                    });
                }
            }
        };

        // Initialize the error listner.
        Ext.Error.handle = function(error)
        {
            error.msg += '\n\'Report issue\' to help debugging this system.\n\
\'Continue\' otherwise.';

            Ext.apply(errorDefault, error);

            if (!error.showError || false !== error.showError) {

                self.debug('New error throwed:', {
                    errorMsg: error.msg
                });

                Ext.Msg.show(errorDefault);
            }
        };

        // End.
        return true;
    },
    /**
     * Initialize several load listners that will trigger the beforeRequest,
     * requestComplete or requestException actions.
     *
     * @return {Boolean} Void.
     */
    initLoadListner: function()
    {
        this.debug('Initialize load listner.', 'System');

        this.getLoaderDOM().hide();

        Ext.Ajax.disableCaching = true;
        Ext.Ajax.disableCachingParam = '_';
        Ext.Ajax.method = 'GET';
        Ext.Ajax.extraParams = {
        };

        /**
         * Reset the logoff timer.
         * Show the loader animation.
         *
         * @param {Ext.data.Connection} conn This Connection object.
         * @param {Object} options A config object passed to the request method.
         */
        Ext.Ajax.on('beforerequest', this.beforeRequest, this);

        /**
         * Hide the loader animation.
         *
         * @param {Ext.data.Connection} conn This Connection object.
         * @param {Object} response The XHR object.
         * @param {Object} options A config object passed to the request method.
         */
        Ext.Ajax.on('requestcomplete', this.requestComplete, this);

        /**
         * If the response status = 401 Unauthorized?
         * Call the system logoff method:
         * Throw an exception.
         *
         * @param {Ext.data.Connection} conn This Connection object.
         * @param {Object} response The XHR object.
         * @param {Object} options A config object passed to the request method.
         */
        Ext.Ajax.on('requestexception', this.requestException, this);

        // End.
        return true;
    },
    /**
     * Initialize an change listener that will call the doRequest method if the
     * URI changes.
     *
     * @return {Boolean} Void.
     */
    initUriListner: function()
    {
        this.debug('Initialize URI listner.', 'System');

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
     * @return {Boolean} Void
     */
    initTasks: function()
    {
        this.debug('Initialize tasks.', 'System');

        this.tasks.preLogoff = new Ext.util.DelayedTask(function() {
            this.preLogoff('Pre logoff test.');
        }, this);

        this.tasks.logoff = new Ext.util.DelayedTask(function() {
            this.logoff('Logoff test.');
        }, this);

        // End.
        return true;
    },
    /**
     * COMMENTME
     */
    initOverriders: function()
    {
        this.debug('Override framework classes.', 'System');

        // ExtJs 4.1 does not support the loadMask anymore.
        // With this override the loadMask is enabled again.
        Ext.override(Ext.view.AbstractView, {
            onRender: function()
            {
                this.callOverridden();

                if (this.mask && Ext.isObject(this.store)) {
                    this.setMaskBind(this.store);
                }


            }
        });
    },
    /**
     * COMMENTME
     * TODO get the diff between get|post|update|delete
     *
     *
     * @private
     * @param {Ext.data.Connection} conn description1
     * @param {Object} options description2
     * @return {Boolean} Void.
     */
    beforeRequest: function(conn, options)
    {
        this.resetLogoffTimer();

        this.debug('Start loading data:', 'System', {
            action: options.action,
            method: options.method,
            url: options.url
        });

        this.getLoaderDOM().show();

        // End.
        return true;
    },
    /**
     * COMMENTME
     * TODO get the diff between get|post|update|delete
     *
     *
     * @private
     * @param {Ext.data.Connection} conn description1
     * @param {Object} response description2
     * @param {Object} options description3
     * @return {Boolean} Void.
     */
    requestComplete: function(conn, response, options)
    {
        this.debug('Data loaded:', 'System', {
            contentLength: response.getResponseHeader('content-length'),
            status: response.status,
            url: options.url
        });

        this.getLoaderDOM().hide();

        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     *
     * @private
     * @param {Ext.data.Connection} conn description1
     * @param {Object} response description2
     * @param {Object} options description3
     * @return {Boolean} Void.
     */
    requestException: function(conn, response, options)
    {

        this.getLoaderDOM().hide();

        switch (response.status) {
            case 401:
                this.debug('401 header received.', 'Error');

                // System logout.
                this.logoff(
                    'You are not authenticated by the server anymore.'
                    );
                break;
            default:
                this.debug('Data load exception:', 'Error', {
                    contentLength: response
                        .getResponseHeader('content-length'),
                    status: response.status,
                    url: options.url
                });

                Ext.Error.raise({
                    title: 'System load error.',
                    msg: 'Error while loading data from the server.\n\
The server didn\'t answered with the expected data.'
                });
        }

        // End.
        return true;
    }
});