/**
 * Created by maxim on 10.06.17.
 */

import actions from '../actions';
import requestHandler from '../utils/requestHandler';



module.exports= {
    getContactsFromBackend() {
        requestHandler.ajax({
            type: 'GET',
            url: '/backend/contacts'

        }, function (res) {
            actions.handle('CONTACTS_API_GET_CONTACTS_SUCCESS', res)
        })
    },

    getContactToEditFromBackend(data) {
        requestHandler.ajax({
            type: 'GET',
            url: '/backend/contacts/'+ data + '/edit'

        }, function (res) {
            actions.handle('CONTACTS_API_GET_CONTACT_TO_EDIT_SUCCESS', res)
        })
    },

    contactCreate(data) {
        requestHandler.ajax({
            type:'POST',
            url:'backend/contacts',
            data: data,
            statusCode:{
                422:function(res){
                    console.log('error catch ok:', res);
                    // actions.handle('_API_REGISTRATION_ERRORS', res)
                }
            }

        }, function(res) {
            // $('meta[name="csrf-token"]').value(res.newCsrf);
            actions.handle('CONTACTS_API_CREATE_CONTACT_SUCCESS', res)
        })
    },

    contactUpdate(data) {
        // console.log('contactUpdate data: ', data);
        requestHandler.ajax({
            type:'PUT',
            url:'backend/contacts/' + data.id + '/update',
            data: data,
            statusCode:{
                422:function(res){
                    console.log('error catch ok:', res);
                    // actions.handle('_API_REGISTRATION_ERRORS', res)
                }
            }

        }, function(res) {
            actions.handle('CONTACTS_API_UPDATE_CONTACT_SUCCESS', res)
        })
    },

    contactDelete(data) {
        // console.log('contactDelete data', data);
        requestHandler.ajax({
            type:'GET',
            url:'backend/contacts/' + data + '/delete',
            statusCode:{
                422:function(res){
                    console.log('error catch ok:', res);
                    // actions.handle('_API_REGISTRATION_ERRORS', res)
                }
            }

        }, function(res) {
            actions.handle('CONTACTS_API_DELETE_CONTACT_SUCCESS', res)
        })
    },

};













// var backendUrl = 'http://127.0.0.1:8000/';

/*module.exports = {
    getContacts:function () {
        // console.log('getContacts in Api called');
    $.ajax({
        type: "GET",
        url: backendUrl + "backend",
        // data: contacts,
    }).done( function (res) {
        actions.handle ('CONTACTS_API_SUCCESS', res);
    });
},
};*/

/*module.exports= {
    get() {
        requestHandler.ajax({
            type:'GET',
            url:'/backend'

        }, function(res) {
            actions.handle('CONTACTS_API_SUCCESS', res)
        })
    }
};*/




