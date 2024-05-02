<?php
/**
 * Description of CreatePaymentRequest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client\Requests\Payments;

use Dots\RozetkaPay\App\Client\Requests\Payments\DTO\CreatePaymentRequestDTO;
use Dots\RozetkaPay\App\Client\Requests\PostRozetkaPayRequest;
use Dots\RozetkaPay\App\Client\Resources\Payment;
use Dots\RozetkaPay\App\Client\Responses\Payments\CreatePaymentResponseDTO;
use Saloon\Http\Response;

class CreatePaymentRequest extends PostRozetkaPayRequest
{
    public const ENDPOINT = '/api/payments/v1/new';

    public function __construct(
        private readonly CreatePaymentRequestDTO $dto,
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
