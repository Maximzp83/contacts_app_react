/**
 * Created by maxim on 09.06.17.
 */
import React from 'react';
import actions from '../actions';

import ContactsStore from '../stores/ContactsStore';
import UserStore from '../stores/UserStore';

import Link from 'react-router/lib/Link';

import NavBar from './partials/NavBar';
import ContactsTable from './partials/ContactsTable';




class UserContent extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {

        // const user = this.props.user;
        // const contacts = this.props.contacts;

        // console.log(contacts);
        return (
            <div className="container">
                <h1>Welcome <b>{this.props.user.name }</b>!</h1>
                <hr/>

                { this.props.contacts ? <ContactsTable contacts = {this.props.contacts}
                                                       onlyFriends = {true}
                /> : <h3>No Friends yet</h3> }
            </div>
        );
    }
}


class Home extends React.Component {
    constructor(props) {
        super(props);
        this.state = this.getState();

        this._handleChange = this._handleChange.bind(this);
    }

    _handleChange() {
        // console.log('_handleChange in Home ');
        this.setState(this.getState());
    }

    getState() {
        // console.log('getState in Home ');

        return ({
            contacts: ContactsStore.getFriendsContacts(),
            user: UserStore.getUser(),
            isLoaded: UserStore.getIsLoaded()

        });
    }


    componentDidMount() {

        ContactsStore.addChangeListener(this._handleChange);
        UserStore.addChangeListener(this._handleChange);

        // if (!this.state.isLoaded) {
        setTimeout(function () {
            actions.handle('USER_API_GET_MAIN_DATA_ATTEMPT');
        }, 0 );


    }

    componentWillUnmount() {
        ContactsStore.removeChangeListener(this._handleChange);
        UserStore.removeChangeListener(this._handleChange);

    }


    render() {
        // console.log('home state!!!!:', this.state);
        if (!this.state.isLoaded) {
            return <div></div>;
        }

        const guestContent = <div className="container">
            <h1>Hello <b>Guest!</b></h1>
            <h4>Welcome to Contacts Application.</h4>
            <p>With the help of this application you can record contacts of your friends and employees, as well as customers. You can add a contact, change it, or delete it. The application allows you to search for the necessary contacts and sort them.
                <br/>All you need to work is just complete <b><Link to="register">Register</Link></b> or <b><Link to="login">Login</Link></b> procedure. Good luck!</p>
        </div>;
        console.log('render Home');

        return (

            <div>
                <NavBar />
                <div className="content-wrapper">
                    { this.state.user.role === 'user' ?
                        <UserContent user = {this.state.user}
                                     contacts = {this.state.contacts} />
                        : guestContent  }
                </div>
            </div>
        )
    }

}

module.exports = Home;