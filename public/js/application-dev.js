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
    }
});

// Preload required system file classes.
Ext.require([
    'App.navigation.Navigation',
    'App.crypt.Md5',
    // App
    // Button
    // Chart
    // Container
//    'Ext.container.Viewport',
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
//    'Ext.toolbar.Toolbar',
//    'Ext.toolbar.Paging',
    // Tree
    // Util
    'Ext.util.History',
    // Ux
    // View
    'App.view.Viewport',
//    'Ext.view.AbstractView',
    'App.view.application.Window',
    'App.view.application.system.panel.About',
    'App.view.application.system.panel.Docs',
    'App.view.application.issue.form.Report',
    // Window
//    'Ext.window.MessageBox',
    // Ajax
//    'Ext.Ajax',
    // Models
    'App.model.application.System',
    'App.model.application.Priority'
]);

//Ext.define('Ext.app.Application.I18n', {
//    override: 'Ext.application.Application',
//    loadSystemInfoLoadErrorTitle: 'Systeem fout',
//    loadSystemInfoLoadErrorMsg: 'De vereiste systeem opslag kan niet worden geladen.',
//    loadSystemInfoLoadErrorBtnOk: 'Start systeem opniew op'
//});

// Bootstrap system.
Ext.application({
    errorDefaultTitle: 'System error',
    errorDefaultMsg: 'Undefined error message',
    errorDefaultMsgFuffix: '\n\'Report issue\' to help debugging this system.\n\
\'Continue\' otherwise.',
    errorDefaultBtnYes: 'Relaunch System',
    errorDefaultBtnNo: 'Report issue',
    errorDefaultBtnCancel: 'Continue',
    dispatchInvalidControllerErrorTitle: 'System dispatch error.',
    dispatchInvalidControllerErrorMsg: 'Could not load system module.',
    dispatchInvalidControllerErrorBtnYes: 'Relaunch System',
    dispatchInvalidControllerErrorBtnNo: 'Report this issue',
    loadSystemInfoLoadErrorTitle: 'System error',
    loadSystemInfoLoadErrorMsg: 'The required system storage could not be loaded',
    loadSystemInfoLoadErrorBtnOk: 'Relaunch System',
    requestExceptionDefaultErrorTitle: 'System load error.',
    requestExceptionDefaultErrorMsg: 'Error while loading data from the server.\n\
The server didn\'t answered with the expected data.',
    logoffMsg: 'The system isn\'t used for 45 minutes or longer.',
    preLogoffMsg: 'The system isn\'t used for 30 minutes or longer.',
    /*------------------------------------------------------------------------*/
    /**
     * Whatever the system is in development.
     * If the system is in developement modus, the system will log all debug
     * messages to the browser console.
     */
    inDevelopment: true,
    /**
     * Whatever the user is logged on.
     * If the user is not logged on, the system will be shutted down.
     */
    loggedon: false,
    /**
     * Whatever the system is started up.
     * If the system is not started, no action will be dispatched.
     */
    startedup: false,
    /**
     * Whatever to enable the quick tips manager.
     * If true the system will automatically initialize the quick tip manager.
     */
    enableQuickTips: true,
    /**
     * Define the system classes folder.
     * Here the system will search for all needed classes.
     */
    appFolder: '/js/application',
    /**
     * The name of this system.
     * This is also the system namespace for all views, controllers, models and stores.
     */
    name: 'App',
    /**
     * Define all controllers.
     * Be aware that the init method will be called of all defined controllers
     * before the system launch.
     * Define controllers as modulename.Controllername.
     */
    controllers: [
        'application.About',
        'application.Account',
        'application.Authentication',
        'application.Dashboard',
        'application.Issue',
        'application.Messages',
        'application.Settings',
        'admin.Countries',
        'admin.Locales',
        'admin.Roles',
        'admin.Translate',
        'admin.Users'
    ],
    /**
     * Required models.
     */
    models: [
        'application.System',
        'application.User'
    ],
//    stores: ['application.Priority'], // Tmp will be removed while the userNavigation methods are replaced to controllers.
    views: [// Move all views and controls to controllers.
        'application.Window',
        'application.system.panel.Docs',
        'application.system.panel.About',
        'application.issue.form.Report'
    ],
    /**
     * Instance of the current App.view.Viewport class.
     * This viewport is available after the launch method is called.
     *
     * @see Ext.Viewport
     */
    viewport: undefined,
    /**
     * Instance of the current App.navigation.Navigation class.
     * This navigation is available after the launch method is called.
     *
     * @see App.navigation.Navigation
     */
    navigation: undefined,
    /**
     * Instance of the current App.model.application.System model.
     * This system model is available after the launch method is called and will
     * contain all system and user settings.
     *
     * App.model.application.System
     */
    systemModel: undefined,
    /**
     * Name of the current dispatched controller.
     * If a new action is dispatched from the current controller, the startup
     * action will not be called.
     */
    activeController: undefined,
    /**
     * Contains all system delayed task instances.
     */
    tasks: {
    },
    /**
     * Initialize and bootstrap the system.
     *
     * @public
     * @return {Boolean} False, Prevent the system dispatch the configured
     *                   startup controller and action.
     */
    launch: function()
    {
        this.debug('Bootstrap system.', 'info');

        this.getSystemModel().set('boot_time', Ext.Date.now());

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
     * Returns true, if and only if, the user storage is_active field is set to true.
     *
     * @public
     * @return {Boolean}
     */
    isAuthenticated: function()
    {
        var userModel = this.getUserModel(),
            isActive = false;

        if (userModel && (true === userModel.get('is_active'))) {
            isActive = true;
        }

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
     * Return the default authenticate action.
     *
     * @public
     * @return {Object} authenticate action object.
     */
    getAuthenticateAction: function()
    {
        var authenticateAction = {
            module: 'application',
            controller: 'authentication',
            action: '',
            register: false,
            args: {
                logoutFirst: true
            }
        };

        // End.
        return authenticateAction;
    },
    /**
     * Return a instance or App.view.Viewport
     * or false if the viewport is undefined
     *
     * @public
     * @return {App.view.Viewport|false}
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
     * or false if the navigation is undefined.
     *
     * @public
     * @return {App.navigation.Navigation|false}
     */
    getNavigation: function()
    {
        // End.
        return (this.navigation)
            ? this.navigation
            : false;
    },
    /**
     * Return a instance of App.model.application.System.
     *
     * @public
     * @return {App.model.application.System}
     */
    getSystemModel: function()
    {
        if (!this.systemModel || !this.systemModel.isModel) {
            this.systemModel = this.getApplicationSystemModel().create();
        }

        // End.
        return this.systemModel;
    },
    /**
     * Return a instance of App.model.User
     * or null if the user model is undefined.
     *
     * @public
     * @return {App.model.User|null}
     */
    getUserModel: function()
    {
        var userModel = this.getSystemModel().getUser();

        // End.
        return (userModel.isModel)
            ? userModel
            : null;
    },
    /**
     * Return a instance of App.model.Person
     * or null if the person model is undefined.
     *
     * @public
     * @return {App.model.Person|null}
     */
    getPersonModel: function()
    {
        var userModel = this.getUserModel(),
            personModel = null;

        if (userModel.isModel) {
            personModel = userModel.getPerson();
        }

        // End.
        return personModel;
    },
    /**
     * Return a Ext.CompositeElement instance of the system header logo dom.
     *
     * @public
     * @return {Ext.CompositeElement}
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
     * @param {Boolean} returnId Whatever to return the navigation DOM id or Element.
     * @return {Ext.CompositeElement}
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
     * @param {Boolean} returnId Whatever to return the user info DOM id or Element.
     * @return {Ext.CompositeElement}
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
     * Create a action object based on the given URI and dispatch it.
     * If the uri is empty or equal to `!`, the uri will not be dispatched.
     * If the uri is equal to `/` the default action uri will be dispatched.
     *
     * @public
     * @param {String} uri
     * @return {Boolean} Whatever the URI is dispatched.
     */
    dispatchUri: function(uri)
    {
        var action,
            isDispached;

        if (!uri || '!' === uri) {
            // End.
            return false;
        }

        if ('/' === uri) {
            // TODO get this path from the system settings.
            uri = '/application/dashboard';
        }

        action = this.buildAction(uri);

        isDispached = this.dispatch(action);

        if (isDispached) {
            // Highlight the navigation tab for this uri.
            this.navigation.highlightTab(uri);
        }

        // End.
        return true;
    },
    /**
     * Dispatch the given action.
     * If the system is not started, the action will not be dispatched, unless
     * the force flag is set to true.
     *
     * @public
     * @param {Object} action
     * @param {Boolean} force
     * @return {Boolean} Void
     */
    dispatch: function(action, force)
    {
        this.debug('Dispatch new action:', 'info', action);

        var force = (force === true) || false,
            dispatchable = this.buildDispatchable(action),
            controller = dispatchable.controller,
            controllerName = dispatchable.moduleControllerName,
            arguments = action.args,
            action = dispatchable.action,
            register = dispatchable.register;

        if (!this.isStartedup() && !force) {
            // End.
            return false;
        }

        if (controllerName !== this.activeController) {
            // Call the startup action.
            controller['startupAction'](arguments);

            if (!register) {
                this.activeController = controllerName;
            }
        }

        if (action) {
            controller[action](arguments);
        }

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

        var systemModel,
            operation = new Ext.data.Operation({
            action: 'read'
        });

        this.getSystemModel().getProxy().read(operation, function(operation)
        {
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
                    title: this.loadSystemInfoLoadErrorTitle,
                    msg: this.loadSystemInfoLoadErrorMsg,
                    icon: Ext.Msg.ERROR,
                    cls: 'x-fix-msg-msg',
                    animateTarget: Ext.get('application-header-logo'),
                    buttons: Ext.Msg.OK,
                    buttonText: {
                        ok: this.loadSystemInfoLoadErrorBtnOk
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

            // Copy the system timestamps and debug messages.
            systemModel.set('boot_time', this.getSystemModel().get('boot_time'));
            systemModel.set('login_time', this.getSystemModel().get('login_time'));
            systemModel.set('logoff_time', this.getSystemModel().get('logoff_time'));
            systemModel.set('debug', this.getSystemModel().get('debug'));

            // Replace the systemModel.
            this.systemModel = systemModel;

            Ext.callback(callback, this, [systemModel]);

            // End.
            return true;
        }, this);
    },
    /**
     * Save the system model.
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
     * Log messages that will form the system debug trace.
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
        var systemModel = this.getSystemModel(),
            msg = msg || 'Unknown messages',
            dump = dump || {
        },
            debugLogs,
            levelLogs,
            l;

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
        if (this.isInDevelopment() && window.console) {
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
            debugLogs[level] = [];
        }

        levelLogs = debugLogs[level];

        levelLogs.push({
            msg: msg,
            dump: dump
        });

        systemModel.set('debug', debugLogs);

        // End.
        return true;
    },
    /**
     * If the user is authenticated by the server,
     * the system will started up,
     * else, a authenticate action will be dispatched.
     *
     * @public
     * @return {Boolean} Void
     */
    logon: function()
    {
        this.debug('Attempt to logon.', 'info');

        this.resetLogoffTimer();

        this.loadSystemInfo(function()
        {
            if (!this.isAuthenticated()) {
                this.dispatch(this.getAuthenticateAction(), true);

                // End.
                return false;
            }

            this.debug('System logon.', 'info');

            this.systemModel.set('login_time', Ext.Date.now());

            this.loggedon = true;

            this.startup();

            // End.
            return true;
        });

        // End.
        return true;
    },
    /**
     * // CONTINUE here.
     *
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

        var authenticateAction = this.getAuthenticateAction();
        authenticateAction.args = {
            msg: Ext.isString(msg)
                ? msg
                : undefined
        };

        this.loggedon = false;
        this.systemModel = this.getApplicationSystemModel().create();

        this.tasks.preLogoff.cancel();

        this.dispatch(authenticateAction);

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

        var authenticateAction = this.getAuthenticateAction();
        authenticateAction.args.msg = Ext.isString(msg)
            ? msg
            : undefined;

        this.loggedon = false;
        this.systemModel = this.getApplicationSystemModel().create();

        this.getSystemModel().set('logoff_time', Ext.Date.now());

        this.shutdown();

        this.dispatch(authenticateAction, true);

        // End.
        return true;
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
            logoff_time = ((60 * 1000) * 45); // 45 min.

        this.tasks.preLogoff.cancel();
        this.tasks.preLogoff.delay(preLogoffTime);

        this.tasks.logoff.cancel();
        this.tasks.logoff.delay(logoff_time);

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
            title: this.errorDefaultTitle,
            msg: this.errorDefaultMsg,
            icon: Ext.Msg.ERROR,
            cls: 'x-fix-msg-msg',
            animateTarget: Ext.get('application-header-logo'),
            buttons: Ext.Msg.YESNOCANCEL,
            buttonText: {
                yes: this.errorDefaultBtnYes,
                no: this.errorDefaultBtnNo,
                cancel: this.errorDefaultBtnCancel
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
                        register: false
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
                errorDefault.msg += self.errorDefaultMsgFuffix;
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
     * Initialize an change listener that will call the dispatchUri method if the
     * URI changes.
     *
     * @private
     * @return {Boolean} Void.
     */
    initUriListner: function()
    {
        this.debug('Initialize URI listner.', 'info');

        Ext.History.init();

        Ext.History.on('change', this.dispatchUri, this);

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
            this.preLogoff(this.preLogoffMsg);

            // End.
            return true;
        }, this);

        this.tasks.logoff = new Ext.util.DelayedTask(function()
        {
            // Shutdown the system.
            this.logoff(this.logoffMsg);
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

        // WORKAROUND
        // Override this application instance to enable the translation/ i18n
        // functionality.
        // I was not able to override the Ext.application.Applicaton or
        // Ext.Application instance. This a work-around, please improve.
//        Ext.override(this, i18nApplication);

        // Apply custom VTypes.
        // see http://docs.sencha.com/ext-js/4-1/#!/api/Ext.form.field.VTypes
        Ext.apply(Ext.form.field.VTypes, {
            // VType name
            vname: function(value, field)
            {
                alert('vtype test');

                // End.
                return value;
            }
        });

        // End.
        return true;
    },
    /**
     * Create an dispatchable action object based on the given path.
     *
     * @private
     * @param {String} path description
     * @returns {Boolean} Void
     */
    buildAction: function(path)
    {
        var segmentsMatchingRegex = new RegExp(/\/([0-9A-Za-z\_]*)/g),
            segments,
            segment,
            action = {
            module: '',
            controller: '',
            action: '',
            args: {
            }
        };

        path = '/' + path;
        path = path.replace(/^\/\//, '/');

        segments = path.match(segmentsMatchingRegex) || [];

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
     * COMMENTME
     *
     * @private
     * @param {Object} action description
     * @return {Object} Void.
     */
    buildDispatchable: function(action)
    {
        var moduleName = Ext.String.uncapitalize(action.module),
            controllerName = Ext.String.capitalize(action.controller),
            moduleControllerName = moduleName + '.' + controllerName,
            actionName = Ext.String.uncapitalize(action.action) + 'Action',
            controller = this.controllers.get(moduleControllerName);
        var dispatchable = {
            controller: undefined,
            controllerName: controllerName,
            moduleControllerName: moduleControllerName,
            action: undefined,
            register: action.register || true
        };

        if (!controller) {
            Ext.Error.raise({
                title: this.dispatchInvalidControllerErrorTitle,
                msg: this.dispatchInvalidControllerErrorMsg,
                closable: false,
                addSuffix: false,
                buttons: Ext.Msg.YESNO,
                buttonText: {
                    yes: this.dispatchInvalidControllerErrorBtnYes,
                    no: this.dispatchInvalidControllerErrorBtnNo
                }
            });

            // End.
            return false;
        }

        dispatchable.controller = controller;

        actionName = ('Action' === actionName)
            ? false
            : actionName;

        if (!actionName) {
            // End.
            return dispatchable;
        }

        if ((undefined === controller[actionName])) {
            this.debug('Action ' + actionName + ' do not exist in controller '
                + controllerName + '.', 'warning'
                );

            // End.
            return dispatchable;
        }

        dispatchable.action = actionName;

        // End.
        return dispatchable;
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
            menuItems,
            userInfoDOMId = this.getUserInfoDOM(true),
            userMenu = this.getSystemModel().get('userMenu'),
            personModel = this.getPersonModel(),
            fullname = personModel.get('fullname');

        // Create a new button and add it to the user info DOM.
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
                items: userMenu
            }
        });

        // Walk each user navigation items.
        menuItems = userInfoButton.menu.items;
        menuItems.each(function(item)
        {
            if (!item.action) {
                return;
            }

            var path = 'application/' + item.action,
                action = this.buildAction(path),
                dispatchable = this.buildDispatchable(action),
                controller = dispatchable.controller,
                action = dispatchable.action || 'startupAction';

            item.on('click', controller[action], controller);
        }, this);

        this.getUserInfoDOM().show(true);

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
                    url: options.url || ''
                });
                break;
            case 0:
                this.debug('Connection with the server was not possible, ' +
                    'possibly the server or your internet connection is down.', 'warning', {
                    url: options.url || ''
                });
                break;
            case 401:
                this.debug('The user is not authenticated by the server.', 'warning', {
                    url: options.url || ''
                });

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
                    addSuffix: true,
                    title: this.requestExceptionDefaultErrorTitle,
                    msg: this.requestExceptionDefaultErrorMsg
                });
        }

        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     * @private
     * @return {Boolean} Void.
     */
    startup: function()
    {
        this.debug('System startup.', 'info');

        this.startedup = true;

        this.buildNavigation();

        this.buildUserInfo();

        if ('!' === Ext.History.getToken()) {
            Ext.History.add('/', true);
        }

        this.dispatchUri(Ext.History.getToken());

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
    },
    /**
     * COMMENTME
     *
     * @private
     * @param {string} documentId description
     * @return {Boolean} Void.
     */
    openDocs: function(documentId)
    {
        var window,
            documentationPanel;

        window = this.getApplicationWindowView().create({
            icon: '/images/icons/black/book_icon&16.png',
            title: 'Documentation'
        });

        documentationPanel = this.getApplicationSystemPanelDocsView().create({
            loader: {
                url: '/~docs/' + documentId,
                autoLoad: true,
                renderer: 'html'
            }
        });

        window.add(documentationPanel);
        window.show();

        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     * @public
     * @return {Boolean} Void.
     */
    _account: function()
    {
        alert('User account.');

        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     * @public
     * @return {Boolean} Void.
     */
    _settings: function()
    {
        alert('System settings.');

        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     * @public
     * @return {Boolean} Void.
     */
    _changeImage: function()
    {
        alert('Change user image.');

        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     * @public
     * @return {Boolean} Void.
     */
    _messages: function()
    {
        alert('Personal messages.');

        // End.
        return true;
    },
    /**
     * Open the about window.
     * The about content will be loaded from /~system/about/
     *
     * @public
     * @return {Boolean} Void.
     */
    _about: function()
    {
        var window = this.getApplicationWindowView().create({
            icon: '/images/icons/black/tag_icon&16.png',
            title: 'About BackenManager'
        }),
        aboutPanel = this.getApplicationSystemPanelAboutView().create({
            loader: {
                url: '/~docs/systemAbout',
                autoLoad: true,
                renderer: 'html'
            }
        });


        window.add(aboutPanel);
        window.show();

        // End.
        return true;
    },
    /**
     * COMMENTME
     *
     * @public
     * @return {Boolean} Void.
     */
    _reportBug: function()
    {
        var window = this.getApplicationWindowView().create({
            icon: '/images/icons/black/bug_icon&16.png',
            title: 'Report a bug',
            buttons: [{
                    text: 'Cancel'
                }, {
                    text: 'Report'
                }]
        }),
        reportIssueForm = this.getApplicationIssueFormReportView().create();

        window.add(reportIssueForm);
        window.show();


        // Dispatch the report issue action silent.

        // End.
        return true;
    }
});