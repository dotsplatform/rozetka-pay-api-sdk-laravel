<?php
/**
 * Description of ConfirmPaymentRequest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client\Requests\Payments;

use Dots\RozetkaPay\App\Client\Requests\Payments\DTO\ConfirmPaymentRequestDTO;
use Dots\RozetkaPay\App\Client\Requests\PostRozetkaPayRequest;
use Dots\RozetkaPay\App\Client\Resources\Payment;
use Saloon\Http\Response;

class ConfirmPaymentRequest extends PostRozetkaPayRequest
{
    public const ENDPOINT = '/api/payments/v1/confirm';

    public function __construct(
        private readonly ConfirmPaymentRequestDTO $dto,
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

    public function createDtoFromResponse(Response $response): Payment
    {
        return Payment::fromArray($response->json());
    }
}
