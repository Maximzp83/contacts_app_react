/**
 * Created by maxim on 14.06.17.
 */

import React from 'react';
import actions from '../actions';
import UserStore from '../stores/UserStore';

class isNotLoggedIn extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            user: UserStore.getUser()
        };

        this._handleChange = this._handleChange.bind(this);
    }

    _handleChange() {
        // console.log('_handleChange in Home ok');
        this.setState(this.getState());
    }

    getState() {
        return ({
            user: UserStore.getUser(),
        });
    }


    componentDidMount() {
        UserStore.addChangeListener(this._handleChange);
        console.log('user role: ', this.state.user.role);
        if (this.state.user.role === 'user') {
            // console.log('isNotLoggedIn state:', this.state.user );
            this.props.router.push({name: 'dashboard'})
        }
    }

    componentWillUpdate(nextProps, nextState) {
        console.log('user role2: ', this.state.user.role);
        if (nextState.user.role === 'user') {
            // console.log('isNotLoggedIn state:', nextState.user );
            this.props.router.push({name: 'dashboard'})
        }
    }

    componentWillUnmount() {
        UserStore.removeChangeListener(this._handleChange);
    }



    render() {
        // console.log('User: ', this.state.user);
        // console.log('Props in CheckLoggedIn: ', this.props);

        return (
            <div>{this.props.children}</div>
        )
    }

}


module.exports = isNotLoggedIn;

