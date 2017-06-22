/**
 * Created by maxim on 09.06.17.
 */
var Dispatcher = require('./dispatcher');
var Constants = require('./constants');

var actions = {
    handle: function(constant, data) {
        Dispatcher.handleAction({
            actionType: Constants[constant],
            data: data
        });
    },
};

module.exports = actions;