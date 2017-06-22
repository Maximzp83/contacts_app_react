/**
 * Created by maxim on 12.06.17.
 */

import React from 'react';
import actions from '../../actions';
import Link from 'react-router/lib/Link';

import UserStore from '../../stores/UserStore';

function forAuthUserLinks() {

    return [
        <li key={"contacts"}><Link to={{name: 'contacts'}}>My Contacts</Link></li>,
        <li key={"write"}><Link to={{name: 'write'}}>Write Contact</Link></li>
    ];
}

function forGuestLinks() {
   return [
        <li key={"login"}><Link to={{name: 'login'}}>Login</Link></li>,
        <li key={"register"}><Link to={{name: 'register'}}>Register</Link></li>
    ];
}

class DropdownLogoutMenu extends React.Component {
    constructor(props) {
        super(props);
    }

    handleLogoutClick(e) {
        e.preventDefault();
        // document.getElementById('logout-form').submit();
        actions.handle('USER_API_LOGOUT_ATTEMPT');
    }

    render () {
        return <li className="dropdown">
            <a href="#" className="dropdown-toggle"
               data-toggle="dropdown" role="button"
               aria-expanded="false">
                {this.props.user.name}
                <span className="caret"></span>
            </a>
            <ul className="dropdown-menu" role="menu">
                <li>
                    <a href="#"
                       onClick={(e) => this.handleLogoutClick(e)}>
                        Logout
                    </a>

                    <div id="logout-form" action="#"
                           style={{display: "none"}}>
                    </div>

                </li>
            </ul>
        </li>
        }

    }


class NavBar extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        const user = UserStore.getUser();

        // console.log('navBar user: ', user);

        return (
            <div className="row">
                <nav className="navbar navbar-inverse navbar-fixed-top">
                    <div className="container">
                        <div className="navbar-header">

                            {/*<!-- Collapsed Hamburger -->*/}
                            <button type="button" className="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#app-navbar-collapse">
                                <span className="sr-only">Toggle Navigation</span>
                                <span className="icon-bar"></span>
                                <span className="icon-bar"></span>
                                <span className="icon-bar"></span>
                            </button>

                            {/*<!-- Branding Image -->*/}
                            <Link className="navbar-brand" to="home">
                                <b>Home</b>
                            </Link>
                        </div>

                        <div className="collapse navbar-collapse" id="app-navbar-collapse">
                            {/*<!-- Left Side Of Navbar -->*/}
                                    <ul className="nav navbar-nav">
                                        &nbsp;
                                        { user.role === 'user' ? forAuthUserLinks() : null }
                                        &nbsp;
                                    </ul>

                            {/*<!-- Right Side Of Navbar -->*/}
                            <ul className="nav navbar-nav navbar-right">
                                {/*<!-- Authentication Links -->*/}
                                { user.role === 'user' ? <DropdownLogoutMenu user={user} /> : forGuestLinks() }
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        )
    }

}

export default NavBar;
