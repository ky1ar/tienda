/**
 * Copyright © Lyra Network and contributors.
 * This file is part of Izipay plugin for WooCommerce. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @author    Geoffrey Crofte, Alsacréations (https://www.alsacreations.fr/)
 * @copyright Lyra Network and contributors
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */

/**
 * REST API JS tools.
 */

jQuery(function() {
    setTimeout(function() {
        jQuery('.kr-payment-button').click(function(e) {
            jQuery('.kr-form-error').html('');
        });
    }, 0);
});

var MICUENTAWEB_DFAULT_MESSAGES = ['CLIENT_300', 'CLIENT_304', 'CLIENT_502', 'PSP_539']; // Use default messages for these errors.
var MICUENTAWEB_EXPIRY_ERRORS = ['PSP_108', 'PSP_136', 'PSP_649'];

var micuentawebInitRestEvents = function(KR) {
    KR.onError(function(e) {
        jQuery('#micuentawebstd_rest_processing').css('display', 'none');
        jQuery('form.checkout').removeClass('processing').unblock();
        jQuery('#order_review').unblock();

        var msg = '';
        if (MICUENTAWEB_DFAULT_MESSAGES.indexOf(e.errorCode) > -1) {
            msg = e.errorMessage;
            var endsWithDot = (msg.lastIndexOf('.') == (msg.length - 1) && msg.lastIndexOf('.') >= 0);

            msg += (endsWithDot ? '' : '.');
        } else {
            msg = micuentawebTranslate(e.errorCode);
        }

        // Expiration errors, display a link to refresh the page.
        if (MICUENTAWEB_EXPIRY_ERRORS.indexOf(e.errorCode) >= 0) {
            msg += ' <a href="#" onclick="window.location.reload(); return false;">'
                + micuentawebTranslate('RELOAD_LINK') + '</a>';
        }

        jQuery('.kr-form-error').html('<span style="color: red;"><span>' + msg + '</span></span>');
        jQuery('ul.micuentawebstd-view-bottom').show();
    });

    KR.onFocus(function(e) {
        jQuery('.kr-form-error').html('');
    });
};

// Translate error message.
var micuentawebTranslate = function(code) {
    var lang = MICUENTAWEB_LANGUAGE; // Global variable that contains current language.
    var messages = MICUENTAWEB_ERROR_MESSAGES.hasOwnProperty(lang) ? MICUENTAWEB_ERROR_MESSAGES[lang] : MICUENTAWEB_ERROR_MESSAGES['en'];

    if (! messages.hasOwnProperty(code)) {
        var index = code.lastIndexOf('_');
        code = code.substring(0, index + 1) + '999';
    }

    return messages[code];
};

