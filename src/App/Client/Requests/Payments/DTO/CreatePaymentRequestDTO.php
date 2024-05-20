<?php
/**
 * Description of CreatePaymentDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client\Requests\Payments\DTO;

use Dots\Data\DTO;
use Dots\RozetkaPay\App\Client\Resources\Consts\CurrencyCode;
use Dots\RozetkaPay\App\Client\Resources\Consts\PaymentMode;
use Dots\RozetkaPay\App\Client\Resources\Customers\Customer;

class CreatePaymentRequestDTO extends DTO
{
    protected float $amount;

    protected CurrencyCode $currency;

    protected string $external_id;

    protected PaymentMode $mode;

    protected ?string $callback_url;

    protected ?string $result_url;

    protected bool $confirm;

    protected ?string $description;

    protected ?string $payload;

    protected ?Customer $customer;

    protected ?array $products;

    protected ?array $recipient;

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): CurrencyCode
    {
        return $this->currency;
    }

    public function getExternalId(): string
    {
        return $this->external_id;
    }

    public function getMode(): PaymentMode
    {
        return $this->mode;
    }

    public function getCallbackUrl(): ?string
    {
        return $this->callback_url;
    }

    public function getResultUrl(): ?string
    {
        return $this->result_url;
    }

    public function isConfirm(): bool
    {
        return $this->confirm;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPayload(): ?string
    {
        return $this->payload;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function getProducts(): ?array
    {
        return $this->products;
    }

    public function getRecipient(): ?array
    {
        return $this->recipient;
    }
}
