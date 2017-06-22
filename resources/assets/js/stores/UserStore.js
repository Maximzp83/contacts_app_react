/**
 * Created by maxim on 12.06.17.
 */

import AppDispatcher from'../dispatcher';
import extend from 'lodash/extend';
import userApi from '../api/userApi';
import { EventEmitter } from'events';
import actions from '../actions';
import StandardStore from './StandardStore';

var Constants = require('../constants');


var _dataFromBackend = {
    user: {role: 'guest'},
    contacts: {},
};
console.log('_dataFromBackend in Store!!!!:', _dataFromBackend);

var _user = {role: 'guest'};

var _isLoaded = false;
// var _contacts = {};




var _errors = false;

// var _isLoaded = false;


var UserStore = extend({}, StandardStore, {

    getIsLoaded() {
        return _isLoaded;
    },

    getData() {
        return _dataFromBackend;
    },

    getUser() {
        return _user;
    },


    getErrors() {
        // console.log('errors in store!!!', _errors);
        return _errors;
    },

    setErrors(value) {
        _errors = value;
    }


});

UserStore.dispatchToken = AppDispatcher.register(function(payload) {
    var action = payload.action;
    var data = payload.action.data;

    switch(action.actionType) {

        case Constants.USER_API_GET_MAIN_DATA_ATTEMPT:
            _isLoaded = false;
            userApi.getMainDataFromBackend();
            break;

        case Constants.USER_API_GET_MAIN_DATA_SUCCESS:
            // console.log('data from backend in Store: ', data );
            _isLoaded = true;
            _user = data.user;

            break;

        case Constants.USER_API_REGISTRATION_ATTEMPT:
            // console.log('data from registration form to Store: ', data );
            userApi.userRegistration(data);

            break;

        case Constants.USER_API_REGISTRATION_SUCCESS:
            // console.log('registration data from Store receive in server', data);
            _user = data;

            break;

        case Constants.USER_API_REGISTRATION_ERRORS:
            // console.log('registration errors from server:', data);
            _errors = data;

            break;

        case Constants.USER_API_LOGIN_ATTEMPT:
            // console.log('data from login form to Store: ', data );
            userApi.userLogin(data);

            break;

        case Constants.USER_API_LOGIN_SUCCESS:
             // console.log('login data SUCCESS:', data);
             _user = data;

            break;

        case Constants.USER_API_LOGIN_ERRORS:
            // console.log('login errors from server:', data);
            _errors = data;

            break;

        case Constants.USER_API_LOGOUT_ATTEMPT:
            // console.log('logout in progress');
            userApi.logout();

            break;

        case Constants.USER_API_LOGOUT_SUCCESS:
            if (data) {
                // console.log('User logout ok', data);
                _user = data;
            }

            break;

        default: return true;
    }

    UserStore.emitChange();

    return true;

});

module.exports = UserStore;