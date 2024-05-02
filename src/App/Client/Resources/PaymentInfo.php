<?php
/**
 * Description of PaymentInfo.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client\Resources;

use Dots\Data\DTO;
use Dots\RozetkaPay\App\Client\Resources\Customers\Customer;

class PaymentInfo extends DTO
{
    protected int $id;

    protected string $external_id;

    protected int $amount;

    protected int $amount_confirmed = 0;

    protected int $amount_canceled = 0;

    protected int $amount_refunded = 0;

    protected string $currency;

    protected bool $purchased;

    protected PaymentDetailsList $purchase_details;

    protected bool $confirmed;

    protected ?PaymentDetailsList $confirmation_details;

    protected bool $canceled;

    protected ?PaymentDetailsList $cancellation_details;

    protected bool $refunded;

    protected ?PaymentDetailsList $refund_details;

    protected string $receipt_url;

    protected string $created_at;

    protected bool $action_required;

    protected ?PaymentAction $action;

    protected ?Customer $customer;

    public function getId(): int
    {
        return $this->id;
    }

    public function getExternalId(): string
    {
        return $this->external_id;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getAmountConfirmed(): int
    {
        return $this->amount_confirmed;
    }

    public function getAmountCanceled(): int
    {
        return $this->amount_canceled;
    }

    public function getAmountRefunded(): int
    {
        return $this->amount_refunded;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function isPurchased(): bool
    {
        return $this->purchased;
    }

    public function getPurchaseDetails(): PaymentDetailsList
    {
        return $this->purchase_details;
    }

    public function isConfirmed(): bool
    {
        return $this->confirmed;
    }

    public function getConfirmationDetails(): ?PaymentDetailsList
    {
        return $this->confirmation_details;
    }

    public function isCanceled(): bool
    {
        return $this->canceled;
    }

    public function getCancellationDetails(): ?PaymentDetailsList
    {
        return $this->cancellation_details;
    }

    public function isRefunded(): bool
    {
        return $this->refunded;
    }

    public function getRefundDetails(): ?PaymentDetailsList
    {
        return $this->refund_details;
    }

    public function getReceiptUrl(): string
    {
        return $this->receipt_url;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function isActionRequired(): bool
    {
        return $this->action_required;
    }

    public function getAction(): ?PaymentAction
    {
        return $this->action;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }
}
