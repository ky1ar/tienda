var e = jQuery.noConflict();
var product_comparar = localStorage.getItem('products-comparar');
if (!product_comparar) {
    localStorage.setItem('products-comparar', JSON.stringify([]));
}
product_comparar = JSON.parse(localStorage.getItem('products-comparar'));
if (product_comparar.length > 0) {
    getProductCompare(product_comparar)
}
validarExisteProductoComparar()
e('.button-comparar').click(function(event) {
    var _this = $(this),
        producCompararButton = _this.attr('data-product'),
        countLocalStoreProductsCompare = product_comparar.length
    product_comparar = JSON.parse(localStorage.getItem('products-comparar'));
    if (!producCompararButton) return
    if (countLocalStoreProductsCompare > 3) {
        iziToast.show({
            class: 'toast-vm',
            pauseOnHover: false,
            close: false,
            progressBar: false,
            title: 'Información',
            message: 'Solo puedes agregar 4 items a comparar'
        });
        return
    }
    let temArray = product_comparar
    if (temArray.includes(Number(producCompararButton))) {
        iziToast.show({
            class: 'toast-vm',
            pauseOnHover: false,
            close: false,
            progressBar: false,
            title: 'Información',
            message: 'Este producto ya esta en la lista de comparación'
        });
        return
    }
    temArray.push(Number(producCompararButton))
    localStorage.setItem('products-comparar', JSON.stringify(temArray));
    product_comparar = JSON.parse(localStorage.getItem('products-comparar'));
    validarExisteProductoComparar()
    getProductCompare(product_comparar)
});
e('#restart_compare').click(function(event) {
    localStorage.setItem('products-comparar', JSON.stringify([]));
    product_comparar = JSON.parse(localStorage.getItem('products-comparar'));
    validarExisteProductoComparar()
    getProductCompare(product_comparar)
});
e('#go_compare').click(function(event) {
    product_comparar = JSON.parse(localStorage.getItem('products-comparar'));
    document.location.href = ajax_option.home_url + '/compare/?items=' + product_comparar.join(',');
});

e('#k11-mvl-btn, #k11-mvl-cls, #k11-ovr-mnu').click(function(event) {
    e('#k11-mvl-blc').toggleClass('k11-ovr-shw');
    e('#k11-ovr-mnu').toggleClass('k11-ovr-shw');
});

e('#header--search').click(function(event) {
    $('.search--campo').toggleClass('show');
    e('.overlay--general').toggleClass('show');
});

e('#k11-log-btn, #k11-reg-btn').click(function(event) {
   e('#k11-log-frm').toggleClass('k11-frm-shw');
   e('#k11-reg-frm').toggleClass('k11-frm-shw');
});

/*$('#k11-log-btn').click(function(event) {
	event.preventDefault();
	if ( $('#k11-log-frm').hasClass('k11-frm-shw') ) {
		$('#k11-log-btn').addClass('k11-btn-shw');
		$('#k11-reg-btn').removeClass('k11-btn-shw');
		
		$('#k11-log-frm').removeClass('k11-frm-shw');
		$('#k11-reg-frm').addClass('k11-frm-shw');
	}
});	
$('#k11-reg-btn').click(function(event) {
	event.preventDefault();
	if ( $('#k11-reg-frm').hasClass('k11-frm-shw') ) {
		$('#k11-reg-btn').addClass('k11-btn-shw');
		$('#k11-log-btn').removeClass('k11-btn-shw');
		
		$('#k11-reg-frm').removeClass('k11-frm-shw');
		$('#k11-log-frm').addClass('k11-frm-shw');
	}
});	
		*/				
