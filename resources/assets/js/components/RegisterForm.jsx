/**
 * Created by maxim on 13.06.17.
 */

import React from 'react';
import actions from '../actions';

import UserStore from '../stores/UserStore';

import NavBar from './partials/NavBar';
import ErrorMessage from './partials/ErrorMessage';



class RegisterForm extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
        };

        this._handleErrorsChange = this._handleErrorsChange.bind(this);
    }

    _handleErrorsChange() {
        // console.log('_handleChange called');
        this.setState( this.getErrorStoreState() );
    }

    getState() {

        return this.state;
    }

    getErrorStoreState() {
        // console.log('getStoreState called');
        return ({
            errors: UserStore.getErrors(),
        });
    }

    /*componentWillUpdate(nextProps, nextState) {
        console.log('componentWillUpdate errors', );
        UserStore.addChangeListener(this._handleErrorsChange);
    }*/

    componentDidMount() {
        UserStore.addChangeListener(this._handleErrorsChange);
    }

    componentWillUnmount() {
        UserStore.removeChangeListener(this._handleErrorsChange);
    }



    handleNameInputChange(e) {
        this.setState({ name: e.target.value });
    }

    handleMailInputChange(e) {
        this.setState({ email: e.target.value });
    }

    handlePassInputChange(e) {
        this.setState({ password: e.target.value });
    }

    handleConfirmPassInputChange(e) {
        this.setState({ password_confirmation: e.target.value });
    }

    handleSubmit(e) {
        e.preventDefault();
        UserStore.setErrors(false);
        // UserStore.addChangeListener(this._handleErrorsChange);
        this.state.errors = false;
        // console.log(this.state.errors);
        actions.handle('USER_API_REGISTRATION_ATTEMPT', this.getState());
    }


    hasError(errors, error) {
        // console.log('hasError:', errors);

        for (var errorName in errors) {
            if (errorName === error) {
                return true;
            }
            // console.log(errorName);
        }
    }


    render() {
        // console.log('home ok');
        // console.log('User name in Register: ', this.state.user);
        // console.log('register form user: ');
        var errors = false;

        if (this.state.errors) {
            errors = JSON.parse( this.state.errors.responseText );
            // console.log('errors = ', errors);
        }


        return (
            <div>
                <NavBar user={null} />

                <div className="row content-wrapper">
                    <div className="col-md-8 col-md-offset-2">
                        <div className="panel panel-default">
                            <div className="panel-heading">Register</div>
                            <div className="panel-body">
                                <form
                                    className="form-horizontal"
                                    role="form"
                                    onSubmit={ (e) => this.handleSubmit(e) } >

                                    <div className={this.hasError(errors,'name') ? "form-group has-error" : "form-group" }  >
                                        <label htmlFor="name" className="col-md-4 control-label">Name</label>

                                        <div className="col-md-6">
                                            {/*<input id="name" type="text" className="form-control" name="name" value="{{ old('name') }}" required autofocus/>*/}
                                            <input
                                                id="name"
                                                type="text"
                                                className="form-control"
                                                name="name"
                                                required
                                                autoFocus
                                                value={this.state.name}
                                                onChange={(e) => this.handleNameInputChange(e)}
                                            />

                                            {this.hasError(errors,'name') ? <ErrorMessage error={errors.name} /> : null}

                                        </div>
                                    </div>

                                    <div className={this.hasError(errors,'email') ? "form-group has-error" : "form-group" }  >
                                        <label htmlFor="email" className="col-md-4 control-label">E-Mail Address</label>

                                        <div className="col-md-6">
                                            {/*<input id="email" type="email" className="form-control" name="email" value="{{ old('email') }}" required/>*/}
                                            <input
                                                id="email"
                                                type="email"
                                                className="form-control"
                                                name="email" required
                                                value={this.state.email}
                                                onChange={(e) => this.handleMailInputChange(e)}
                                            />

                                            {this.hasError(errors,'email') ? <ErrorMessage error={errors.email} /> : null}

                                        </div>
                                    </div>

                                    <div className={this.hasError(errors,'password') ? "form-group has-error" : "form-group" }  >
                                        <label htmlFor="password" className="col-md-4 control-label">Password</label>

                                        <div className="col-md-6">
                                            <input
                                                id="password" type="password"
                                                className="form-control"
                                                name="password"
                                                required
                                                value={this.state.password}
                                                onChange={(e) => this.handlePassInputChange(e)}
                                            />

                                            {this.hasError(errors,'password') ? <ErrorMessage error={errors.password} /> : null}
                                        </div>
                                    </div>

                                    <div className="form-group">
                                        <label htmlFor="password-confirm" className="col-md-4 control-label">Confirm Password</label>

                                        <div className="col-md-6">
                                            <input
                                                id="password-confirm"
                                                type="password"
                                                className="form-control"
                                                name="password_confirmation"
                                                required
                                                value={this.state.password_confirmation}
                                                onChange={(e) => this.handleConfirmPassInputChange(e)}
                                            />
                                        </div>
                                    </div>

                                    <div className="form-group">
                                        <div className="col-md-6 col-md-offset-4">
                                            <button type="submit" className="btn btn-primary">
                                                Register
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        )
    }

}

module.exports = RegisterForm;