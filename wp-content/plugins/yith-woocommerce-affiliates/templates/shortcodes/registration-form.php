<?php
/**
 * Affiliate Registration Form
 *
 * @author  YITH <plugins@yithemes.com>
 * @package YITH\Affiliates\Templates
 * @version 1.0.5
 */

/**
 * Template variables:
 *
 * @var $show_login_form string
 * @var $login_title     string
 * @var $register_title  string
 * @var $posted          array
 */

if ( ! defined( 'YITH_WCAF' ) ) {
	exit;
} // Exit if accessed directly
?>
<style>

    body{
    margin: 0;
    padding: 0;
    }
        
    .cont {
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center; 
    background-color: #f0f0f0;
    font-family: "Roboto", sans-serif;
    }
    .xoo-sl-btns-container{
        display: none;
    }
    .required{
    color: #ED6B22;
    }
    
    .login,
    .register {
    flex: 1;
    box-sizing: border-box;
    margin: 20px 0px;
    }
    
    .login {
    display: flex; 
    justify-content: center;
    align-items: center;
    flex-direction: column;
    }
    
    .login .clip{
    width: 170px;
    height: 7px;
    border-radius: 10px 10px 0 0;
    background-color: #ED6B22;
    }
    
    .login-f {
    background-color: white;
    border-radius: 30px;
    width: 70%;
    height: 560px;
    padding: 20px;
    padding-top: 0;
    display: flex;
    flex-direction: column; 
    justify-content: flex-start;
    align-items: center;
    margin-top: 0; 
    }

    .login-f h1 {
    text-align: center;
    background-color: #ED6B22;
    color: white;
    padding: 10px 30px;
    margin-top: 0;
    font-size: 22px;
    margin-bottom: 30px;
    border-radius: 0 0 10px 10px;
    box-shadow: 0 8px 5px 2px rgb(192, 192, 192);
    }
    
    .login-f form{
    width: 90%;
    display: flex;
    flex-direction: column;
    font-size: 12px;
    }
    .login-f form label:nth-of-type(1),
    .login-f form label:nth-of-type(2) {
    margin-left: 20px;
    font-weight: 600;
    margin-bottom: 10px;
    color: #555454;
    }
    
    .login-f form input {
    border-radius: 20px;
    padding: 10px 20px;
    border: 1px solid rgb(192, 192, 192);
    margin-bottom: 25px;
    }
    #profile_terms_field > span > label > a{
        color: black;
    }
    .login-f form input[type="password"] {
        width:100%;
    }
    
    .login-f form input:focus {
    outline: none;
    }
    .login-f form a.toggle-button.click-to-show,
    .register-f form a.toggle-button.click-to-show{
    display:none;
    }
    .login-f form input[type="submit"] {
    background-color: #ED6B22;
    border: 0;
    border-radius: 30px;
    color: white;
    width: 180px;
    height: 40px;
    margin: 0 auto;
    padding: 0;
    text-align: center; 
    line-height: 40px; 
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    }
    
    .login-f form input[type="submit"]:hover {
     background-color: #E77D41;
     color: white;
    }
    
    .login-f form label:nth-of-type(3) {
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 500;
    color: #555454;
    height: 50px;
    }
    
    .login-f form label:nth-of-type(3) input[type="checkbox"] {
    margin-top: 23px;
    }
    
    .login-f form .r-pass{
    text-align: center;
    text-decoration: none;
    color: black;
    font-weight: 700;
    }
    
    .login-f form hr {
    border: 0;
    height: 2px;
    background-color: #cccccc;
    width: 60%;
    margin: 20px auto;
    display: none;
    }
    
    .xoo-sl-container{
    display: none;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    
    }
    
    .login-f form .xoo-sl-button.xoo-sl-btn-facebook{
    display: none;
    }
    
    .register {
    background-color: transparent;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    }
    
    #profile_first_name_field {
    order: 1;
    }
    
    #profile_last_name_field {
        order: 2;
    }
    
    #profile_email_field {
        order: 3;
    }
    
    #profile_password_field {
        order: 4;
    }
    
    #profile_username_field {
    order: 5;
    width: 100%;
    padding-right: 20px;
    }
    
    #profile_terms_field {
        order: 6;
        width: 100%;
    }
     #btn-rego{
        order: 7; 
     }
    .register-f{
    height: 35rem;
    flex-direction: column;
    background-color: white;
    width: 75%;
    padding: 0 60px;
    border-radius: 30px;
    overflow: hidden;
    align-items: center;
    }
    
    .register .clip2{
    width: 200px;
    height: 7px;
    border-radius: 10px 10px 0 0;
    background-color: #ED6B22;
    }
    
    .register-f h1{
    display: flex;
    margin: auto;
    width: 12rem;
    align-items: center;
    justify-content: center;
    background-color: #ED6B22;
    color: white;
    padding: 10px 30px;
    margin-top: 0;
    font-size: 22px;
    margin-bottom: 3rem;
    border-radius: 0 0 10px 10px;
    box-shadow: 0 8px 5px 2px rgb(192, 192, 192);
    }
    
    .register-f form {
    display: flex;
    flex-wrap: wrap;
    }
    
    .register .register-f form label{
    margin-left: 20px;
    font-weight: 600;
    font-size: 12px;
    color: #555454;
    }
    
    .register .register-f form #profile_username,
    .register .register-f form #profile_first_name,
    .register .register-f form #profile_last_name,
    .register .register-f form #profile_email,
    .register .register-f form #profile_password{
    border-radius: 20px;
    padding: 10px 20px;
    border: 1px solid rgb(192, 192, 192);
    background-color: white;
    }
    .woocommerce form .form-row{
    margin-right: 10px;    
    }
    
    .register .register-f form p{
    width: 47%;
    }
    .register .register-f form span.error-msg{
        color: #ef6b22;
        font-size: 12px;
    }
    
    .register .register-f #profile_terms_field > span > label{
    margin-top: 10px;
    line-height: 1.2;
    display: flex;
    }
    
    .register .register-f #profile_terms_field > span > label > a{
    margin-left: 3px;    
    }
     
    .register > div > form > p:nth-child(7){
    width: 100%;
    display: flex
    }
    
    .register .register-f form input[type="submit"]{
    background-color: #ED6B22;
    border: 0;
    border-radius: 30px;
    color: white;
    width: 180px;
    height: 40px;
    margin: 3rem auto;
    padding: 0;
    text-align: center;
    line-height: 40px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    }
    
    .pending-request-wrapper{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: white;
    width: 50%;
    margin: 100px auto;
    border-radius: 10px;    
    text-align: center;
    padding: 20px;
    }
    .pending-request-wrapper h3{
    color: #E56119;
    font-weight: bold;
    font-size: 30px;
    margin-bottom: 0;
    }
    .become-an-affiliate-form{
    background-color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 80%;
    flex-direction: column;
    margin: 20px auto;
    border-radius: 10px;
    }
    .become-an-affiliate-form p .btn.button{
    background-color: #E56119;
    color: white;
    }
    .yith-wcaf.yith-wcaf-registration-form.woocommerce > img{
        width: 100%;
        margin-bottom: 1rem;
    }
    section.tyc{
    margin-top: 3rem;
    display: flex;
    flex-direction: column;
    padding: 2rem;
    align-items: center;
    justify-content: center;
    background-color: var(--gray);
    font-family: "Lato", sans-serif;
}

