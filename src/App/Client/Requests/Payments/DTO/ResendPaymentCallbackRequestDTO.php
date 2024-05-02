<?php
/**
 * Description of ResendPaymentCallbackDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client\Requests\Payments\DTO;

use Dots\Data\DTO;
use Dots\RozetkaPay\App\Client\Resources\Consts\PaymentOperation;

class ResendPaymentCallbackRequestDTO extends DTO
{
    protected string $external_id;

    protected PaymentOperation $operation;

    public function getExternalId(): string
    {
        return $this->external_id;
    }

    public function getOperation(): PaymentOperation
    {
        return $this->operation;
    }
}
