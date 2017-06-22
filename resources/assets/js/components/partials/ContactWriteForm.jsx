/**
 * Created by maxim on 20.06.17.
 */
import React from 'react';
import actions from '../../actions';

import ContactsStore from '../../stores/ContactsStore';

import WarningMessage from './WarningMessage';




class ContactWriteForm extends React.Component {
    constructor(props) {
        super(props);
        // console.log('ContactWriteForm props: ', props);
        this.state = {
            contactValues: {
                id: this.props.id,
                name: this.props.name,
                email: this.props.email ? this.props.email : '',
                phone: this.props.phone ? this.props.phone : '',
                address: this.props.address ? this.props.address : '',
                organization: this.props.organization ? this.props.organization : '',
                is_friend: this.props.is_friend ? this.props.is_friend : '',
                birthday: this.props.birthday ? this.props.birthday : '',
            }

        };

        this._handleChange = this._handleChange.bind(this);
        this._handleWarningsChange = this._handleWarningsChange.bind(this);

    }


    _handleChange() {
        // console.log('_handleChange called');
        this.setState( this.getIsLoadedStoreState() );
    }

    _handleWarningsChange() {
        // console.log('_handleChange called');
        this.setState( this.getWarningStoreState() );
    }


    getState() {
        return this.state.contactValues;
    }


    getIsLoadedStoreState() {
        // console.log('getStoreState called');
        return ({
            // isLoadedContact: ContactsStore.getIsLoadedContact(),
        });
    }

    getWarningStoreState() {
        // console.log('getStoreState called');
        return ({
            warnings: ContactsStore.getWarningMessage(),
        });
    }


    componentDidMount() {
        ContactsStore.addChangeListener(this._handleWarningsChange);
    }

    componentWillUnmount() {
        ContactsStore.removeChangeListener(this._handleWarningsChange);
    }



    handleNameInputChange(e) {
        let contactValues = this.state.contactValues;
        contactValues.name =  e.target.value;
        this.setState({ contactValues : contactValues });
    }

    handleMailInputChange(e) {
        let contactValues = this.state.contactValues;
        contactValues.email =  e.target.value;
        this.setState({ contactValues:  contactValues });
    }

    handlePhoneInputChange(e) {
        let contactValues = this.state.contactValues;
        contactValues.phone =  e.target.value;
        this.setState({ contactValues:   contactValues });
    }

    handleAddressInputChange(e) {
        let contactValues = this.state.contactValues;
        contactValues.address =  e.target.value;
        this.setState({ contactValues:   contactValues });
    }


    handleOrganizationInputChange(e) {
        let contactValues = this.state.contactValues;
        contactValues.organization =  e.target.value;
        this.setState({ contactValues:   contactValues });
    }

    handleIsFriendInputChange(e) {
        let contactValues = this.state.contactValues;
        contactValues.is_friend =  e.target.checked ? 1 : 0;
        // console.log('handleIsFriendInputChange', contactValues.is_friend);

        this.setState({ contactValues: contactValues});
        // console.log('state', this.state.contactValues.is_friend);

    }

    handleBirthdayInputChange(e) {
        let contactValues = this.state.contactValues;
        contactValues.birthday =  e.target.value;
        this.setState({ contactValues:   contactValues });
    }

    handleSubmit(e) {
        e.preventDefault();
        // ContactsStore.setErrors(false);
        // UserStore.addChangeListener(this._handleErrorsChange);
        // this.state.errors = false;
        // console.log(this.state.errors);
        if ( this.props.editContact ) {
            actions.handle('CONTACTS_API_UPDATE_CONTACT_ATTEMPT', this.getState());

        } else {
            actions.handle('CONTACTS_API_CREATE_CONTACT_ATTEMPT', this.getState());
        }
    }



    render() {
        // console.log('warnings', this.state.warnings);
        // console.log(' !friend in WriteForm: ', this.state.is_friend);
        // console.log(' !name in WriteForm: ', this.state.name);

        // console.log('register form user: ');

        return (
            <div>
                <div className="row content-wrapper">

                    <div className="container">
                        { this.state.warnings ? <WarningMessage warning={this.state.warnings} /> : null }

                        <div className="contacts-form-wrapper">
                    {this.props.editContact ? <h1>Edit <b>{ this.props.name }</b> contact</h1> : <h1>Write new contact</h1>}
                    <hr/>

                        <form
                            className="form-horizontal"
                            role="form"
                            onSubmit={ (e) => this.handleSubmit(e) } >
                            {/*----'NAME'------*/}
                            <div className="form-group">
                                <label htmlFor="name-input" className="">Name: </label>
                                 <input
                                      id="name"
                                      type="text"
                                      className="form-control"
                                      name="name"
                                      required
                                      autoFocus
                                      value={this.state.contactValues.name}
                                      onChange={(e) => this.handleNameInputChange(e)}
                                 />
                            </div>
                            {/*----'EMAIL'------*/}
                            <div className="form-group">
                                <label htmlFor="mail-input" className="">Mail: </label>
                                <input
                                    id="mail"
                                    type="email"
                                    className="form-control"
                                    name="mail"
                                    value={this.state.contactValues.email}
                                    onChange={(e) => this.handleMailInputChange(e)}
                                />
                            </div>
                            {/*----'PHONE'------*/}
                            <div className="form-group">
                                <label htmlFor="phone-input" className="">Phone: </label>
                                <input
                                    id="phone"
                                    type="tel"
                                    className="form-control"
                                    name="phone"
                                    value={this.state.contactValues.phone}
                                    onChange={(e) => this.handlePhoneInputChange(e)}
                                />
                            </div>
                            {/*----'Address'------*/}
                            <div className="form-group">
                                <label htmlFor="address-input" className="">Address: </label>
                                <input
                                    id="address"
                                    type="text"
                                    className="form-control"
                                    name="address"
                                    value={this.state.contactValues.address}
                                    onChange={(e) => this.handleAddressInputChange(e)}
                                />
                            </div>
                            {/*----'Organization'------*/}
                            <div className="form-group">
                                <label htmlFor="organization-input" className="">Organization: </label>
                                <input
                                    id="organization"
                                    type="text"
                                    className="form-control"
                                    name="organization"
                                    value={this.state.contactValues.organization}
                                    onChange={(e) => this.handleOrganizationInputChange(e)}
                                />
                            </div>
                            {/*----'Birthday'------*/}
                            <div className="form-group">
                                <label htmlFor="birthday-input" className="">Was Born In: </label>
                                <input
                                    id="birthday"
                                    type="date"
                                    className="form-control"
                                    name="birthday"
                                    value={this.state.contactValues.birthday}
                                    onChange={(e) => this.handleBirthdayInputChange(e)}
                                />
                            </div>
                            {/*----'FRIEND CHECKBOX'------*/}
                            <div className="form-group">
                                <label htmlFor="friend-input" className="">Is a Friend: </label>
                                <input
                                    id="is_friend"
                                    type="checkbox"
                                    className="form-control friend-check"
                                    name="is_friend"
                                    value={1}
                                    checked={this.state.contactValues.is_friend}
                                    onChange={(e) => this.handleIsFriendInputChange(e)}
                                />
                            </div>

                            <button type="submit"
                                    className="btn btn-primary">{ this.props.submitButtonText }</button>

                        </form>
                    </div>
                </div>
            </div>
            </div>

        )
    }

}

module.exports = ContactWriteForm;