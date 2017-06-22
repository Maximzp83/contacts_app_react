/**
 * Created by maxim on 20.06.17.
 */
import React from 'react';
import Link from 'react-router/lib/Link';
import actions from '../../actions';
var _ = require('lodash');


function ContactsTable(props) {
    // console.log('FriendsContactsTable contacts:', props.contacts);

    /* function contactsValues(contact) {
     let result = [];

     for (let contactValue in contact) {
     // console.log('contact.'+ contactValue + '= ', contact[contactValue]);
     result.push(contact[contactValue]);
     }

     return result;
     }*/

    let contacts = props.contacts.contacts_list;

    function handleDeleteClick(id) {
        // console.log('handleDeleteClick - id:', id);
        // e.preventDefault();
        // ContactsStore.setErrors(false);
        // UserStore.addChangeListener(this._handleErrorsChange);
        // this.state.errors = false;
        // console.log(this.state.errors);

        actions.handle('CONTACTS_API_DELETE_CONTACT_ATTEMPT', id);

        contacts = _.remove(contacts, function(contact) {
            return contact.id === id;
        });


    }


    const titlesItems = props.contacts.titles.map((title, index) =>
        <th key={'th-' + index.toString()}>
            {title.toUpperCase()}
        </th>);


    const contactsItems = contacts.map((contact, index) =>
        <tr key={'tr-' + index.toString()}
           ><td>{contact.id}</td>
            <td><Link to={{name: 'edit', params: {id: contact.id} }}>{contact.name}</Link></td>
            <td>{contact.email}</td>
            <td>{contact.phone}</td>
            <td>{contact.address}</td>
            <td>{contact.organization}</td>
            <td>{ contact.is_friend === 1 ? 'yes' : 'no' }</td>
            <td>{ contact.toAge === 0 ? '--' : contact.toAge }</td>
            <td>{contact.created_at}</td>
            <td className="actions-column"><a href="#"
                   className="delete-link"
                   onClick={ handleDeleteClick.bind(null, contact.id) } >
                    <i className="fa fa-trash"
                       aria-hidden="true"></i>
                </a></td
            ></tr>);

                {/*<Link to={{name: 'delete', params: {id: contact.id}  }} className="delete-link">
                    <i className="fa fa-trash" aria-hidden="true"></i>
                </Link>*/}





    return (
        <span>
            { props.onlyFriends ? <h4>My Friends Contacts:</h4> : null}

            <div className="contacts-list-container">

                <table id="contacts"
                       className="display table table-striped table-bordered table-responsive "
                       cellSpacing="0" width="100%">
                    <thead>
                    <tr role="row" className="">{titlesItems}</tr>
                    </thead>
                    <tfoot>
                    <tr role="row" className="">{titlesItems}</tr>
                    </tfoot>
                    <tbody>{contactsItems}</tbody>
                </table>
            </div>
        </span>
    );
}

export default ContactsTable;
