<?php
/**
 * Description of PaymentInfoRequest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client\Requests\Payments;

use Dots\RozetkaPay\App\Client\Requests\Payments\DTO\PaymentInfoRequestDTO;
use Dots\RozetkaPay\App\Client\Requests\PostRozetkaPayRequest;
use Dots\RozetkaPay\App\Client\Resources\PaymentInfo;
use Saloon\Http\Response;

class PaymentInfoRequest extends PostRozetkaPayRequest
{
    public const ENDPOINT = '/api/payments/v1/info';

    public function __construct(
        private readonly PaymentInfoRequestDTO $dto,
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

    public function createDtoFromResponse(Response $response): PaymentInfo
    {
        return PaymentInfo::fromArray($response->json());
    }
}
