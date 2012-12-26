var field = {
    name: '',
    type: '', // auto, string, int, float, boolean, date
    persist: true,
    mapping: undefined,
    defaultValue: '',
    useNull: false
};

Ext.define('App.templates.data.Field', {
    extend: 'Ext.app.Controller',
    convert: undefined,
    dateFormat: undefined,
    dateReadFormat: undefined,
    dateWriteFormat: undefined,
    defaultValue: '',
    mapping: undefined,
    name: '',
    persist: true,
    serialize: undefined,
    sortDir: 'ASC',
    sortType: undefined,
    type: '',
    useNull: false
});