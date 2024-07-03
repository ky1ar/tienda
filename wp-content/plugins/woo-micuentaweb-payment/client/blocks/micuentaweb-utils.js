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
import { getSetting } from '@woocommerce/settings';

/**
 * Micuentaweb data comes form the server passed on a global object.
 */

export const getMicuentawebServerData = (name) => {
    const micuentawebServerData = getSetting( name + '_data', null );

    if (! micuentawebServerData) {
        throw new Error( 'Micuentaweb initialization data for ' + name + ' submodule is not available' );
    } else if (micuentawebServerData == name + 'disabled') {
        return;
    }

    return micuentawebServerData;
};
