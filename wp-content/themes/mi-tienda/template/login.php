<?php
/**
 * Template Name: Login
 * Login Template.
 *
 */
get_header('other');?>
<?php defined('ABSPATH') || exit;?>
<div id="k11-acc-log" class="kyr-o11-wrp">
    <div class="cont-main no-border formulario--custom">
        <div class="">

            <ul class="uk-subnav uk-subnav-pill justify-content-center row-tabs-alig-tabs" uk-switcher="animation: uk-animation-slide-right-medium, uk-animation-slide-left-medium">
                <li><a href="#" id="k11-log-btn" class="k11-btn-shw">Iniciar sesión</a></li>
                <li><a href="#" id="k11-reg-btn">Registrar</a></li>
            </ul>

            <ul class="uk-switcher uk-margin row-col-login">
                <li id="k11-log-frm">
                    <div class="col-12 col-md-6 m-auto">
                        <form class="form-login-lco form-general" id="form-login-s">
                            <div class="form-group ">
                                <label class="has-float-label">
                                     <span>
                                            Correo
                                        </span>
                                    <input autofocus="" class="form-control validation-input line-g alter" id="mail-login" name="email" placeholder=" " type="email">

                                    </input>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="has-float-label">
                                     <span>
                                            Contraseña
                                        </span>
                                    <input class="form-control validation-input line-g alter" id="password-login" name="password" placeholder=" " type="password">
                                       
                                    </input>
                                </label>
                            </div>
                          <div class="button-submit text-center">
                                <button class="btn-back-black m-auto" type="submit">
                                    <span class="span_toggle_s">
                                        Iniciar sesión
                                    </span>
                                   <i class="uil uil-refresh redo-animate d-none"></i>
                                </button>

                           </div>
                            <div class="button-submit text-center mt-5">
                                <a href="<?php echo home_url('wp-login.php?action=lostpassword'); ?>" class="btn btn-primary btn-line black">
                                    <span class="span_toggle_s">
                                        ¿Olvidaste tu contraseña?
                                    </span>
                                </a>
                            </div>
                           <?php wp_nonce_field('ajax-login-nonce', 'security');?>
                        </form>
                    </div>
                </li>
                <li id="k11-reg-frm" class="k11-frm-shw">
                    <div class="col-12 col-md-6 m-auto">

                        <form class="form-register-lco form-general mt-3" id="form-register-s">
                            <div class="form-group ">
                                <label class="has-float-label">
                                     <span>
                                            Nombre
                                        </span>
                                    <input class="form-control  validation-input line-g alter" autofocus="" id="name-register" name="name_user" placeholder=" " type="text">
                                       
                                    </input>
                                </label>
                            </div>
                            <div class="form-group ">
                                <label class="has-float-label">
                                    <span>
                                            Apellidos
                                        </span>
                                    <input class="form-control  validation-input line-g alter" id="last_name-register" name="last_name_user" placeholder=" " type="text">
                                        
                                    </input>
                                </label>
                            </div>
                            <div class="form-group ">
                                <label class="has-float-label">
                                    <span>
                                            Correo
                                        </span>
                                    <input class="form-control  validation-input line-g alter" id="mail-register" name="email" placeholder=" " type="email">
                                        
                                    </input>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="has-float-label">
                                    <span>
                                            Contraseña
                                        </span>
                                    <input class="form-control  validation-input line-g alter" id="password-register" name="password" placeholder=" " type="password">
                                        
                                    </input>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="has-float-label">
                                    <span>
                                            Repetir contraseña
                                        </span>
                                    <input class="form-control  validation-input line-g alter" id="password-register-repeat" name="repeat_password" placeholder="Repetir  " type="password" >
                                        
                                    </input>
                                </label>
                            </div>
                            <div class="button-submit text-center">
                                <button class="btn-back-black m-auto" type="submit">
                                    <span class="span_toggle_s">
                                        Registrarme
                                    </span>
                                </button>

                           </div>
                            <?php wp_nonce_field('ajax-register-nonce', 'security_register');?>
                        </form>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</div>

<?php get_footer();?>
