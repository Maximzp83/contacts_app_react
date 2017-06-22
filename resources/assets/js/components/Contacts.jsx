/**
 * Created by maxim on 14.06.17.
 */

import React from 'react';
import actions from '../actions';

import ContactsStore from '../stores/ContactsStore';

import NavBar from './partials/NavBar';
import ContactsTable from './partials/ContactsTable';


// class ContactsContent extends React.Component {
//     constructor(props) {
//         super(props);
//     }
//
//     render() {
//
//         // const user = this.props.user;
//         // const contacts = this.props.contacts;
//
//         // console.log(contacts);
//         return (
//             <div className="container">
//                 <h1>Welcome <b>{this.props.user.name }</b>!</h1>
//                 <hr/>
//
//                 { this.props.contacts ? <ContactsTable contacts = {this.props.contacts}
//                                                        onlyFriends = {true}
//                 /> : <h3>No Friends yet</h3> }
//             </div>
//         );
//     }
// }


class Contacts extends React.Component {
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
            contacts: ContactsStore.getContacts(),
            isLoaded: ContactsStore.getIsLoaded(),
        });
    }


    componentDidMount() {
        setTimeout(function () {
            actions.handle('CONTACTS_API_GET_CONTACTS_ATTEMPT');
        }, 0);

        ContactsStore.addChangeListener(this._handleChange);
    }

    componentWillUnmount() {
        ContactsStore.removeChangeListener(this._handleChange);

    }



    render() {
        // console.log('home ok');
        // console.log('contacts in Contacts: ', this.state.contacts);
        if (!this.state.isLoaded) {
            return <div></div>;
        }

        return (

            <div>
                <NavBar />
                <div className="content-wrapper">
                    <div className="container">
                    { this.state.contacts ? <h1>My Contacts:</h1> : <h1>No Contacts yet</h1> }
                    <hr/>

                    { this.state.contacts ? <ContactsTable contacts = {this.state.contacts}
                                                           onlyFriends = {false}
                    /> : null }
                    </div>
                </div>
            </div>
        )
    }

}

module.exports = Contacts;