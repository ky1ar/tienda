jQuery(document).ready(function($){


    window.AppleID.auth.init({
        clientId: xoo_sl_apple_localize.clientID, // This is the service ID we created.
        scope: "name email", // To tell apple we want the user name and emails fields in the response it sends us.
        redirectURI: xoo_sl_apple_localize.redirect, // As registered along with our service ID
        state: "origin:web", // Any string of your choice that you may use for some logic. It's optional and you may omit it.
        usePopup: true, // Important if we want to capture the data apple sends on the client side.
    });

    const singInApple = async () => {
        const response = await window.AppleID.auth.signIn();

        console.log(response);

        return response;
    };

    singInApple();
})
  


