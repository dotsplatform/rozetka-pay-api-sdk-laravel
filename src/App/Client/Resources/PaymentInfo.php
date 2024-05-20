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
    protected string $id;

    protected string $external_id;

    protected float $amount;

    protected float $amount_confirmed = 0;

    protected float $amount_canceled = 0;

    protected float $amount_refunded = 0;

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

    public function getActualAmount(): float
    {
        if ($this->isConfirmed()) {
            return $this->getAmountConfirmed();
        } elseif ($this->isCanceled()) {
            return $this->getAmountCanceled();
        } elseif ($this->isRefunded()) {
            return $this->getAmountRefunded();
        } else {
            return $this->getAmount();
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getExternalId(): string
    {
        return $this->external_id;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getAmountConfirmed(): float
    {
        return $this->amount_confirmed;
    }

    public function getAmountCanceled(): float
    {
        return $this->amount_canceled;
    }

    public function getAmountRefunded(): float
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
