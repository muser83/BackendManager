Ext.define('App.model.application.System', {
    extend: 'Ext.data.Model',
    uses: [
//        'App.model.application.User',
//        'App.model.application.Person',
//        'App.model.application.Settings'
    ],
//    hasMany: [{
//            model: 'associated_model_name',
//            name: 'getAssociatedModelStore', // GetModelStore ?
//            associationKey: 'associated_data_name',
//            foreignKey: 'id', // lowercased name of the owner model plus "_id".
//            primaryKey: 'id', // Associated model primary key.
//            autoLoad: false,
//            filterProperty: undefined,
//            storeConfig: undefined
//        }],
//    hasOne: [{
//            model: 'associated_model_name',
//            getterName: 'getAssociatedModel',
//            setterName: 'setAssociatedModel',
//            associationKey: 'associated_data_name',
//            foreignKey: 'id', // lowercased name of the owner model plus "_id".
//            primaryKey: 'id' // Associated model primary key.
//        }],
//    belongsTo: [{
//            model: 'owner_model_name',
//            getterName: 'getOwnerModel',
//            setterName: 'setOwnerModel',
//            associationKey: 'owner_data_name',
//            foreignKey: 'id', // lowercased name of the owner model plus "_id".
//            primaryKey: 'id' // Owner model primary key.
//        }],
//    validations: [],
    fields: [{
            name: 'bootTime',
            type: 'date',
            defaultValue: 0
        }, {
            name: 'logonTime',
            type: 'date',
            defaultValue: 0
        }, {
            name: 'logoffTime',
            type: 'date',
            defaultValue: 0
        }, {
            name: 'navigation',
            type: 'string',
            persist: false,
            defaultValue: ''
        }, {
            name: 'toolbar',
            type: 'object', // auto, string, int, float, boolean, date
            persist: false,
            defaultValue: {}
        }, {
            name: 'bebug',
            type: 'object',
            defaultValue: {}
        }],
    proxy: {
        type: 'ajax',
        url: '~system',
        reader: {
            type: 'json',
            root: 'system',
            messageProperty: 'message'
        },
        writer: {
            type: 'json',
            nameProperty: 'name',
            writeAllFields: true,
            allowSingle: true,
            encode: false,
            root: 'system',
            getRecordData: function(record) {
                Ext.apply(record.data, record.getAssociatedData());
                return record.data;
            }
        }
    }
});