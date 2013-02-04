/**
 * Priority.js
 * Created on Feb 4, 2013 1:09:53 AM
 *
 * @author    Boy van Moorsel <development@wittestier.nl>
 * @license   -
 * @copyright 2012 witteStier.nl
 */
Ext.define('App.store.application.Priority', {
    extend: 'Ext.data.Store',
//    model: 'App.model.application.Priority',
    fields: [{
            name: 'id',
            type: 'int'
        }, {
            name: 'name',
            type: 'string'
        }, {
            name: 'desc',
            type: 'string'
        }],
    data: [{
            id: 1,
            name: 'error',
            desc: 'This bug prevents me to use this system.'
        }, {
            id: 2,
            name: 'warning',
            desc: 'I can\'t live with this.'
        }, {
            id: 3,
            name: 'info',
            desc: 'I don\'t think this is normal.'
        }, {
            id: 4,
            name: 'detail',
            desc: 'Some additional information you maybe like to know.'
        }, {
            id: 9,
            name: 'compliments',
            desc: 'My compliments, i like this system.'
        }, {
            id: 10,
            name: 'unknown',
            desc: 'Whatever.'
        }]
});