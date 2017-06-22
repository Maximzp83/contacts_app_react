/**
 * Created by maxim on 14.06.17.
 */

import React from 'react';
import UserStore from '../stores/UserStore';

class isLoggedIn extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            user: UserStore.getUser(),
            isLoaded: UserStore.getIsLoaded()
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
            isLoaded: UserStore.getIsLoaded(),

        });
    }


    componentDidMount() {
        UserStore.addChangeListener(this._handleChange);

        // console.log('isLoggedIn state:', this.state.user );

        if (this.state.isLoaded) {
            if (this.state.user.role !== 'user') {
                // console.log('isLoggedIn state:', this.state.user );
                this.props.router.push({name: 'home'})
            }
        }


    }

    componentWillUpdate(nextProps, nextState) {
        if (this.state.isLoaded) {
            if (nextState.user.role !== 'user') {
                // console.log('isLoggedIn 2 state:', nextState.user );
                this.props.router.push({name: 'home'})
            }
        }
    }

    componentWillUnmount() {
        UserStore.removeChangeListener(this._handleChange);
    }


    render() {
        // console.log('User: ', this.state.user);
        // console.log('Props in CheckLoggedIn: ', this.props);
        if (!this.state.isLoaded) {
            return <div></div>;
        }

        return (
            <div>{this.props.children}</div>
        )
    }
}


module.exports = isLoggedIn;