$('.overlay--general').click(function(event) {
    $(this).removeClass('show')
    $('.search--campo').removeClass('show')
});
jQuery(document).ready(function($) {
	
	$('#k11-fbx-thr').click(function( event ) {
		event.preventDefault();
		$(this).toggleClass('fbx-thr-act'); 
		var pro = $( '#k11-fbx-thr' ).attr( "data-pro" ); 
		var srv = $( '#k11-fbx-thr' ).attr( "data-srv" ); 
		$(this).hasClass('fbx-thr-act') ? actSrv( pro, srv ) : dactSrv( pro );
	});
	var k11_url = '/productos/impresoras3d/?add-to-cart=';
	function actSrv( pro, srv ){
		$( '#k11-btn-add' ).attr( "href", k11_url + pro + ',' + srv );
	}
	function dactSrv( pro ){
		$( '#k11-btn-add' ).attr( "href", k11_url + pro );
	} 
	
    e('#form-login-s').submit(function(event) {
        event.preventDefault();
        let form_login = e(this)
        checkFormValidity(form_login)
        toggle_attr(form_login.find('.form-control'), 'readonly', 'true')
        vm_toggle_loading();
        if (isFormValid) {
            let data = getFormData(form_login)
            data['action'] = 'ajaxlogin'
            $.ajax({
                url: ajax_option.ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function(data) {
                    if (data.loggedin == true) {
                        document.location.href = data.redirect;
                    } else {
                        iziToast.show({
                            class: 'toast-vm',
                            pauseOnHover: false,
                            close: false,
                            progressBar: false,
                            title: 'Error',
                            message: data.message
                        });
                        vm_toggle_loading()
                        toggle_attr(form_login.find('.form-control'), 'readonly', 'true')
                    }
                }
            }).fail(function() {
                iziToast.show({
                    class: 'toast-vm',
                    pauseOnHover: false,
                    close: false,
                    progressBar: false,
                    title: 'Error',
                    message: 'Hubo un problema a la hora de logearse'
                });
                vm_toggle_loading()
            })
        } else {
            iziToast.show({
                class: 'toast-vm',
                pauseOnHover: false,
                close: false,
                progressBar: false,
                title: 'Error',
                message: message_valida
            });
            vm_toggle_loading()
            toggle_attr(form_login.find('.form-control'), 'readonly', 'true')
        }
    });
    // Register
    e('#form-register-s').submit(function(event) {
        event.preventDefault();
        checkFormValidity(e(this));
        let form_register = e(this)
        vm_toggle_loading();
        toggle_attr(form_register.find('.form-control'), 'readonly', 'true')
        if (!isFormValid) {
            iziToast.show({
                class: 'toast-vm',
                pauseOnHover: false,
                close: false,
                progressBar: false,
                title: 'Error',
                message: message_valida
            });
            toggle_attr(form_register.find('.form-control'), 'readonly', 'true')
            vm_toggle_loading();
            return false
        }
        compare_pass(form_register)
        if (isFormValid) {
            let data = getFormData(form_register)
            data['action'] = 'ajaxregister'
            var username = data['email'].split('@')
            data['user_login'] = username[0] + randomText('5')
            $.ajax({
                url: ajax_option.ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function(data) {
                    if ((data.user_exist && data.error) || (!data.user_exist && data.error)) {
                        iziToast.error({
                            title: 'Error',
                            message: data.message,
                            close: false,
                            progressBar: false,
                            pauseOnHover: false,
                        });
                        vm_toggle_loading();
                        toggle_attr(form_register.find('.form-control'), 'readonly', 'true')
                    } else if (!data.user_exist && !data.error) {
                        iziToast.success({
                            title: 'Genial',
                            message: data.message,
                            close: false,
                            progressBar: false,
                            pauseOnHover: false,
                        });
                        document.location.href = data.redirect;
                        vm_toggle_loading();
                        toggle_attr(form_register.find('.form-control'), 'readonly', 'true')
                        clear_input(form_register, '.form-control')
                    }
                }
            }).fail(function() {
                iziToast.error({
                    class: 'toast-vm',
                    pauseOnHover: false,
                    close: false,
                    progressBar: false,
                    title: 'Error',
                    message: 'Hubo un problema a la hora de registrarse'
                });
                vm_toggle_loading();
                toggle_attr(form_register.find('.form-control'), 'readonly', 'true')
            })
        } else {
            iziToast.error({
                class: 'toast-vm',
                pauseOnHover: false,
                close: false,
                progressBar: false,
                title: 'Error',
                message: message_valida
            });
            vm_toggle_loading();
            toggle_attr(form_register.find('.form-control'), 'readonly', 'true')
        }
    });
});

function activeUploadCart(self) {
    e('.fle-cont-b button[name="update_cart"]').removeAttr('disabled');
    e("[name='update_cart']").trigger("click");
}

function checkFormValidity(form) {
    isFormValid = true;
    e(form).find(".validation-input").each(function() {
        var fieldVal = e.trim(e(this).val());
        if (!fieldVal) {
            e(this).addClass('error-validate')
            isFormValid = false;
            message_valida = 'No puedes dejar vacío algunos campos de textos'
        } else {
            e(this).removeClass('error-validate')
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (e(this).attr('name') == 'email') {
                if (!regex.test(fieldVal)) {
                    e(this).addClass('error-validate')
                    isFormValid = false;
                    message_valida = 'Estas ingresando un correo no válido'
                    return false
                }
            }
        }
    });
}

function getProductCompare(array_product) {
    let data = {
        action: 'ajaxproductscompare',
        products_compare: array_product
    }
    $.ajax({
        url: ajax_option.ajaxurl,
        type: 'POST',
        data: data,
        success: (response) => {
            if (response.data) {
                e('.rows-comparar').html(response.data.join(''))
                if (response.show_buttons) {
                    e('.producto--buttons--compare').removeClass('d-none')
                } else {
                    e('.producto--buttons--compare').addClass('d-none')
                }
            }
        }
    }).done(function() {}).fail(function() {}).always(function() {});
}

function toggle_attr(_selector, _attr, _value) {
    if (_selector.attr(_attr)) {
        _selector.removeAttr(_attr);
    } else {
        _selector.attr(_attr, _value);
    }
}

function vm_toggle_loading() {
    e('.loading-effect').toggleClass('show');
}

function getFormData(_form) {
    var unindexed_array = _form.serializeArray();
    var indexed_array = {};
    $.map(unindexed_array, function(n, i) {
        indexed_array[n['name']] = n['value'];
    });
    return indexed_array;
}

function compare_pass(_form) {
    if (e(_form).find('#password-register').val() == e(_form).find('#password-register-repeat').val()) {
        if (e(_form).find('#password-register').val().length <= 6) {
            isFormValid = false
            message_valida = 'Por favor ingresa un contraseña mayor a 6'
            e(_form).find('#password-register-repeat').addClass('error-validate')
            e(_form).find('#password-register').addClass('error-validate')
            return false
        } else {
            isFormValid = true
            e(_form).find('#password-register-repeat').removeClass('error-validate')
            e(_form).find('#password-register').removeClass('error-validate')
        }
    } else {
        isFormValid = false
        message_valida = 'Las contraseñas no coinciden'
        e(_form).find('#password-register-repeat').addClass('error-validate')
        return false
    }
}

function validarExisteProductoComparar() {
    product_comparar = JSON.parse(localStorage.getItem('products-comparar'));
    if (product_comparar.length == 0 || product_comparar.length == 1) {
        $('.comparar-section #go_compare').addClass('disabled')
    } else if (product_comparar.length > 1) {
        $('.comparar-section #go_compare').removeClass('disabled')
    }
    console.log(product_comparar.length)
}

function randomText(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}