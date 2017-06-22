/**
 * Created by maxim on 09.06.17.
 */
var EventEmitter = require('events').EventEmitter;
var extend = require('lodash/extend');

var StandardStore = extend({}, EventEmitter.prototype, {

    emitChange: function() {
        this.emit('change');
    },

    addChangeListener: function(callback) {
        this.on('change', callback);
    },

    removeChangeListener: function(callback) {
        this.removeListener('change', callback);
    }

});

StandardStore.setMaxListeners(100);

module.exports = StandardStore;