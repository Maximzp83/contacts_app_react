/**
 * Created by maxim on 09.06.17.
 */

import React from 'react'

import NewsStore from 'stores/NewsStore'
import actions from 's/actions'
import Create from './Create'
import NewsBlock from './NewsBlock'

var News = React.createClass({
    getInitialState(){
        return this.getState();
    },

    getState(){
        return {
            isLoaded: NewsStore.isLoaded(),
            news: NewsStore.getNews(),
        }
    },

    componentDidMount(){
        NewsStore.addChangeListener(this._onChange);
        setTimeout(() => {actions.handle('LOAD_NEWS_ATTEMPT')}, 0);
    },

    componentWillUnmount(){
        NewsStore.removeChangeListener(this._onChange);
    },

    _onChange(){
        this.setState(this.getState());
    },

    render() {
        return (
            <div>
                <Create
                    isLoaded={this.state.isLoaded}
                />
                <NewsBlock news={this.state.news} />
            </div>
        );
    }
});

module.exports = News;