section.tyc p.open{
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: 700;
	cursor: pointer;
}
section.tyc p.open img{
    width: 1rem; 
    margin-left: 1rem;
}

section.tyc div{
    background-color: white;
    max-width: 75rem;
    padding: 2rem 5rem;
    max-height: 32rem;
    overflow: hidden;
}
section.tyc div.expanded{
    max-height: none;
}
section.tyc div.ef{
    width: 100%;
    height: 2rem;
    margin: 0;
    background-image: linear-gradient(white, var(--gray));
}
section.tyc div h1{
    text-align: center;
    font-size: 1.3rem;
    margin-bottom: 2rem;
}
section.tyc div h2{
    font-size: 1rem;
    text-transform: uppercase;
    padding-left: 2rem;
}

section.tyc div p{
    font-weight: 400;
    font-size: 0.9rem;
    text-align: justify;
    line-height: 1.3;
}
section.tyc div p:not(:nth-child(2)){
    padding-left: 3rem;
}
section.tyc div ul{
    padding-left: 6rem;
}
section.tyc div ul li{
    font-weight: 400;
    font-size: 0.9rem;
    text-align: justify;
    line-height: 1.3;
}

section.tyc div p span{
    font-weight: 600;
    text-decoration: underline;
}
    @media only screen and (max-width: 1600px) {
        .login-f {
        height: 580px;
        }
        .register .register-f {
        width: 65%;
        padding: 20px;
        padding-top: 0px;
        min-height:36rem;
        height: auto;
        }
        .register-f h1{
        margin-bottom: 1rem;    
        }
        .register .register-f form p {
        width: 100%;
        }
        
        .woocommerce form .form-row {
        margin-right: 0;
        }
        
        .register > div > form > p:nth-child(7) {
        height: 40px;
        justify-content: center;
        align-items: center;
        }
        .register .register-f #profile_terms_field > span > label{
            margin-top: 0;
            display: inline-block;
        }
        #profile_username_field {
            padding-right: 0;
        }
        #profile_username_field > label{
            line-height: 1.4;
        }
    }
    @media only screen and (max-width: 1200px) {
        .login .login-f,
        .register .register-f {
            width: 80%;
        }
        .pending-request-wrapper{
        width: 70%;
        }
        section.tyc div{
        padding: 2rem;
    }
    }
    @media only screen and (max-width: 992px) {
        .cont {
            flex-direction: column;
        }
        .login{
          width: 26rem;
        }
        .login .login-f {
        width: 100%;
        padding-bottom: 50px;
        }
        .login .login-f form{
            width: 110%;
            padding: 0 40px;
        }
        .register .register-f {
        width: 430px;
        padding-left: 36px;
        padding-right: 36px;
        margin-bottom: 40px;
        }
    }
    @media only screen and (max-width: 768px) {
        .login{
        width: 26rem;
        }
        .pending-request-wrapper h3{
        font-size: 20px;
        }
        .yith-wcaf.yith-wcaf-registration-form.woocommerce > img{
        content: url(https://tiendakrear3d.com/wp-content/uploads/2024/06/BANNER-2400X800-PROGRAMA-AFILIADOS.webp);
        }
        .register .register-f form label{
        margin-left: 20px;
        font-weight: 600;
        font-size: 12px;
        color: #555454;
        line-height: 1.4;
        padding-right: 20px;
        margin-bottom: 0.1rem;
        }
        .register > div > form > p:nth-child(7){
            margin-top: 0.5rem;
        }
    }
    @media only screen and (max-width: 576px) {
        .login .login-f{
        width: 95%;
        }
        .register .register-f h1{
        margin-top: 0px;
        margin-bottom: 20px;
        }
        .register .register-f {
        width: 400px;
        }
        section.tyc div h1{
        font-size: 1.1rem;
    }
    section.tyc div h2{
        font-size: 0.9rem;
    }
    section.tyc div p{
        font-size: 0.8rem;
    }
    section.tyc div ul li{
        font-size: 0.8rem;
    }
    section.tyc p.open{
        font-size: 0.9rem;
    }
        
    }
    @media only screen and (max-width: 416px) {
        .login{
            width: 95%;
        }
        .login .login-f form {
        padding: 0 20px;
        }
        .register .register-f {
        width: 90%;
        padding-left: 20px;
        padding-right: 20px;
        }
        .login-f form label:nth-of-type(1),
        .login-f form label:nth-of-type(2) {
        margin-right: 30px;    
        }
</style>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var emailLabel = document.querySelector('label[for="profile_email"]');

    // Verifica si el label existe
    if (emailLabel) {
        // Cambia el texto del label
        emailLabel.textContent = 'Correo electrónico';
        // Agrega el span de required al lado del label
        emailLabel.insertAdjacentHTML('beforeend', '<span class="required"> *</span>');
    }
    
    // Selecciona el campo de texto que deseas reemplazar
    var inputField = document.getElementById('profile_username');

    // Verifica si el campo existe
    if (inputField) {
        // Crea un nuevo elemento textarea
        var textarea = document.createElement('textarea');
        textarea.name = inputField.name;
        textarea.id = inputField.id;
        textarea.className = inputField.className;
        textarea.value = inputField.value;
        textarea.required = inputField.required;

        textarea.rows = 5;

        // Aplica los estilos
        textarea.style.resize = 'none';
        textarea.style.fontWeight = '500';
        textarea.style.color = 'black';

        // Cambia el texto del label
        var label = document.querySelector('label[for="profile_username"]');
        if (label) {
            label.textContent = '¿Por qué te interesa unirte, qué plataformas digitales tienes?';
            // Agrega el span de required al lado del label
            label.insertAdjacentHTML('beforeend', '<span class="required"> *</span>');
        }

        // Reemplaza el campo de texto con el área de texto
        inputField.parentNode.replaceChild(textarea, inputField);
    }
});
</script>




