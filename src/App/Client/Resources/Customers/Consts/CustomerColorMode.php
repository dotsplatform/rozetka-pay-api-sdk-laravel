<?php
/**
 * Description of CreatePaymentCustomerColorMode.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client\Resources\Customers\Consts;

enum CustomerColorMode: string
{
    case LIGHT = 'light';
    case DARK = 'dark';
}
