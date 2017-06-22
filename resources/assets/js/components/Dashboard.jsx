/**
 * Created by maxim on 14.06.17.
 */

import React from 'react';
import UserStore from '../stores/UserStore';

import NavBar from './partials/NavBar';


class Dashboard extends React.Component {

    constructor(props) {
        super(props);
        this.state = this.getState();
        this._handleChange = this._handleChange.bind(this);
    }

    _handleChange() {
        // console.log('_handleChange in Home ok');
        this.setState(this.getState());
    }

    getState() {
        return ({
            user: UserStore.getUser(),
            // contacts: HomePageStore.getContacts(),
            // isLoaded: HomePageStore.isLoaded(),

        });
    }

    componentDidMount() {
        UserStore.addChangeListener(this._handleChange);


    }

    componentWillUnmount() {
        UserStore.removeChangeListener(this._handleChange);

    }

    render() {
        // console.log('User: ', this.state.user);
        // console.log('User name in Master: ', this.state.user.name);
        const user = this.state.user;

        return (
            <div>
            <NavBar user={user} />
            <div className="container">
                <div className="row content-wrapper">
                    <div className="col-md-8 col-md-offset-2">
                        <div className="panel panel-default">
                            <div className="panel-heading">Dashboard</div>

                            <div className="panel-body">
                                You are logged in!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        )
    }

}


module.exports = Dashboard;
