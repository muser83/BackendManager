/**
 * Window.js
 * Created on Oct 18, 2012 9:40:51 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.view.application.authentication.Window', {
    extend: 'Ext.window.Window',
    icon: '/images/icons/user.png',
    title: 'Login',
    animateTarget: null,
    border: true,
    shrinkWrap: 3,
    constrain: true,
    modal: true,
    closable: false,
    resizable: false,
    draggable: false,
    tools: [{
            scope: this,
            tooltip: 'Help',
            type: 'help',
            handler: function()
            {
                Ext.Msg.show({
                    title: 'Authentication help',
                    icon: Ext.Msg.QUESTION,
                    closable: false,
                    msg: 'Use your credentials to authenticate.\n If you dont know you credentials anymore click\
                          \'Dont know my credentials\'.\nIf your new to this\
                          system click \'I am new\'.',
                    buttons: Ext.Msg.YESNOCANCEL,
                    cls: 'x-fix-msg-msg',
                    buttonText: {
                        yes: 'Ok',
                        no: 'Dont know my credentials',
                        cancel: 'I am new'
                    },
                    fn: function(buttonId)
                    {
                        if ('no' === buttonId) {
                            alert('I don\'t know your credentials either.');
                        }

                        if ('cancel' === buttonId) {
                            alert('I also was once.');
                        }
                    }
                });
            }
        }],
    defaultFocus: undefined,
    items: [],
    buttons: [{
            icon: '/images/icons/unlock.png',
            text: 'Login',
            action: 'authenticate'
        }],
    initComponent: function()
    {
        this.callParent();
    }
});