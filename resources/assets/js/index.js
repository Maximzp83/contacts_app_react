/**
 * Created by maxim on 09.06.17.
 */

const React = require('react');
import ReactDOM from 'react-dom';
import { Router, useRouterHistory } from 'react-router';
import { HashRouter, Route, Link } from 'react-router-dom';
import useNamedRoutes from 'use-named-routes';
import { createHistory } from 'history';
import path from "path";

import routes from './routes';


const browserHistory = useNamedRoutes(useRouterHistory(createHistory))({routes});


ReactDOM.render(

    <Router routes={routes} history={browserHistory} />,
    document.getElementById("root")
);







/*import React from 'react';
import ReactDOM from 'react-dom';
// import App from './App';
import '../css/index.css';*/

/*
class Message extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            name: this.props.name,
            text: this.props.text
        }

    }

    render() {
        return (
        <div className="header">
            <h1>Hello {this.state.name}!</h1>
            <h2>{this.state.text}</h2>
        </div>
        )
    }

}


ReactDOM.render(
    <Message text="webpack build OK" name="Maxim" />,
    document.getElementById('root')
);*/

