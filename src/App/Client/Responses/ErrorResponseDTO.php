<?php
/**
 * Description of ErrorResponseDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client\Responses;

class ErrorResponseDTO extends RozetkaPayResponseDTO
{
    protected string $code;

    protected string $message;

    protected ?string $param;

    protected ?string $payment_id;

    protected ?string $type;

    protected ?string $error_id;

    public function getCode(): string
    {
        return $this->code;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getParam(): ?string
    {
        return $this->param;
    }

    public function getPaymentId(): ?string
    {
        return $this->payment_id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getErrorId(): ?string
    {
        return $this->error_id;
    }
}