<div class="yith-wcaf yith-wcaf-registration-form woocommerce">
    <img class="banner-reg" src="https://tiendakrear3d.com/wp-content/uploads/2024/06/BANNER-2400X400-PROGRAMA-AFILIADOS.webp" alt="">
	<?php
	if ( function_exists( 'wc_print_notices' ) ) {
		wc_print_notices();
	}
	?>

	<?php if ( ! is_user_logged_in() ) : ?>

		<?php
		/**
		 * APPLY_FILTERS: yith_wcaf_show_login_section
		 *
		 * Filters whether to show the section to login as an affiliate.
		 *
		 * @param bool $show_login_section Whether to show login section or not.
		 */
		?>
		<div class="cont <?php echo apply_filters( 'yith_wcaf_show_login_section', 'yes' === $show_login_form ) ? 'u-columns col2-set' : ''; ?>">

			<?php if ( apply_filters( 'yith_wcaf_show_login_section', 'yes' === $show_login_form ) ) : ?>
				<div class="login">
				     <div class="clip"></div>
					<div class="login-f">
					    <h1>ACCEDER</h1>
						<form method="post">
							<?php do_action( 'woocommerce_login_form_start' ); ?>
								<label for="username">
									<?php echo esc_html_x( 'Correo electrónico', '[FRONTEND] Affiliate login form', 'yith-woocommerce-affiliates' ); ?>
									<span class="required">*</span>
								</label>
								<input type="text" name="username" id="username" value="<?php echo ! empty( $posted['username'] ) ? esc_attr( $posted['username'] ) : ''; ?>" />
					
								<label for="password">
									<?php echo esc_html_x( 'Password', '[FRONTEND] Affiliate login form', 'yith-woocommerce-affiliates' ); ?>
									<span class="required">*</span>
								</label>
								<input type="password" name="password" id="password" />
							
							<?php do_action( 'woocommerce_login_form' ); ?>

								<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
								<input type="submit" class="woocommerce-Button button" name="login" value="<?php echo esc_attr_x( 'ACCEDER', '[FRONTEND] Affiliate login form', 'yith-woocommerce-affiliates' ); ?>"/>
								<label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
									<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever"/>
									<span><?php echo esc_html_x( 'Remember me', '[FRONTEND] Affiliate login form', 'yith-woocommerce-affiliates' ); ?></span>
								</label>
						
								<a class="r-pass" href="<?php echo esc_url( wp_lostpassword_url() ); ?>">
									<?php echo esc_html_x( 'Lost your password?', '[FRONTEND] Affiliate login form', 'yith-woocommerce-affiliates' ); ?>
								</a>
                                <hr />
                                
							<?php do_action( 'woocommerce_login_form_end' ); ?>
                            
						</form>
					</div>

				</div>
			<?php endif; ?>

			<?php if ( apply_filters( 'yith_wcaf_show_login_section', 'yes' === $show_login_form ) ) : ?>
				<div class="register">
				<div class="clip2"></div>
			<?php endif; ?>

			<?php
			/**
			 * APPLY_FILTERS: yith_wcaf_show_register_section
			 *
			 * Filters whether to show the section to register as an affiliate.
			 *
			 * @param bool $show_register_section Whether to show register section or not.
			 */
			if ( apply_filters( 'yith_wcaf_show_register_section', true ) ) :
				?>
                
				<div class="register-f">
                    <h1>REGISTRARTE</h1>
					<form method="post">

						<?php do_action( 'woocommerce_register_form_start' ); ?>
						<?php
						/**
						 * DO_ACTION: yith_wcaf_register_form_start
						 *
						 * Allows to render some content at the beginning of the registration form for the affiliates.
						 */
						do_action( 'yith_wcaf_register_form_start' );
						?>
						<?php
						/**
						 * DO_ACTION: yith_wcaf_register_form
						 *
						 * Allows to render some content in the registration form for the affiliates.
						 */
						do_action( 'yith_wcaf_register_form' );
						?>
						<?php do_action( 'woocommerce_register_form' ); ?>
                    
						<p class="form-row" id="btn-rego">
							<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
							<?php wp_nonce_field( 'yith-wcaf-register-affiliate', 'register_affiliate', false ); ?>
							<input type="submit" class="button" name="register" value="<?php echo esc_attr_x( 'REGISTRARTE', '[FRONTEND] Affiliate registration form', 'yith-woocommerce-affiliates' ); ?>"/>
						</p>

						<?php do_action( 'woocommerce_register_form_end' ); ?>

					</form>
				<script>
    $(document).ready(function() {
        var termsLabel = $(".terms-label");
        termsLabel.contents().filter(function() {
            return this.nodeType === 3; 
        }).remove();
        termsLabel.find("label").css("display", "flex");
        termsLabel.find("label").html(function(_, html) {
            return html.replace(/&nbsp;/g, '');
        });
        termsLabel.find("a").text("Acepto los términos y condiciones. ");
    });
