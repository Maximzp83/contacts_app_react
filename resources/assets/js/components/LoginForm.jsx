/**
 * Created by maxim on 14.06.17.
 */

import React from 'react';
import actions from '../actions';

import UserStore from '../stores/UserStore';

import NavBar from './partials/NavBar';
import ErrorMessage from './partials/ErrorMessage';



class LoginForm extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            email: '',
            password: '',
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

    /*componentWillMount() {
        UserStore.addChangeListener(this._handleErrorsChange);
    }*/

    componentDidMount() {
        UserStore.addChangeListener(this._handleErrorsChange);
    }

    componentWillUnmount() {
        UserStore.removeChangeListener(this._handleErrorsChange);
    }



    handleMailInputChange(e) {
        this.setState({ email: e.target.value });
    }

    handlePassInputChange(e) {
        this.setState({ password: e.target.value });
    }

    handleSubmit(e) {
        e.preventDefault();
        UserStore.setErrors(false);
        this.state.errors = false;

        actions.handle('USER_API_LOGIN_ATTEMPT', this.getState());
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

        // console.log('login errors: ', this.state.errors );

        var errors = false;

        if (this.state.errors) {
            errors = JSON.parse( this.state.errors.responseText );
            console.log('errors = ', errors);
        }

        return (
            <div>
                <NavBar user={null} />

                <div className="row content-wrapper">
                    <div className="col-md-8 col-md-offset-2">
                        <div className="panel panel-default">
                            <div className="panel-heading">Login</div>
                            <div className="panel-body">
                                <form className="form-horizontal"
                                      role="form"
                                      onSubmit={ (e) => this.handleSubmit(e) }
                                >

                                    <div className={this.hasError(errors,'email') ? "form-group has-error" : "form-group" }  >

                                        <label htmlFor="email" className="col-md-4 control-label">E-Mail Address</label>

                                        <div className="col-md-6">
                                            {/*<input id="email" type="email" className="form-control" name="email" value="{{ old('email') }}" required autofocus/>*/}
                                            <input id="email"
                                                   type="email"
                                                   className="form-control"
                                                   name="email"
                                                   required
                                                   autoFocus
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
                                                id="password"
                                                type="password"
                                                className="form-control"
                                                name="password" required
                                                value={this.state.password}
                                                onChange={(e) => this.handlePassInputChange(e)}
                                            />

                                            {this.hasError(errors,'password') ? <ErrorMessage error={errors.password} /> : null}
                                        </div>
                                    </div>

                                    <div className="form-group">
                                        <div className="col-md-6 col-md-offset-4">
                                            <div className="checkbox">
                                                <label>
                                                    {/*<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}/> Remember Me*/}
                                                    <input
                                                        type="checkbox"
                                                        name="remember"
                                                    /> Remember Me

                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div className="form-group">
                                        <div className="col-md-8 col-md-offset-4">
                                            <button type="submit" className="btn btn-primary">
                                                Login
                                            </button>

                                            <a className="btn btn-link" href="{{ route('password.request') }}">
                                                Forgot Your Password?
                                            </a>
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

module.exports = LoginForm;
