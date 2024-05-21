<?php
/**
 * Description of PaymentDetails.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client\Resources;

use Dots\Data\DTO;
use Dots\RozetkaPay\App\Client\Resources\Consts\CurrencyCode;
use Dots\RozetkaPay\App\Client\Resources\Consts\PaymentMethod;
use Dots\RozetkaPay\App\Client\Resources\Consts\PaymentStatus;

class PaymentDetails extends DTO
{
    protected float $amount;

    protected ?string $auth_code;

    protected ?string $billing_order_id;

    protected ?string $gateway_order_id;

    protected ?string $payload;

    protected ?string $payment_id;

    protected ?string $processed_at;

    protected ?string $rrn;

    protected ?PaymentStatus $status;

    protected ?string $status_code;

    protected ?string $status_description;

    protected ?string $transaction_id;

    protected ?string $terminal_name;

    protected ?string $created_at;

    protected ?CurrencyCode $currency;

    protected ?string $description;

    protected ?PaymentFee $fee;

    protected ?PaymentMethod $method;

    public function isOnHold(): bool
    {
        if (! $this->getMethod()?->isAuth()) {
            return false;
        }

        return $this->getStatus()?->isSuccess() ?? false;
    }

    public function isCaptured(): bool
    {
        if (! $this->getMethod()?->isCapture()) {
            return false;
        }

        return $this->getStatus()?->isSuccess() ?? false;
    }

    public function isStatusFailure(): bool
    {
        return $this->getStatus()?->isFailure() ?? false;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getAuthCode(): ?string
    {
        return $this->auth_code;
    }

    public function getBillingOrderId(): ?string
    {
        return $this->billing_order_id;
    }

    public function getGatewayOrderId(): ?string
    {
        return $this->gateway_order_id;
    }

    public function getPayload(): ?string
    {
        return $this->payload;
    }

    public function getPaymentId(): ?string
    {
        return $this->payment_id;
    }

    public function getProcessedAt(): ?string
    {
        return $this->processed_at;
    }

    public function getRrn(): ?string
    {
        return $this->rrn;
    }

    public function getStatus(): ?PaymentStatus
    {
        return $this->status;
    }

    public function getStatusCode(): ?string
    {
        return $this->status_code;
    }

    public function getStatusDescription(): ?string
    {
        return $this->status_description;
    }

    public function getTransactionId(): ?string
    {
        return $this->transaction_id;
    }

    public function getTerminalName(): ?string
    {
        return $this->terminal_name;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function getCurrency(): ?CurrencyCode
    {
        return $this->currency;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getFee(): ?PaymentFee
    {
        return $this->fee;
    }

    public function getMethod(): ?PaymentMethod
    {
        return $this->method;
    }
}
