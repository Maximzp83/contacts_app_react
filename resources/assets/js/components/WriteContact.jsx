/**
 * Created by maxim on 14.06.17.
 */


import React from 'react';

import NavBar from './partials/NavBar';
import ContactWriteForm from './partials/ContactWriteForm';



class WriteContact extends React.Component {


    render() {
        // console.log('home ok');
        // console.log('User name in Register: ', this.state.user);
        // console.log('write contact state Name: ', this.state.name);


        return (
            <div>
                <NavBar />
                <ContactWriteForm
                    editContact={false}
                    submitButtonText={'Create Contact'}
                />

            </div>

        )
    }

}

module.exports = WriteContact;