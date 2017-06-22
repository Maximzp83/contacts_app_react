/**
 * Created by maxim on 21.06.17.
 */


import React from 'react';
import actions from '../actions';

import ContactsStore from '../stores/ContactsStore';

import NavBar from './partials/NavBar';
import ContactWriteForm from './partials/ContactWriteForm';



class EditContact extends React.Component {
    constructor(props) {
        super(props);
        // console.log('EditContact props', props);
        this.state = {
            contact: {
                name: '',
                email: '',
                phone: '',
                address: '',
                organization: '',
                is_friend: 0,
                birthday: '',
            },
        };

        this._handleChange = this._handleChange.bind(this);
    }

    _handleChange() {
        // console.log('_handleChange in Home ok');
        this.setState(this.getState());
    }

    getState() {
        return ({
            contact: ContactsStore.getContactToEdit(),
            isLoaded: ContactsStore.getIsLoadedContact(),
        });
    }


    componentDidMount() {
        ContactsStore.addChangeListener(this._handleChange);
        let id = this.props.params.id;

        setTimeout(function () {
            actions.handle('CONTACTS_API_GET_CONTACT_TO_EDIT_ATTEMPT', id);
        }, 0);
    }

    componentWillUnmount() {
        ContactsStore.removeChangeListener(this._handleChange);

    }

    render() {
        if (!this.state.isLoaded) {
            return <div></div>;
        }
        // console.log('home ok');
        // console.log('User name in Register: ', this.state.user);
        // console.log('Edit contact state Name: ', this.state.contact.name);

        return (
            <div>
                <NavBar />
                <ContactWriteForm
                    editContact={true}
                    id={this.state.contact.id}
                    name={this.state.contact.name}
                    email={this.state.contact.email}
                    phone={this.state.contact.phone}
                    address={this.state.contact.address}
                    organization={this.state.contact.organization}
                    is_friend={this.state.contact.is_friend}
                    birthday={this.state.contact.birthday}

                    submitButtonText={'Update Contact'}
                />

            </div>

        )
    }

}

module.exports = EditContact;