<?php
/**
 * Description of CreatePaymentCustomerPaymentMethod.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client\Resources\Customers;

use Dots\Data\DTO;
use Dots\RozetkaPay\App\Client\Resources\Consts\PaymentMethodType;

class CustomerPaymentMethod extends DTO
{
    protected ?PaymentMethodType $type;

    public function getType(): ?PaymentMethodType
    {
        return $this->type;
    }
}
