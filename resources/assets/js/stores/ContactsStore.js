/**
 * Created by maxim on 09.06.17.
 */
import AppDispatcher from'../dispatcher';
import extend from 'lodash/extend';
import contactsApi from '../api/contactsApi';
import { EventEmitter } from'events';
import actions from '../actions';
import StandardStore from './StandardStore';

var Constants = require('../constants');


var _contacts = null;
var _contactToEdit = null;
var _friendsContacts = null;

// var _isLoading = false;
var _isLoadedContact = false;
var _isLoaded = false;

var _warningMessage = false;

/*function isOpen(){
    return _open;
}*/

var ContactsStore = extend({}, StandardStore, {

    getContacts() {
        return _contacts;
    },

    getFriendsContacts() {
        return _friendsContacts;
    },

    getContactToEdit() {
        return _contactToEdit;
    },

    setContacts(data) {
        _contacts = data;
    },

    setWarningMessage(data) {
        _warningMessage = data;
    },

    getWarningMessage() {
       return _warningMessage;
    },

    getIsLoadedContact() {
        return _isLoadedContact;
    },

    getIsLoaded() {
        return _isLoaded;
    },



    /*getContacts() {
        if(!_isLoading && !_isLoaded) {
           setTimeout(function () {
               actions.handle ('CONTACTS_API_LOAD');
           }, 0)
        }
        // console.log('getContacts called');

    },*/

});

ContactsStore.dispatchToken = AppDispatcher.register(function(payload) {
    var action = payload.action;
    var data = payload.action.data;

    switch(action.actionType) {
        case Constants.CONTACTS_API_GET_CONTACTS_ATTEMPT:
            _isLoaded = false;

            // setTimeout(function () {
                contactsApi.getContactsFromBackend();
            // }, 0);

            break;

        case Constants.CONTACTS_API_GET_CONTACTS_SUCCESS:
            _isLoaded = true;

            // console.log('data from backend in Store: ', data );
            _contacts = data.contacts;

            break;

        case Constants.CONTACTS_API_GET_CONTACT_TO_EDIT_ATTEMPT:
            _isLoadedContact = false;

            setTimeout(function () {
                contactsApi.getContactToEditFromBackend(data);
            }, 0);

            break;

        case Constants.CONTACTS_API_GET_CONTACT_TO_EDIT_SUCCESS:
            _isLoadedContact = true;
            // console.log('data from backend in Store: ', data );
            _contactToEdit = data;

            break;

        case Constants.USER_API_GET_MAIN_DATA_SUCCESS:
            // console.log('data from backend in Contacts Store: ', data );
            _friendsContacts = data.contacts;

            break;


        case Constants.CONTACTS_API_CREATE_CONTACT_ATTEMPT:
            _warningMessage = null;
            // console.log('data from backend in Contacts Store: ', data );
            contactsApi.contactCreate(data);

            break;

        case Constants.CONTACTS_API_CREATE_CONTACT_SUCCESS:
            // console.log('CONTACTS_API_CREATE_CONTACT_SUCCESS data: ', data );
            _warningMessage = data;

            break;

        case Constants.CONTACTS_API_UPDATE_CONTACT_ATTEMPT:
            _warningMessage = null;
            // console.log('data from backend in Contacts Store: ', data );
            contactsApi.contactUpdate(data);

            break;

        case Constants.CONTACTS_API_UPDATE_CONTACT_SUCCESS:
            // console.log('CONTACTS_API_UPDATE_CONTACT_SUCCESS data: ', data );
            _warningMessage = data;

            break;

        case Constants.CONTACTS_API_DELETE_CONTACT_ATTEMPT:
            _warningMessage = null;
            // console.log('data from backend in Contacts Store: ', data );
            contactsApi.contactDelete(data);

            break;

        case Constants.CONTACTS_API_DELETE_CONTACT_SUCCESS:
            // console.log('CONTACTS_API_DELETE_CONTACT_SUCCESS data: ', data );
            _warningMessage = data;

            break;




        default:
            return true;
    }

    ContactsStore.emitChange();

    return true;

});

module.exports = ContactsStore;