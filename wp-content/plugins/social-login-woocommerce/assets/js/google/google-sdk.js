jQuery(document).ready(function ($) {

    var googleUser = {};

    var startApp = function () {

        gapi.load('auth2', function () {
            // Retrieve the singleton for the GoogleAuth library and set up the client.
            auth2 = gapi.auth2.init({
                client_id: xoo_sl_google_localize.clientID,
                cookiepolicy: 'single_host_origin',
                plugin_name: 'updatesoon'
                // Request scopes in addition to 'profile' and 'email'
                //scope: 'additional_scope'
            });


            $.each($('.xoo-sl-google-btn'), function () {

                var $button = $(this);

                auth2.attachClickHandler($(this)[0], {},

                    function (googleUser) {

                        var profile = googleUser.getBasicProfile();

                        var userInfo = {
                            social_type: 'google',
                            email: profile.getEmail(),
                            first_name: profile.getGivenName(),
                            last_name: profile.getFamilyName(),
                            id: profile.getId(),
                            name: profile.getName()
                        }

                        xoo_sl_localize.sendUserInfo(userInfo, $button); // Send data to server

                    }
                )
            });
        })
    }

    startApp();

})