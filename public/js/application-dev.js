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

// Preload required application file classes.
Ext.require([
    'App.navigation.Navigation',
    // App
    // Button
    // Chart
    // Container
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
    // Tree
    // Util
    'Ext.util.History',
    // Ux
    // View
    'Ext.container.Viewport',
    // Window
    'Ext.window.MessageBox',
    // Ajax
    'Ext.Ajax',
    // Models
    'App.model.application.System'
//    'App.model.Navigation',
]);

// Bootstrap application.
Ext.application({
    /**
     * Whatever this application is in development.
     */
    inDevelopment: true,
    /**
     * Whatever the user is logged on and the system config is initialized.
     */
    loggedon: false,
    /**
     * Define the application folder, here the application will search for all
     * needed classes.
     */
    appFolder: '/js/application',
    /**
     * The name of this application, this is also the application namespace
     * for all views, controllers, models and stores.
     */
    name: 'App',
    /**
     * Auto create viewport flag, if true the application will automatically
     * create a viewport before the application launch.
     */
    autoCreateViewport: false,
    /**
     * Enable quick tips flag, if true the application will automatically
     * Initialize the quick tip messager.
     */
    enableQuickTips: true,
    /**
     * Define all controllers, Be aware that the init method will be called
     * of all defined controllers before the application launch.
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
     * Contains all system information like event time, data models or debug
     * messages. This info object will be submited to the server when the logoff
     * method is called.
     */
    systemInfo: {
        bootTime: 0,
        logonTime: 0,
        logoffTime: 0,
        isLoggedOn: false,
        isAuthenticated: false,
        userModel: undefined,
        personModel: undefined,
        settingsModel: undefined,
        navigationHtml: '',
        toolbarConfig: {
        },
        debug: []
    },
    /**
     * Contains all system delayed task instances.
     */
    tasks: {
    },
    /**
     * Initialize the application.
     *
     * @return {Boolean} False, Prevent the application dispatch the configured
     *                   startup controller and action.
     */
    launch: function()
    {
        this.viewport = Ext.create('App.view.Viewport');

        this.navigation = Ext.create('App.navigation.Navigation');

        this.systemModel = this.getApplicationSystemModel().create();

        this.getSystemModel().set('bootTime', Ext.Date.now());

        this.debug('Application launch.');

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
     * These methods can be called from all classes. Controllers, Views, ect.
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
        return this.navigation
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
     * Return a Ext.CompositeElement instance of the application
     * header logo dom.
     *
     * @return Ext.CompositeElement
     */
    getLoaderDOM: function()
    {
        // End.
        return Ext.select('#application-header-loader');
    },
    /**
     * Return a Ext.CompositeElement instance of the application
     * header navigation dom.
     *
     * @return Ext.CompositeElement
     */
    getNavigationDOM: function()
    {
        // End.
        return Ext.select('#application-header-navigation');
    },
    /**
     * Return a Ext.CompositeElement instance of the application
     * header user info dom.
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
     * @return {Boolean} Void.
     */
    doRequest: function(uri)
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

        Ext.History.add(uri, true);

        action = this.getAction(uri);

        this.navigation.highlightTab(uri);

        this.dispatch(action);

        // End.
        return true;
    },
    /**
     * Log an messages that will form the application debug trace.
     *
     * @param {String} msg Debug messages.
     * @param {Object} dump Debug dump object.
     * @return {Booleand} Void
     */
    debug: function(msg, dump)
    {
        dump = dump || {
        };

        var debugLogs = this.getSystemModel().get('bebug');

        Ext.Array.insert(debugLogs, Ext.Date.now(), [{
                time: Ext.Date.now(),
                msg: msg,
                dump: dump
            }]);

//        this.getSystemModel().set('debug', debugLogs);

        console.info(msg/*, dump*/);

        // End.
        return true;
    },
    /**
     * Application methos.
     * Do not call these methods from somewhere else than this application class
     * unless absolutely necessary.
     */

    /**
     * Load the system information model, once loaded the given callback method
     * will be called with the systemModel as argument.
     *
     * @param {Function} callback
     * @return {Booleand} Void
     */
    loadSystemInfo: function(callback)
    {
        this.debug('Load system info.');

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
                systemModel.set('bebug', this.getSystemModel().get('bebug'));

                // Replace the systemModel.
                this.systemModel = systemModel;
            }

            Ext.callback(callback, this, [this.getSystemModel()]);

        }, this);

        // End.
        return true;
    },
    /**
     * Calls the systemModel save method.
     * This method will save the current data in the system model to the server.
     *
     * @returns {Booleand} Void
     */
    saveSystemInfo: function()
    {
        this.debug('Save system info.');

        // Remove unnecessary system data.
        this.getSystemModel().set('navigation', '');
        this.getSystemModel().set('toolbar', {
        });

        this.getSystemModel().save();

        // End.
        return true;
    },
    /**
     * If the user is authenticated by the server
     *
     * @return {Boolean} Void
     */
    logon: function()
    {
        var logon = function()
        {
            this.debug('System logon.');

            this.systemModel.set('logonTime', Ext.Date.now());

            this.buildNavigation();

            this.buildUserInfo();

            this.loggedon = true;

            // TODO get the logonAction from the systemInfo and dispatch it.
            this.doRequest(
                Ext.History.getToken()
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
     * Abort all load calls, reset the system information, set the
     * isAuthenticated and isLoggedOn flags to false, delete the navigationDOM
     * and userInfoDOM and call the application.authentication.login action that
     * will ask the server to destroy the login session and show an login window
     *
     * @param {String} msg Pre logoff message.
     * @return {Boolean} Void
     */
    preLogoff: function(msg)
    {
        this.debug('System pre-logoff.');

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
     * Abort all load calls, reset the system information, set the
     * isAuthenticated and isLoggedOn flags to false, delete the navigationDOM
     * and userInfoDOM and call the application.authentication.login action that
     * will ask the server to destroy the login session and show an login window
     *
     * @param {String} msg Logoff message.
     * @return {Boolean} Void
     */
    logoff: function(msg)
    {
        this.debug('System logoff.');

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

        Ext.Ajax.abortAll();

        this.getNavigationDOM()
            .hide()
            .setHTML('<li></li>');

        this.getUserInfoDOM()
            .hide()
            .setHTML('');

        this.getViewport().down('[region=center]').removeAll();

        Ext.each(openWindows, function(window) {
            if (window.rendered) {
                window.close();
            }
        }, this);

        this.getSystemModel().set('logoffTime', Ext.Date.now());
        this.saveSystemInfo();

        // TODO reset the systemModel.

        this.tasks.preLogoff.cancel();
        this.tasks.logoff.cancel();

        this.dispatch(loginAction);

        // End.
        return true;
    },
    /**
     * Dispatch the given action object.
     * If either the Module, Controller or Action does not exists an exception
     * will be thrown.
     *
     * @param {Object} action This action object contains the module, controller
     * and action name.
     * @return {Boolean} Void
     */
    dispatch: function(action)
    {
        this.debug('New action dispatched:', action);

        var moduleName = Ext.String.uncapitalize(action.module);
        var controllerName = Ext.String.capitalize(action.controller);
        var moduleControllerName = moduleName + '.' + controllerName;
        var actionName = Ext.String.uncapitalize(action.action) + 'Action';
        var controller = this.controllers.get(moduleControllerName);

        if (undefined === controller || undefined === controller[actionName]) {
            Ext.Error.raise({
                title: 'Application dispatch error.',
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
     * navigation call.
     *
     * @return {Booleand} Void
     */
    buildNavigation: function()
    {
        var nagigationHTML = this.getSystemModel().get('navigation');

        this.getNavigationDOM().setHTML(nagigationHTML);

        this.navigation.init();

        this.getNavigationDOM().show(true);

        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     * @return {Booleand} Void
     */
    buildUserInfo: function()
    {
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
     * Init methods.
     * Treat this methods as private.
     */

    /**
     * Configure a default error message and initialize an error listener that
     * will display all thrown errors in a messages box.
     *
     * @return {Boolean} Void.
     */
    initErrorHandler: function()
    {
        this.debug('Initialize error handler.');

        var self = this;
        var errorDefault = {
            scope: this,
            closable: true,
            modal: true,
            multiline: false,
            title: 'Application error',
            msg: 'Undefined error message',
            icon: Ext.Msg.ERROR,
            cls: 'x-fix-msg-msg',
            animateTarget: Ext.get('application-header-logo'),
            buttons: Ext.Msg.YESNOCANCEL,
            buttonText: {
                yes: 'Relaunch Application',
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
     * requestComplete or requestException events.
     *
     * @return {Boolean} Void.
     */
    initLoadListner: function()
    {
        this.debug('Initialize load listner.');

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
        Ext.Ajax.on('beforerequest', function(conn, options)
        {
            this.resetLogoffTimer();

            this.debug('New request:', {
                action: options.action,
                method: options.method,
                url: options.url
            });

            this.getLoaderDOM().show();
        }, this);

        /**
         * Hide the loader animation.
         *
         * @param {Ext.data.Connection} conn This Connection object.
         * @param {Object} response The XHR object.
         * @param {Object} options A config object passed to the request method.
         */
        Ext.Ajax.on('requestcomplete', function(conn, response, options)
        {
            this.debug('Request completed:', {
                contentLength: response.getResponseHeader('content-length'),
                status: response.status,
                url: options.url
            });

            this.getLoaderDOM().hide();
        }, this);

        /**
         * If the response status = 401 Unauthorized?
         * Call the system logoff method:
         * Throw an exception.
         *
         * @param {Ext.data.Connection} conn This Connection object.
         * @param {Object} response The XHR object.
         * @param {Object} options A config object passed to the request method.
         */
        Ext.Ajax.on('requestexception', function(conn, response, options)
        {
            this.getLoaderDOM().hide();

            switch (response.status) {
                case 401:
                    // System logout.
                    this.logoff(
                        'You are not authenticated by the server anymore.'
                        );
                    break;
                default:
                    this.debug('Request exception:', {
                        contentLength: response.getResponseHeader(
                            'content-length'),
                        status: response.status,
                        url: options.url
                    });

                    Ext.Error.raise({
                        title: 'Application load error.',
                        msg: 'Error while loading data from the server.\n\
The server didn\'t answered with the expected data.'
                    });
            }
        }, this);

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
        this.debug('Initialize URI listner.');

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
        this.debug('Initialize tasks.');

        this.tasks.preLogoff = new Ext.util.DelayedTask(function() {
            this.preLogoff('Pre logoff test.');
        }, this);

        this.tasks.logoff = new Ext.util.DelayedTask(function() {
            this.logoff('Logoff test.');
        }, this);

        // End.
        return true;
    }
});