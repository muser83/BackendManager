/**
 * User.js
 * Created on Jan 20, 2013 11:58:59 PM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.model.application.User', {
    extend: 'App.model.User',
    uses: [
        'App.model.Person'
    ],
    hasOne: [{
            model: 'App.model.Person',
            getterName: 'getPerson',
            setterName: 'setPerson',
            associationKey: 'persons',
            foreignKey: 'persons_id'
        }],
//    validations: [],
    proxy: {
        type: 'ajax',
        url: '~authentication/login',
        reader: {
            type: 'json',
            root: 'user',
            messageProperty: 'message'
        },
        writer: {
            type: 'json',
            nameProperty: 'mapping',
//            allowSingle: true,
            encode: true,
            root: 'user'
        }
    }

});