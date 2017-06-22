/**
 * Created by maxim on 16.06.17.
 */
import React from 'react';



class ErrorMessage extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <span className="help-block">
                <strong>{this.props.error}</strong>
            </span>
        );
    }
}

export default ErrorMessage;

