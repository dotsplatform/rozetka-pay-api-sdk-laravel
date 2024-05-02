<?php
/**
 * Description of ResendPaymentCallbackRequest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client\Requests\Payments;

use Dots\RozetkaPay\App\Client\Requests\Payments\DTO\ResendPaymentCallbackRequestDTO;
use Dots\RozetkaPay\App\Client\Requests\PostRozetkaPayRequest;

class ResendPaymentCallbackRequest extends PostRozetkaPayRequest
{
    public const ENDPOINT = '/api/payments/v1/callback/resend';

    public function __construct(
        private readonly ResendPaymentCallbackRequestDTO $dto,
    ) {
    }

    protected function defaultBody(): array
    {
        return $this->dto->toArray();
    }

    public function resolveEndpoint(): string
    {
        return self::ENDPOINT;
    }
}
