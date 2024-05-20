<?php
/**
 * Description of CurrencyCode.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client\Resources\Consts;

enum CurrencyCode: string
{
    case USD = 'USD';
    case EUR = 'EUR';
    case UAH = 'UAH';
}