</script>

				</div>
				

			<?php endif; ?>

			<?php if ( apply_filters( 'yith_wcaf_show_login_section', 'yes' === $show_login_form ) ) : ?>
				</div>
			<?php endif; ?>

		</div>

	<?php elseif ( ! YITH_WCAF_Affiliates()->is_user_affiliate() ) : ?>

		<div class="become-an-affiliate-form">
			<p>
				<?php
				/**
				 * APPLY_FILTERS: yith_wcaf_registration_form_become_affiliate_text
				 *
				 * Filters the text displayed in the form to become an affilliate.
				 *
				 * @param string $text Text.
				 */
				echo wp_kses_post( apply_filters( 'yith_wcaf_registration_form_become_affiliate_text', _x( 'You\'re just one step away from becoming an affiliate!', '[FRONTEND] Become an affiliate form', 'yith-woocommerce-affiliates' ) ) );
				?>
			</p>
			<form method="post" class="become-an-affiliate">
				<?php
				/**
				 * DO_ACTION: yith_wcaf_become_an_affiliate_form
				 *
				 * Allows to render some content in the form to "Become an affiliate".
				 */
				do_action( 'yith_wcaf_become_an_affiliate_form' );
				?>

				<p class="form-row">
					<?php wp_nonce_field( 'yith-wcaf-become-an-affiliate', 'become_an_affiliate', true ); ?>

					<?php
					/**
					 * APPLY_FILTERS: yith_wcaf_become_affiliate_button_text
					 *
					 * Filters the text of the button to become an affiliate.
					 *
					 * @param string $text Text.
					 */
					$become_an_affiliate_text = apply_filters( 'yith_wcaf_become_affiliate_button_text', _x( 'Become an affiliate', '[FRONTEND] Become an affiliate form', 'yith-woocommerce-affiliates' ) );
					?>
					<button class="btn button"><?php echo esc_html( $become_an_affiliate_text ); ?></button>
				</p>
			</form>
		</div>

	<?php elseif ( YITH_WCAF_Affiliates()->is_user_enabled_affiliate() ) : ?>

		<div class="already-an-affiliate-wrapper">
			<h3 class="thank-you">
				<?php echo esc_html_x( 'Thank you!', '[FRONTEND] Affiliate dashboard message', 'yith-woocommerce-affiliates' ); ?>
			</h3>
			<p class="already-an-affiliate">
				<?php
				/**
				 * APPLY_FILTERS: yith_wcaf_registration_form_already_affiliate_text
				 *
				 * Filters the text displayed when the user is an affiliate.
				 *
				 * @param string $text Text.
				 */
				echo wp_kses_post( apply_filters( 'yith_wcaf_registration_form_already_affiliate_text', _x( 'You have joined our affiliate program!<br/>In your dashboard, you will find your referral URL and detailed information to check commissions, visits, earnings, and payments.', '[FRONTEND] Affiliate dashboard message', 'yith-woocommerce-affiliates' ) ) );
				?>
			</p>

			<a href="<?php echo esc_url( YITH_WCAF_Dashboard()->get_dashboard_url() ); ?>" class="button go-to-dashboard">
				<?php echo esc_html_x( 'Go to your dashboard', '[FRONTEND] Affiliate dashboard message', 'yith-woocommerce-affiliates' ); ?>
			</a>
		</div>

	<?php elseif ( YITH_WCAF_Affiliates()->is_user_pending_affiliate() ) : ?>

		<div class="pending-request-wrapper">
			<h3 class="thank-you">
				<?php echo esc_html_x( 'ESTÁS A UN PASO DE CONVERTIRTE EN NUESTRO SOCIO', '[FRONTEND] Affiliate dashboard message', 'yith-woocommerce-affiliates' ); ?>
			</h3>
			<p class="pending-request">
				<?php
				/**
				 * APPLY_FILTERS: yith_wcaf_registration_form_affiliate_pending_text
				 *
				 * Filters the text when the user is pending to be approved as an affiliate.
				 *
				 * @param string $text Text.
				 */
				echo wp_kses_post( apply_filters( 'yith_wcaf_registration_form_affiliate_pending_text', _x( 'Estamos revisando tu información para que seas parte de nuestro programa', '[FRONTEND] Affiliate dashboard message', 'yith-woocommerce-affiliates' ))); 
				?>
			</p>
		</div>

	<?php elseif ( YITH_WCAF_Affiliates()->is_user_rejected_affiliate() ) : ?>

		<div class="rejected-request-wrapper">
			<h3 class="we-are-sorry">
				<?php echo esc_html_x( 'We\'re sorry!', '[FRONTEND] Affiliate dashboard message', 'yith-woocommerce-affiliates' ); ?>
			</h3>
			<p class="rejected-request">
				<?php
				$reject_message = YITH_WCAF_Affiliates()->get_user_reject_message();

				if ( ! $reject_message ) {
					$reject_message = _x( 'We regretfully inform you that we can\'t accept your request as it doesn\'t fulfill our requirements.', '[FRONTEND] Affiliate dashboard message', 'yith-woocommerce-affiliates' );
				}

				/**
				 * APPLY_FILTERS: yith_wcaf_registration_form_rejected_affiliate_text
				 *
				 * Filters the message when the user has been rejected as an affiliate.
				 *
				 * @param string $reject_message Reject message.
				 */
				echo wp_kses_post( apply_filters( 'yith_wcaf_registration_form_rejected_affiliate_text', $reject_message ) );
				?>
			</p>
		</div>

	<?php endif; ?>
