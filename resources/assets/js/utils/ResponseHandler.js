/**
 * Created by maxim on 12.06.17.
 */
import Actions from '../actions';

module.exports = {
    handle: function(res) {

        var shouldContinue = true;
        var shouldShowErrors = false;

        if(!res.status) return shouldContinue;
        // switch (res.status) {
        //
        //   case codes['ERROR']:
        //   case codes['WRONG_RESET_TOKEN']:
        //   case codes['WRONG_ROLE']:
        //     shouldShowErrors = true;
        //     shouldContinue = false;
        //     break;
        //
        //   case codes['UNAUTHORIZED_APP']:
        //     // console.log('hello');
        //     shouldContinue = false;
        //     window.location.reload();
        //     break;
        //
        //   case codes['UNAUTHORIZED_USER']:
        //     SpeedyPaperActions.logOut();
        //     shouldShowErrors = true;
        //     shouldContinue = false;
        //     break;
        //
        //   default:
        //     break;
        // }

        if(!shouldContinue)
        {

            setTimeout(SpeedyPaperActions.disableLoadingState, 0);

        }

        if(shouldShowErrors)
        {

            Notifications.Add(res.errors);
            // SpeedyPaperActions.displayError(res.errors);

        }

        if(res.alerts.length > 0)
        {
            // Notifications.Add(res.alerts);
            // SpeedyPaperActions.displayAlert(res.alerts);
            // console.log('alert', alert);
            // Actions.handle('ADD_NOTIFICATION', res.alerts[0]);
            alert(res.alerts[0])
        }

        if(res.errors.length > 0)
        {
            // Actions.handle('ADD_NOTIFICATION', res.errors[0]);
        }

        return shouldContinue;
    },

    handleError: function(jqXHR, textStatus, errorThrown)
    {
        console.log('rh.handleError jqXHR', jqXHR );
        console.log('rh.handleError textStatus', textStatus );
        console.log('rh.handleError errorThrown', errorThrown );

        // setTimeout(() => Actions.handle('DISABLE_LOADING_STATE'), 0);
        // Actions.handle('ADD_NOTIFICATION', "An Error ocured!");
    }
}