var MICUENTAWEB_ERROR_MESSAGES = {
    fr: {
        RELOAD_LINK: 'Veuillez rafraîchir la page.',
        CLIENT_001: 'Le paiement est refusé. Essayez de payer avec une autre carte.',
        CLIENT_101: 'Le paiement est annulé.',
        CLIENT_301: 'Le numéro de carte est invalide. Vérifiez le numéro et essayez à nouveau.',
        CLIENT_302: 'La date d\'expiration est invalide. Vérifiez la date et essayez à nouveau.',
        CLIENT_303: 'Le code de sécurité CVV est invalide. Vérifiez le code et essayez à nouveau.',
        CLIENT_999: 'Une erreur technique est survenue. Merci de réessayer plus tard.',

        INT_999: 'Une erreur technique est survenue. Merci de réessayer plus tard.',

        PSP_003: 'Le paiement est refusé. Essayez de payer avec une autre carte.',
        PSP_099: 'Trop de tentatives ont été effectuées. Merci de réessayer plus tard.',
        PSP_108: 'Le formulaire a expiré.',
        PSP_999: 'Une erreur est survenue durant le processus de paiement.',

        ACQ_001: 'Le paiement est refusé. Essayez de payer avec une autre carte.',
        ACQ_999: 'Une erreur est survenue durant le processus de paiement.'
    },

    en: {
        RELOAD_LINK: 'Please refresh the page.',
        CLIENT_001: 'Payment is refused. Try to pay with another card.',
        CLIENT_101: 'Payment is cancelled.',
        CLIENT_301: 'The card number is invalid. Please check the number and try again.',
        CLIENT_302: 'The expiration date is invalid. Please check the date and try again.',
        CLIENT_303: 'The card security code (CVV) is invalid. Please check the code and try again.',
        CLIENT_999: 'A technical error has occurred. Please try again later.',

        INT_999: 'A technical error has occurred. Please try again later.',

        PSP_003: 'Payment is refused. Try to pay with another card.',
        PSP_099: 'Too many attempts. Please try again later.',
        PSP_108: 'The form has expired.',
        PSP_999: 'An error has occurred during the payment process.',

        ACQ_001: 'Payment is refused. Try to pay with another card.',
        ACQ_999: 'An error has occurred during the payment process.'
    },

    de: {
        RELOAD_LINK: 'Bitte aktualisieren Sie die Seite.',
        CLIENT_001: 'Die Zahlung wird abgelehnt. Versuchen Sie, mit einer anderen Karte zu bezahlen.',
        CLIENT_101: 'Die Zahlung wird storniert.',
        CLIENT_301: 'Die Kartennummer ist ungültig. Bitte überprüfen Sie die Nummer und versuchen Sie es erneut.',
        CLIENT_302: 'Das Verfallsdatum ist ungültig. Bitte überprüfen Sie das Datum und versuchen Sie es erneut.',
        CLIENT_303: 'Der Kartenprüfnummer (CVC) ist ungültig. Bitte überprüfen Sie den Nummer und versuchen Sie es erneut.',
        CLIENT_999: 'Ein technischer Fehler ist aufgetreten. Bitte Versuchen Sie es später erneut.',

        INT_999: 'Ein technischer Fehler ist aufgetreten. Bitte Versuchen Sie es später erneut.',

        PSP_003: 'Die Zahlung wird abgelehnt. Versuchen Sie, mit einer anderen Karte zu bezahlen.',
        PSP_099: 'Zu viele Versuche. Bitte Versuchen Sie es später erneut.',
        PSP_108: 'Das Formular ist abgelaufen.',
        PSP_999: 'Ein Fehler ist während dem Zahlungsvorgang unterlaufen.',

        ACQ_001: 'Die Zahlung wird abgelehnt. Versuchen Sie, mit einer anderen Karte zu bezahlen.',
        ACQ_999: 'Ein Fehler ist während dem Zahlungsvorgang unterlaufen.'
    },

    es: {
        RELOAD_LINK: 'Por favor, actualice la página.',
        CLIENT_001: 'El pago es rechazado. Intenta pagar con otra tarjeta.',
        CLIENT_101: 'Se cancela el pago.',
        CLIENT_301: 'El número de tarjeta no es válido. Por favor, compruebe el número y vuelva a intentarlo.',
        CLIENT_302: 'La fecha de caducidad no es válida. Por favor, compruebe la fecha y vuelva a intentarlo.',
        CLIENT_303: 'El código de seguridad de la tarjeta (CVV) no es válido. Por favor revise el código y vuelva a intentarlo.',
        CLIENT_999: 'Ha ocurrido un error técnico. Por favor, inténtelo de nuevo más tarde.',

        INT_999: 'Ha ocurrido un error técnico. Por favor, inténtelo de nuevo más tarde.',

        PSP_003: 'El pago es rechazado. Intenta pagar con otra tarjeta.',
        PSP_099: 'Demasiados intentos. Por favor, inténtelo de nuevo más tarde.',
        PSP_108: 'El formulario ha expirado.',
        PSP_999: 'Ocurrió un error en el proceso de pago.',

        ACQ_001: 'El pago es rechazado. Intenta pagar con otra tarjeta.',
        ACQ_999: 'Ocurrió un error en el proceso de pago.'
    },

    pt: {
        RELOAD_LINK: 'Por favor, atualize a página.',
        CLIENT_001: 'O pagamento é rejeitado. Tente pagar com outro cartão.',
        CLIENT_101: 'O pagamento é cancelado.',
        CLIENT_301: 'O número do cartão é inválido. Por favor, cheque o número e tente novamente.',
        CLIENT_302: 'A data de expiração é inválida. Verifique a data e tente novamente.',
        CLIENT_303: 'O código de segurança do cartão (CVV) é inválido. Verifique o código e tente novamente.',
        CLIENT_999: 'Ocorreu um erro técnico. Por favor, tente novamente mais tarde.',

        INT_999: 'Ocorreu um erro técnico. Por favor, tente novamente mais tarde.',

        PSP_003: 'O pagamento é rejeitado. Tente pagar com outro cartão.',
        PSP_099: 'Muitas tentativas. Por favor, tente novamente mais tarde.',
        PSP_108: 'O formulário expirou.',
        PSP_999: 'Ocorreu um erro no processo de pagamento.',

        ACQ_001: 'O pagamento é rejeitado. Tente pagar com outro cartão.',
        ACQ_999: 'Ocorreu um erro no processo de pagamento.'
    }
};