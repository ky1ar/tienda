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
 * External dependencies.
 */
import { registerPaymentMethod } from '@woocommerce/blocks-registry';

/**
 * Internal dependencies
 */
import { getMicuentawebServerData } from './micuentaweb-utils';

const PAYMENT_METHOD_NAME = 'micuentawebstd';
var micuentaweb_data = getMicuentawebServerData(PAYMENT_METHOD_NAME);

const Content = () => {
    return (micuentaweb_data?.description);
};

const Label = () => {
    const styles = {
        divWidth: {
            width: '95%'
        },
        imgFloat: {
            float: 'right'
        }
    }

    return (
        <div style={ styles.divWidth }>
            <span>{ micuentaweb_data?.title}</span>
            <img
                style={ styles.imgFloat }
                src={ micuentaweb_data?.logo_url }
                alt={ micuentaweb_data?.title }
            />
        </div>
    );
};

registerPaymentMethod( {
    name: PAYMENT_METHOD_NAME,
    label: <Label />,
    ariaLabel: 'Micuentaweb payment method',
    canMakePayment: () => true,
    content: <Content />,
    edit: <Content />,
    supports: {
        features: micuentaweb_data?.supports ?? [],
    },
} );
