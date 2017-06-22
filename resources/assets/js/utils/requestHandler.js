/**
 * Created by maxim on 12.06.17.
 */
var rh = require('./ResponseHandler');
var $ = require('jquery');
import extend from 'lodash/extend';

// var _token = window.cd.access_token;
var _api_url = 'http://localhost:8888/';

// CSRF protection
// console.log($('input[name="_token"]').val());
/*$.ajaxSetup(
    {
        headers:
            {
                'X-CSRF-Token': $('input[name="_token"]').val()
            }
    });*/


$.ajaxPrefilter( function( options, originalOptions, jqXHR ) {
    options.crossDomain = {
        crossDomain: false
    };
    options.xhrFields = {
        withCredentials: true
    };
});

module.exports = {

    ajax: function(options, cb) {

        options.data = options.data || {};

        options.dataType = 'json';
        options.url = _api_url+options.url;

        if(options.processData === false)
        {
            console.log('options.processData === false');
            // options.data.append('access_token', _token);
            options.data.append('_token', window.data.csrf);
        } else {
            // console.log('options.processData != false');

            // console.log('options.processData =', options.processData);

            // options.data.access_token = _token;
            options.data._token = window.data.csrf;
            // console.log('!!!!!options.data._token: ',options.data._token);
        }

        // console.log("$.ajax(options): ", options);

        $.ajax(options)
            .done(function(res)
            {
                if(rh.handle(res) && typeof(cb) === 'function') {
                    cb(res);
                }

            })
            .fail(rh.handleError);

        /*$.ajax(options)
            .done(function(res)
            {
                if(rh.handle(res) && typeof(cb) === 'function') {
                    cb(res);
                }

            })
            .fail(function(res) {

                    cb(res);

            })*/


    }
};