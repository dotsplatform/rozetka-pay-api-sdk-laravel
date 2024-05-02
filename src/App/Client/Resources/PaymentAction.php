<?php
/**
 * Description of PaymentActionDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client\Resources;

use Dots\Data\DTO;
use Dots\RozetkaPay\App\Client\Resources\Consts\PaymentActionType;

class PaymentAction extends DTO
{
    protected PaymentActionType $type;

    protected string $value;

    public function getType(): PaymentActionType
    {
        return $this->type;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
