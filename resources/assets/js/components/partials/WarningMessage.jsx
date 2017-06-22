/**
 * Created by maxim on 21.06.17.
 */
import React from 'react';
import ContactsStore from '../../stores/ContactsStore';


class WarningMessage extends React.Component {
    constructor(props) {
        super(props);
    }

    handleCloseClick(e) {
        e.target.parentNode.remove();
    }

    render() {
        // const warnings = ContactsStore.getWarningMessage();
        var x = this.props.warning;
        console.log('this.props.warning', this.props.warning.warning.flash_message);
        // console.log('x = ', {x: {flash_message}});


        var warning = {
            flash_message_important: this.props.warning.warning.flash_message_important ? this.props.warning.warning.flash_message_important : null,
            flash_message_warning: this.props.warning.warning.flash_message_warning ? this.props.warning.warning.flash_message_warning : null,
            flash_message: this.props.warning.warning.flash_message ? this.props.warning.warning.flash_message : null,
        };
        console.log('warning= ', warning);
        var message_warning = null;
        var message_success = null;


        if (warning.flash_message_warning) {
             message_warning = <div className="alert alert-danger">{warning.flash_message_warning}
                                 <button type="button"
                                         className="close"
                                         onClick={(e) => this.handleCloseClick(e)}
                                 >&times;</button>
                             </div>
        }

        if (warning.flash_message) {
            message_success = <div className="alert alert-success">{warning.flash_message}
                                    <button type="button"
                                            className="close"
                                            onClick={(e) => this.handleCloseClick(e)}
                                    >&times;</button>
                                </div>
        }

        return (
            <div className="container">
                { message_success ? message_success : null}
                { message_warning ? message_warning : null}

            </div>

        );

    }


}


export default WarningMessage;

