/**
 * Created by maxim on 13.06.17.
 */

import actions from '../actions';
import requestHandler from '../utils/requestHandler';


module.exports = {
    get() {
        requestHandler.ajax({
            type:'POST',
            url:'/backend'

        }, function(res) {
            actions.handle('USER_API_SUCCESS', res)
        })
    }
};
