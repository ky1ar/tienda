jQuery(document).ready(function($){

	var Facebook = {

		$buttonClicked: '',

		init: function(){

			var tries = 0;

			var runned = setInterval( function(){

				if( window.FB ){
					clearInterval(runned);
					Facebook.run();
				}

				if( tries >= 20 ){
					clearInterval(runned);
				}

				tries++;

			}, 500  );

		},

		run: function(){
			Facebook.configureButton();

			FB.init({
				appId 		: xoo_sl_localize.facebook.app_id,
				cookie 		: true,
				xfbml 		: true,
				version 	: 'v16.0'
			});
      
			FB.AppEvents.logPageView();
		},

		configureButton(){

			$('.fb-login-button').each(function( index, el ){
				$(el).attr( 'data-index', index );
				$(el).attr( 'data-onlogin', 'xooSlFbLoginClick('+index+')' );
			});

			window.xooSlFbLoginClick = Facebook.processLoginOnClick;

		},

		processLoginOnClick(index){

			FB.login(function(response) {

				if (response.status === 'connected') {
					// Logged into your webpage and Facebook.
					Processor.init( response, 'facebook', $('.fb-login-button[data-index="'+index+'"]') );
				} 

			}, {scope: 'public_profile,email', auth_type: 'rerequest'});
		},


	}

	if( xoo_sl_localize.facebook.enable === "yes" ){
		Facebook.init();
	}




	var Google = {

		$buttonClicked: '',


		init: function(){

			var tries = 0;

			var runned = setInterval( function(){

				if( window.google ){
					clearInterval(runned);
					Google.run();
				}

				if( tries >= 20 ){
					clearInterval(runned);
				}

				tries++;

			}, 500  );

		},

		run: function(){

			google.accounts.id.initialize({
				client_id: xoo_sl_localize.google.client_id,
				callback: Google.callback
			});

			Google.renderButtons();
		},


		renderButtons: function(){

			var buttonParams = xoo_sl_localize.google.button;

			$('.xoo-sl-goo-btn').each(function( index, el ){

				buttonParams.click_listener = function(){
					Google.$buttonClicked = $(el);
				}

				google.accounts.id.renderButton(
					el,
					xoo_sl_localize.google.button
				);
			})
		},

		callback: function(response){
			Processor.init( response, 'google', Google.$buttonClicked );
		},

		

	}

	if( xoo_sl_localize.google.enable === "yes" ){
		Google.init();
	}

	var Processor = {

		social: '',
		$button: '',
		$buttonContainer: '',
		$easyLoginSection: '',
		$easyLoginContainer: '',
		$loader: '',
		isEasyLogin: '',


		init: function( socialData, socialType, $button ){

			Processor.$button 				= $button;
			Processor.$buttonContainer 		= $button.parents('.xoo-sl-container');
			Processor.$easyLoginSection 	= $button.parents('.xoo-el-section');
			Processor.isEasyLogin 			= Processor.$easyLoginSection.length;
			Processor.$easyLoginContainer 	= Processor.$easyLoginSection.parents('.xoo-el-form-container');
			Processor.$loader 				= Processor.$buttonContainer.find('.xoo-sl-processing');


			Processor.$buttonContainer.find('.xoo-sl-processing').show();

			$.ajax({
		        url: xoo_sl_localize.adminurl,
		        type: 'POST',
		        data: {
		          action: 'xoo_sl_process_social_response',
		          socialData: socialData,
		          socialType: socialType,
		          isEasyLogin: Processor.$easyLoginSection.length ? 'yes' : 'no'
		        },
		        success: function(response){

		        	if( response.success === 'false' && response.message ){
		        		$('.xoo-sl-notice-container').html(response.message);
		        		Processor.loader.hide();
		        	}

		        	if( response.success === "true" ){

		        		Processor.$loader.find('span').text( response.message )

		        		var redirectTo = xoo_sl_localize.redirect_to;		

		        		if( Processor.isEasyLogin && Processor.$easyLoginSection.find('input[name="xoo_el_redirect"]').length ){
		        			redirectTo = Processor.$easyLoginSection.find('input[name="xoo_el_redirect"]').val();
		        		}

		        		window.location = redirectTo;
		        	}

		        	if( response.register && response.register === "yes" ){
		        		Processor.forceRegister( response.userData );
		        	}

		        	$(document).trigger('xoo_sl_processing_userinfo',[response]);
		        }
		    });
		},


		forceRegister: function( userData ){

			Processor.$loader.hide();

    		var $registrationSection = Processor.$easyLoginContainer.find('[data-section="register"]');

    		if( !$registrationSection.length ){
    			$registrationSection = $('.xoo-el-form-popup').find('[data-section="register"]');
    			if( !$registrationSection.length ){
    				alert('no registration form found.');
    				return;
    			}
    			$('.xoo-el-reg-tgr').trigger('click'); //open popup
    		}

    		Processor.$easyLoginContainer.find('.xoo-el-reg-tgr').trigger('click');

    		var $email 		= $('.xoo-el-form-container input[name="xoo_el_reg_email"]'),
				$firstName 	= $('.xoo-el-form-container input[name="xoo_el_reg_fname"]'),
				$lastName 	= $('.xoo-el-form-container input[name="xoo_el_reg_lname"]');

			if( $email.length ) $email.val(userData.email);

			if( $firstName.length ) $firstName.val(userData.first_name);

			if( $lastName.length ) $lastName.val(userData.last_name);

			$registrationSection.find('.xoo-el-notice').html(xoo_sl_localize.fillFieldsNotice).show();
		}

	}	

})

 