/**
 * Created by maxim on 09.06.17.
 */
import React from 'react';
import actions from '../actions';
import UserStore from '../stores/UserStore';

class Master extends React.Component {

    constructor(props) {
        super(props);
        this.state = this.getState();
        this._handleChange = this._handleChange.bind(this);
    }

    _handleChange() {
        // console.log('_handleChange in Master ok');
        this.setState(this.getState());
    }

    getState() {
        return ({
            user: UserStore.getUser(),
            // isLoaded: UserStore.isLoaded(),
        });
    }


    componentDidMount() {
        UserStore.addChangeListener(this._handleChange);
        // if (this.state.user.role === 'user') actions.handle('CONTACTS_API_GET_CONTACTS_ATTEMPT');

        actions.handle('USER_API_GET_MAIN_DATA_ATTEMPT');
    }

    componentWillUnmount() {
        UserStore.removeChangeListener(this._handleChange);
    }



    render() {
        // console.log('User: ', this.state.user);
        // console.log('User name in Master: ', this.state.user.name);

        return (
           <div>{this.props.children}</div>
        )
    }

}


module.exports = Master;
