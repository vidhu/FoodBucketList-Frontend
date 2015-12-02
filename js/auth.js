var Auth = (function () {
    //Private stuff
    var onLoginEvent = new CustomEvent('onFBLogin');
    var onLogoutEvent = new CustomEvent('onFBLogout');

    var statusChange = function (response) {
        if (response.status === 'connected') {
            $('#login_button').hide();
            $('#logout_button').show();
            onLoginEvent.userID = response.authResponse.userID;
            document.body.dispatchEvent(onLoginEvent);
            return;
        } else if (response.status === 'not_authorized') {

        } else {

        }
        $('#login_button').show();
        $('#logout_button').hide();
        document.body.dispatchEvent(onLogoutEvent);
    };

    //Public stuff
    return {
        init: function () {
            FB.getLoginStatus(function (response) {
                statusChange(response);
            });
        },
        login: function () {
            FB.login(function (response) {
                statusChange(response);
            });
        },
        logout: function () {
            FB.logout(function (response) {
                statusChange(response);
            });
        },
        getUserInfo: function (callback) {
            FB.api('/me', callback);
        }
    };
})();

// Load the SDK asynchronously
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
        return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

//init FB sdk
window.fbAsyncInit = function () {
    FB.init({
        appId: '1206232049392333',
        cookie: true, // enable cookies to allow the server to access the session
        xfbml: true, // parse social plugins on this page
        version: 'v2.2' // use version 2.2
    });

    Auth.init();
};