<section class="tyc">
      <div class="doc">
       <h1>TÉRMINOS Y CONDICIONES PROGRAMA AFILIADOS KREAR 3D</h1>
        <p>
          Estos términos y condiciones establecen los términos de uso acordados
          entre Fabricaciones Digitales del Perú S.A (en lo sucesivo Krear 3D) y
          los afiliados (en lo sucesivo Socio) para que este participe en el
          Programa de Afiliados (en lo sucesivo Programa) operado por Krear 3D.
        </p>
        <h2>1. Definiciones</h2>
        <p>
          En los presentes términos y condiciones, las siguientes palabras
          tienen el siguiente significado:
        </p>
        <ul>
          <li>
            "Cliente" se refiere al visitante de la tienda online de Krear 3D
            que compra un producto calificado que constituye el objeto del
            Programa.
          </li>
          <li>
            “Demandas” tendrán el significado establecido en la sección 7.
          </li>
          <li>
            "Información confidencial" se refiere a toda la información,
            documentación o datos sobre Krear 3D, el Programa o el Socio y sus
            respectivos negocios y/o asuntos (ya sea de forma escrita, incluida
            en cualquier formulario electrónico, o de forma oral, preparado por
            el Socio, sus miembros o de cualquier otra manera), que haya sido
            revelada a cualquiera de las partes en cualquier momento, además de
            todos los análisis, informes, compilaciones, pronósticos, estudios u
            otros documentos o datos preparados por Krear 3D o el Socio.
          </li>
          <li>
            "Enlace Calificado" es un enlace URL proporcionado por Krear 3D y
            que, al ser pulsado por un usuario, identifica que el visitante ha
            sido derivado por el socio al programa en el que este participa y
            contiene parámetros únicos necesarios para rastrear la venta de
            cualquier producto calificado. Los enlaces calificados se deben
            utilizar para que el Socio obtenga los pagos (tal como se define más
            adelante en la sección 4) a partir de una transacción.
          </li>
          <li>
            "Producto Elegible" se refiere a cualquier producto con el que un
            Socio puede ganar un pago por una compra realizada por un cliente en
            la tienda online de KREAR 3D.
          </li>
          <li>
            "Transacción" significa que el cliente ha accedido a la tienda
            online de Krear 3D (<a href="https://tiendakrear3d.com/"  style="display: inline; color: black; font-weight:600" target="_blank">www.tiendakrear3d.com</a>) y ha comprado el producto
            elegible a través de un enlace calificado.
          </li>
          <li>
            "Sitio Web" o "Sitio" es la página o sitio web que forma parte de la
            infraestructura web del socio y que ha sido registrada por el socio
            para participar en un programa.
          </li>
          <li>
            “Plataformas Digitales” se refiere a la página web, blog, canal de
            YouTube, perfil de IG, página de Facebook, cuenta de TikTok o
            cualquier otro medio que emplea el Socio.
          </li>
        </ul>

        <h2>2. Participación en el programa</h2>
        <p>
          El Programa de Afiliados es aplicable a personas naturales mayores de
          edad que residan en el territorio peruano y que cuenten con DNI o RUC
          10.
          <br /><br />
          La participación exige el registro en Krear 3D a través de la
          siguiente página web:
          <a
            style="display: inline; color: black; font-weight:600"
			target="_blank"
            href="www.tiendakrear3d.com/portal-afiliados"
            >www.tiendakrear3d.com/portal-afiliados</a
          >
          <br /><br />
          Una vez que se haya realizado la inscripción en el Programa, se
          evaluarán los datos del Socio lo que puede tomar hasta 3 días hábiles.
          El Socio será notificado a través de correo electrónico, en caso de
          que sea aceptado para participar en el programa. La inscripción exige
          la aceptación de los presentes Términos y Condiciones.
          <br /><br />
          Krear 3D no aceptará en su programa ningún Socio que no sea adecuado y
          se reserva el derecho a poner fin por causa inmediata y sin previo
          aviso a la participación del Socio.
          <br /><br />
          El Socio garantizará que no va publicar los links del Programa de
          Afiliados en Plataformas Digitales que tengan este tipo de contenido:
        </p>
        <ul>
          <li>
            Promueven la discriminación por motivos de raza, sexo, religión,
            nacionalidad, discapacidad, orientación sexual, edad o por cualquier
            otro motivo.
          </li>
          <li>
            Incluyen contenido que incite al odio, sea violento u ofensivo o que
            sea potencialmente calumnioso o difamatorio, incluyendo temáticas
            relacionadas con el sexo en general o que contengan material sexual
            explícito.
          </li>
          <li>
            Promueva actividades ilegales (incluyendo aquellas que incitan a
            actividades ilegales) o cualquier material que infrinja o ayude a
            otros a infringir o violar cualquier derecho de autor, marca
            registrada u otra propiedad intelectual o derechos de terceros.
          </li>
          <li>
            Utilice medios engañosos, fraudulentos o molestos ("clickbait") para
            inducir clics; Incluya una marca comercial de Krear 3D,
            combinaciones, derivados o errores de ortografía de la misma en el
            nombre del dominio.
          </li>
          <li>
            Utilice material creativo de Krear 3D, no autorizado o no aprobado.
          </li>
          <li>
            Ocasione daños a la reputación de KREAR 3D, o de alguna de sus
            marcas.
          </li>
          <li>
            Viole de cualquier otra forma los derechos de propiedad
            intelectual o la legislación aplicable, o que se consideren de
            alguna forma ofensivos o inapropiados con la conducta y la posición
            comercial de Krear 3D.
          </li>
        </ul>
        <p>
          KREAR 3D tiene plena discreción para admitir o no a cualquier
          solicitante al Programa.
          <br /><br />
          El Socio publicará en sus Plataformas Digitales los productos
          seleccionados de Krear 3D por medio de enlaces calificados. La
          posición, la prominencia y la naturaleza de los enlaces en el sitio
          web del Socio deberán cumplir con los requisitos especificados en el
          Programa, pero, por lo demás, quedarán generalmente a discreción del
          Socio. Este deberá asegurarse de que se utilicen las gráficas
          adecuadas con los Enlaces Calificados correspondientes, y que estos se
          vinculen con las páginas correctas. Si Krear 3D lo requiere el Socio
          retirará sin demora (en menos de 12 horas) los anuncios de banner, el
          texto y/o los enlaces al sitio de la tienda online de KREAR 3D.
        </p>
        <h2>3. Obligaciones y garantías generales del socio</h2>
        <p>El socio declara y garantiza a KREAR 3D que:</p>
        <ul>
          <li>
            El Socio realizará los servicios de acuerdo a los Términos y
            Condiciones presentes y con la debida diligencia.
          </li>
          <li>
            El Socio cumple con todas las leyes, estatutos, reglamentos y otras
            disposiciones aplicables, establecidas por las autoridades peruanas;
            y que en virtud de las leyes de protección de datos aplicables, el
            sitio web del socio proporciona siempre el marco necesario para que
            Krear 3D ejecute el Programa tal como ha sido diseñado, incluyendo
            una Política de Privacidad en línea suficiente para sus visitantes,
            que incluya información sobre la tecnología de seguimiento utilizada
            en línea con la legislación aplicable.
          </li>
          <li>
            El Socio no se dedicará a la venta de productos de la marca Krear 3D
            o de terceros a nivel mayorista o minorista, independientemente de
            que dicha venta se realice por cuenta propia o en nombre de
            terceros.
          </li>
          <li>
            El Socio deberá notificar inmediatamente a Krear 3D cualquier
            circunstancia, problema o cambio relevante para el Programa,
            incluyendo el mal funcionamiento de los Enlaces Calificados u otros
            problemas con la participación del Socio en el Programa.
          </li>
          <li>
            El Socio deberá contar con evidencias que relacionen la(s) compra(s)
            de Cliente(s) en el Sitio Web de Krear 3D, para que la Transacción
            sea atribuible al Socio. Éstas incluyen conversaciones por chat de
            FB, IG, TikTok, WhatsApp, contenido creado, historias,
            publicaciones, videos, reels, blog, páginas web y más, que
            garanticen que se trata de un Cliente propio. Krear 3D solicitará la
            información previa al pago de Comisiones y podrá eliminar alguna de
            ellas y/o no reconocer alguna Transacción, en caso el Socio no tenga
            el sustento necesario para ello. Esta determinación será sólo
            criterio de Krear 3D en base a las pruebas brindadas.
          </li>
          <li>
            KREAR 3D podrá (a) cambiar, suspender o interrumpir cualquier
            aspecto del Programa y/o (b) eliminar, alterar o modificar cualquier
            creación en cualquier momento y sin previo aviso. Si se le solicita,
            el Socio deberá implementar cualquier solicitud de Krear 3D para
            eliminar, alterar o modificar cualquier creación en un plazo de 48
            horas.
          </li>
        </ul>
        <p>
          El uso del nombre, los logotipos, las marcas comerciales, las marcas
          de servicio y la imagen comercial de Krear 3D por parte del Socio,
          deberá realizarse de una forma que sea claramente menos prominente que
          la del nombre, los logotipos, las marcas comerciales, las marcas de
          servicio, la imagen comercial, los productos y el nombre del sitio del
          Socio en cualquiera de sus Plataformas Digitales. El socio no creará
          ni intentará crear la impresión de que existe una asociación o
          sociedad entre Krear 3D y el Socio más allá de la disposición que rige
          estos Términos y Condiciones.
        </p>
        <h2>4. Comisiones</h2>
        <p>
          Mediante la participación en el Programa de Afiliados de Krear 3D, el
          Socio puede ganar una "comisión", o "pago", tal como se especifica en
          los términos del Programa, si un cliente compra un producto calificado
          a través de una transacción concretada.
          <br /><br />
          Krear 3D determinará a su entera discreción lo que constituye un
          producto calificado para el Programa y no realizará pagos por
          productos no calificados o por ventas que no sean completas o genuinas
          de acuerdo a los presentes Términos y Condiciones; y a las
          Obligaciones y Garantías del apartado 3.
          <br /><br />
          Las transacciones elegibles para la comisión se basan en una política
          de último clic y, por lo tanto, independientemente de que un Cliente
          pueda haber visitado la web de Krear 3D a través de una creación
          publicada en la Plataforma Digital del Socio en una ocasión anterior,
          pero haya decidido finalizar la compra después de visitar y hacer clic
          en una creación publicada en el sitio de otro Socio. El socio acepta
          que las decisiones relacionadas con el pago de una comisión se basarán
          principalmente en la tecnología de seguimiento de Krear 3D.
          <br /><br />
          No se pagarán comisiones al Socio si este ofrece la devolución del
          dinero o puntos del Programa de Beneficios a un cliente que también ha
          utilizado un cupón o código de promoción único.
          <br /><br />
          Las ventas completas son las únicas elegibles para la comisión. Por lo
          tanto, cualquier transacción se mantiene pendiente hasta que se
          confirme la conclusión de las ventas y hasta que haya finalizado el
          periodo legal aplicable o el periodo de devolución con el medio de
          pago utilizado, o el periodo contractual acordado entre Krear 3D y el
          Cliente, sin que este haya devuelto o notificado la devolución de la
          compra o parte de ella.
          <br /><br />
          Krear 3D gestiona el procesamiento y el pago de las comisiones del
          Socio en un plazo de hasta 30 días hábiles pudiendo ser antes, y, por
          lo tanto, supervisa la especificación de cualquier requisito para el
          pago al Socio.
          <br /><br />
          Estas condiciones son complementarias a las condiciones de pago y a
          las restricciones adicionales sobre los pagos contenidas en los
          Términos y Condiciones de publicación entre Krear 3D y el Socio.
        </p>
        <h2>5. Métodos promocionales</h2>
        <p>
          Al participar en el programa, los socios deberán respetar los
          siguientes principios:
          <br /><br />
          <span>Campañas de búsqueda pagadas:</span>
          <br />
          Política de oferta y uso de palabras clave: está prohibido el
          arbitraje de búsqueda. El Socio no comprará ni ofrecerá la colocación
          de la marca comercial Krear 3D, cualquier variación de la misma
          (incluyendo, pero sin limitarse a abreviaturas, errores ortográficos,
          encadenamiento del nombre Krear 3D) ni de cualquier otra marca
          comercial de Krear 3D dentro de cualquier motor de búsqueda o portal
          de compras de terceros. El Socio tampoco pagará a terceros sobre esa
          base por la colocación en los motores de búsqueda o portales de
          compra.
          <br /><br />
          <span>Política de dominios:</span>
          <br />
          Se prohíbe el uso de cualquier marca comercial de Krear 3D en los
          dominios y subdominios, incluyendo "Krear 3D", "Tienda Krear 3D",
          “Krear3Dental” y/o variaciones.
          <br /><br />
          <span>Redes sociales:</span>
          <br />
          El Socio está autorizado a publicar creaciones en sus Plataformas
          Digitales, pero no podrá hacerlo en ninguna de las plataformas de
          redes sociales de Krear 3D. Se prohíbe cualquier táctica de publicidad
          pagada en las plataformas de redes sociales para promocionar los
          enlaces de los afiliados.
          <br /><br />
          <span>Correo electrónico:</span>
          <br />
          El Socio no deberá enviar ningún correo electrónico ni ningún otro
          mensaje electrónico que incluya alguna creación, referencia o material
          de Krear 3D sin la aprobación previa expresa de Krear 3D. Krear 3D
          tiene plena discreción para aprobar cualquier mensaje o no.
        </p>
        <h2>6. Limitación de la responsabilidad</h2>
        <p>
          Bajo ninguna circunstancia Krear 3D será considerado responsable por
          daños especiales, indirectos, accidentales, punitivos, emergentes o
          por escarmiento, relacionados con este sitio web o bien que surjan del
          mismo, ya sea que una de las partes supiera o debiera haber sabido, de
          forma real o sobreentendida, que se podría incurrir en dichos daños.
        </p>
        <h2>7. Indemnización</h2>
        <p>
          El Socio acuerda que resguardará, indemnizará, defenderá y eximirá a
          Krear 3D, sus ejecutivos, directores, empresas afiliadas, empleados,
          contratistas, subcontratistas, agentes socios y subsidiarias, de
          cualquier responsabilidad, reclamo, acción, demanda de
          responsabilidad, pleito u otro procedimiento y de cualquier pérdida,
          daño, sanción, multa, daños y costos, incluidos los honorarios o
          desembolsos razonables de los abogados, o de las sentencias (en
          adelante "demandas") que se presenten o puedan ser presentadas por
          cualquier tercero en relación con el incumplimiento de los presentes
          Términos y Condiciones por parte del Socio incluyendo, pero no
          limitadas a las demandas relacionadas con la infracción de los
          derechos de propiedad intelectual de terceros, la infracción de la ley
          de competencia desleal, la infracción de la ley de protección de
          datos, entre otras.
        </p>
        <h2>8. Confidencialidad</h2>
        <p>
          El Socio mantendrá toda la información confidencial de la que tenga
          conocimiento durante y después de la ejecución de los presentes
          Términos y Condiciones de forma estrictamente confidencial, y la
          utilizará única y exclusivamente para los fines de los presentes
          Términos y Condiciones y no la utilizará en beneficio propio o de
          algún tercero.
        </p>
        <h2>9. Protección y seguridad de los datos personales</h2>
        <p>
          Los datos personales ingresados en el formulario y/o utilizados para
          la afiliación al Programa, así como los datos relacionados a las
          transacciones que se efectúen para la ejecución del Programa, serán
          tratados de manera conjunta por Krear 3D para las siguientes
          finalidades:
        </p>
        <ul>
          <li>Habilitar la participación del socio en el Programa.</li>
          <li>Crear la cuenta del Programa y gestión de la misma.</li>
          <li>Realizar el abono de sus comisiones.</li>
          <li>Enviar los reportes de las ventas acumulados.</li>
          <li>Identificar al socio para el abono de sus comisiones</li>
          <li>
            Acciones de marketing mediante llamadas, correos, mensajes SMS,
            mensajes por WhatsApp, mensajes por las redes sociales oficiales
            para promocionar las actividades de Krear 3D.
          </li>
        </ul>
        <h2>10. Término</h2>
        <p>
          KREAR 3D puede poner término al Programa por conveniencia en cualquier
          momento. La terminación del Programa no pondrá fin a estos Términos y
          Condiciones.
          <br /><br />
          Los presentes Términos y Condiciones comenzarán en el momento en que
          Krear 3D apruebe la inscripción del Socio en el Programa. Krear 3D
          tendrá derecho a poner término a los presentes Términos y Condiciones
          con un plazo de preaviso de 7 días hábiles.
          <br /><br />
          Krear 3D podrá rescindir los presentes Términos y Condiciones con
          efecto inmediato mediante notificación por escrito al Socio en caso de
          que:
        </p>
        <ul>
          <li>
            El Socio cometa un incumplimiento de cualquiera de lo establecido en
            los presentes Términos y Condiciones que sea más que insignificante
            y cuyo incumplimiento no sea susceptible de ser solucionado o (si
            dicho incumplimiento es solucionable) dicho incumplimiento no se
            soluciona dentro de un plazo de tres (3) días hábiles desde que se
            le solicite hacerlo por escrito.
          </li>
          <li>
            El Socio cese sus actividades comerciales relevantes para el
            Programa.
          </li>
          <li>
            El Socio se convierta en asociado de un competidor directo de Krear
            3D
          </li>
        </ul>
        <p>
          La rescisión en virtud del presente documento no requiere un período
          de notificación. El derecho de Krear 3D a rescindir los presentes
          Términos y Condiciones por motivos importantes no se verá afectado.
          <br /><br />
          El Socio dejará de utilizar inmediatamente el nombre, los logotipos,
          las marcas comerciales, las marcas de servicio, la imagen comercial,
          la tecnología patentada y cualquier creación tras el término/
          rescisión o la expiración de estos Términos y Condiciones.
        </p>
        <h2>11. Aceptación de los Términos y Condiciones</h2>
        <p>
          El uso de este sitio web está condicionado por la aceptación por parte
          del Socio conforme a los Términos y Condiciones aquí expresados. Por
          la presente, todos los Socios de este Sitio Web comprenden y acuerdan
          que su utilización constituye una aceptación de los presentes Términos
          y Condiciones establecidos en la presente. Krear 3D se reserva el
          derecho de modificar los Términos y Condiciones en cualquier momento,
          sin previo aviso. Si usted no está de acuerdo con estos Términos, no
          podrá utilizar este sitio web, ni ser parte del Programa. El nombre de
          dominio tiendakrear3d.com es propiedad de Fabricaciones Digitales del
          Perú S.A.
          <br /><br />
          <b>Cobertura Geográfica:</b> En Perú
        </p>
        <h2>12. Fuerza Mayor</h2>
        <p>
          Sin perjuicio de cualquier otra disposición descrita en estos Términos
          y Condiciones, Krear 3D no será responsable de cualquier falta de
          cumplimiento o retraso debido a causas fuera del control razonable de
          Krear 3D, entre otras, un acto de guerra o insurrección civil,
          emergencias nacionales, casos fortuitos, incendios, explosiones,
          vandalismo, tormentas, terremotos, inundaciones, embargos, revueltas,
          sabotajes, huelgas de la industria, bloqueos, huelgas u otras
          dificultades laborales, falta de suministros en toda la industria,
          falta de disponibilidad de materiales, epidemia y/o pandemia, derechos
          de paso u actos gubernamentales; disponiéndose, sin embargo, que Krear
          3D utilizará todos sus recursos comercialmente razonables para
          corregir de inmediato dicho incumplimiento o retraso, en la medida
          consistente con las leyes y requisitos normativos aplicables y
          adecuados en vista de las circunstancias existentes.
        </p>
        <h2>13. Uso Prohibido</h2>
        <p>
          Está estrictamente prohibido el uso de este sitio web con fines
          ilegales u objetables. El Socio acuerda que no utilizará este sitio
          web para participar en actividades que pudieran ser consideradas
          ilegales, peligrosas para terceros o que generen responsabilidades
          civiles. Dichas actividades incluyen, entre otras: (i) actividades que
          involucren la transmisión de información ilícita, amenazante,
          acosadora, obscena, explícita sexualmente, pornográfica, difamatoria o
          calumniante; (ii) actividades que involucren la transmisión de correo
          basura o correo electrónico masivo no solicitado; (iii) actividades
          que involucren la difusión o el uso de virus; (iv) actividades que
          violen leyes, normas o estatutos; y/o (v) actividades que infrinjan
          cualquier derecho de propiedad protegido legalmente, etc. Mediante el
          uso de este Sitio, el Socio acuerda que toda la información
          transmitida hacia el mismo o mediante el uso de este sitio no puede ni
          deberá ser considerada confidencial o de propiedad exclusiva. Krear 3D
          se reserva el derecho de controlar las transmisiones y de investigar
          todo presunto uso prohibido de este sitio web y de revelar toda la
          información relacionada con dicho uso prohibido. Krear 3D, sus
          ejecutivos, directores, empresas afiliadas, empleados, agentes,
          socios, subsidiarias y/o contratistas no asumirán, y renuncian
          expresamente, a cualquier responsabilidad que surgiera en relación con
          el uso prohibido o ilegal que una persona hiciera de este sitio web.
          Toda violación de esta o cualquier otra sección aquí contenida puede
          resultar en la cancelación del servicio y/o de cualquier otra acción
          que Krear 3D considere apropiada de acuerdo con las circunstancias.
        </p>
        <h2>14. Leyes Aplicables y Jurisdicción</h2>
        <p>
          Los Términos y Condiciones y su interpretación se regirán por las
          leyes de la República Peruana. Cualquier disputa que surja de o en
          relación con estos Términos y Condiciones se someterá a la
          jurisdicción de los tribunales de Perú.
        </p>
      </div>
      <div class="ef"></div>
      <p class="open">VER MÁS<img src="https://pruebas.tiendakrear3d.com/wp-content/uploads/2024/05/down.png" alt=""></p>
</section>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const openBtn = document.querySelector(".open");
    const docDiv = document.querySelector(".doc");
    const efDiv = document.querySelector(".ef");
  
    openBtn.addEventListener("click", function() {
      docDiv.classList.toggle("expanded");
      efDiv.style.display = docDiv.classList.contains("expanded") ? "none" : "block";
  
      if (docDiv.classList.contains("expanded")) {
        openBtn.innerHTML = "VER MENOS <img src='https://pruebas.tiendakrear3d.com/wp-content/uploads/2024/05/up.png' alt=''>";
      } else {
        openBtn.innerHTML = "VER MÁS <img src='https://pruebas.tiendakrear3d.com/wp-content/uploads/2024/05/down.png' alt=''>";
      }
    });
  });
</script>
</div>
