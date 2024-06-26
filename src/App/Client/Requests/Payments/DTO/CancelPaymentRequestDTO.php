<?php
/**
 * Description of RefundPaymentRequestDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client\Requests\Payments\DTO;

use Dots\Data\DTO;
use Dots\RozetkaPay\App\Client\Resources\Consts\CurrencyCode;

class CancelPaymentRequestDTO extends DTO
{
    protected string $external_id;

    protected ?float $amount;

    protected ?CurrencyCode $currency;

    protected ?string $callback_url;

    protected ?string $payload;

    public function getExternalId(): string
    {
        return $this->external_id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function getCurrency(): ?CurrencyCode
    {
        return $this->currency;
    }

    public function getCallbackUrl(): ?string
    {
        return $this->callback_url;
    }

    public function getPayload(): ?string
    {
        return $this->payload;
    }
}
