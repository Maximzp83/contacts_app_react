/**
 * Created by maxim on 09.06.17.
 */

import React, { Component } from 'react';
import { Router , Route, Link , Redirect, hashHistory, IndexRoute } from 'react-router';
// import { Router, Route } from 'react-router-dom';
import Master from './components/Master';
import Home from './components/Home';
import Contacts from './components/Contacts';
import WriteContact from './components/WriteContact';
import EditContact from './components/EditContact';

import RegisterForm from './components/RegisterForm';
import LoginForm from './components/LoginForm';

import isNotLoggedIn from './middleware/isNotLoggedIn';
import isLoggedIn from './middleware/isLoggedIn';

import Dashboard from  './components/Dashboard';



const routes = (
    <Route  path="/" component={Master}>
        <IndexRoute name="home" component={Home} />

        <Route component={isLoggedIn}>
            <Route name="contacts" path="/contacts" component={Contacts} />
            <Route name="write" path="/contacts/write" component={WriteContact} />
            <Route name="edit" path="/contacts/:id/edit" component={EditContact} />

            <Route name="dashboard" path="/dashboard" component={Dashboard} />
        </Route>

        <Route component={isNotLoggedIn}>
            <Route name="register" path="/register" component={RegisterForm} />
            <Route name="login" path="/login" component={LoginForm} />
        </Route>


        {/*<Route path="/contacts" component={Contacts} />*/}

    </Route>

);



module.exports = routes;