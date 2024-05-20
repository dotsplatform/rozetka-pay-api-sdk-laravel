<?php
/**
 * Description of PaymentInfo.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client\Resources;

use Dots\Data\Entity;

class Payment extends Entity
{
    protected string $id;

    protected string $external_id;

    protected bool $is_success;

    protected ?PaymentDetails $details;

    protected ?PaymentAction $action;

    protected bool $action_required;

    protected ?float $amount;

    protected ?array $payment_method;

    protected ?string $receipt_url;

    protected ?string $operation;

    public function getId(): string
    {
        return $this->id;
    }

    public function getExternalId(): string
    {
        return $this->external_id;
    }

    public function isIsSuccess(): bool
    {
        return $this->is_success;
    }

    public function getDetails(): ?PaymentDetails
    {
        return $this->details;
    }

    public function getAction(): ?PaymentAction
    {
        return $this->action;
    }

    public function isActionRequired(): bool
    {
        return $this->action_required;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function getPaymentMethod(): ?array
    {
        return $this->payment_method;
    }

    public function getReceiptUrl(): ?string
    {
        return $this->receipt_url;
    }

    public function getOperation(): ?string
    {
        return $this->operation;
    }
}
