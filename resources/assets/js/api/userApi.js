/**
 * Created by maxim on 12.06.17.
 */

import actions from '../actions';
import requestHandler from '../utils/requestHandler';


module.exports= {
    getMainDataFromBackend() {
        requestHandler.ajax({
            type:'GET',
            url:'/backend'

        }, function(res) {
            actions.handle('USER_API_GET_MAIN_DATA_SUCCESS', res)
        })
    },

    userRegistration(data) {
        requestHandler.ajax({
            type:'POST',
            url:'backend/register',
            data: data,
            statusCode:{
                422:function(res){
                    console.log('error catch ok:', res);
                    actions.handle('USER_API_REGISTRATION_ERRORS', res)
                }
            }

        }, function(res) {
            // $('meta[name="csrf-token"]').value(res.newCsrf);
            actions.handle('USER_API_REGISTRATION_SUCCESS', res)
        })
    },

    userLogin(data) {
        // console.log('userLogin called');
        requestHandler.ajax({
            type:'POST',
            url:'backend/login',
            data: data,
            statusCode:{
                422:function(res){
                    console.log('error 422 catch ok:', res);
                    actions.handle('USER_API_LOGIN_ERRORS', res)
                }
            }

        }, function(res) {
            actions.handle('USER_API_LOGIN_SUCCESS', res)
        })
    },

    logout() {
        requestHandler.ajax({
            type:'POST',
            url:'backend/logout',

        }, function(res) {

            actions.handle('USER_API_LOGOUT_SUCCESS', res)
        })
    }


};




