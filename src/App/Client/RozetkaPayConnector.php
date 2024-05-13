<?php
/**
 * Description of RozetkaPayConnector.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client;

use Dots\RozetkaPay\App\Client\Auth\DTO\RozetkaPayAuthDTO;
use Dots\RozetkaPay\App\Client\Auth\RozetkaPayAuthenticator;
use Dots\RozetkaPay\App\Client\Exceptions\RozetkaPayException;
use Dots\RozetkaPay\App\Client\Requests\Payments\CancelPaymentRequest;
use Dots\RozetkaPay\App\Client\Requests\Payments\ConfirmPaymentRequest;
use Dots\RozetkaPay\App\Client\Requests\Payments\CreatePaymentRequest;
use Dots\RozetkaPay\App\Client\Requests\Payments\DTO\CancelPaymentRequestDTO;
use Dots\RozetkaPay\App\Client\Requests\Payments\DTO\ConfirmPaymentRequestDTO;
use Dots\RozetkaPay\App\Client\Requests\Payments\DTO\CreatePaymentRequestDTO;
use Dots\RozetkaPay\App\Client\Requests\Payments\DTO\PaymentInfoRequestDTO;
use Dots\RozetkaPay\App\Client\Requests\Payments\DTO\ResendPaymentCallbackRequestDTO;
use Dots\RozetkaPay\App\Client\Requests\Payments\PaymentInfoRequest;
use Dots\RozetkaPay\App\Client\Requests\Payments\ResendPaymentCallbackRequest;
use Dots\RozetkaPay\App\Client\Resources\Payment;
use Dots\RozetkaPay\App\Client\Resources\PaymentInfo;
use Dots\RozetkaPay\App\Client\Responses\ErrorResponseDTO;
use RuntimeException;
use Saloon\Http\Connector;
use Saloon\Http\Response;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Throwable;

class RozetkaPayConnector extends Connector
{
    use AlwaysThrowOnErrors;

    public function __construct(
        private readonly RozetkaPayAuthDTO $authDto,
    ) {
    }

    /**
     * @throws RozetkaPayException
     */
    public function createPayment(CreatePaymentRequestDTO $dto): Payment
    {
        $this->authenticateRequests();

        return $this->send(new CreatePaymentRequest($dto))->dto();
    }

    /**
     * @throws RozetkaPayException
     */
    public function confirmPayment(ConfirmPaymentRequestDTO $dto): Payment
    {
        $this->authenticateRequests();

        return $this->send(new ConfirmPaymentRequest($dto))->dto();
    }

    /**
     * @throws RozetkaPayException
     */
    public function cancelPayment(CancelPaymentRequestDTO $dto): Payment
    {
        $this->authenticateRequests();

        return $this->send(new CancelPaymentRequest($dto))->dto();
    }

    /**
     * @throws RozetkaPayException
     */
    public function resendPaymentCallback(ResendPaymentCallbackRequestDTO $dto): void
    {
        $this->authenticateRequests();

        $this->send(new ResendPaymentCallbackRequest($dto));
    }

    /**
     * @throws RozetkaPayException
     */
    public function paymentInfo(PaymentInfoRequestDTO $dto): PaymentInfo
    {
        $this->authenticateRequests();

        return $this->send(new PaymentInfoRequest($dto))->dto();
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    public function resolveBaseUrl(): string
    {
        $host = config('rozetka-pay.host');
        if (! is_string($host)) {
            throw new RuntimeException('Invalid Rozetka Pay host');
        }

        return $host;
    }

    private function authenticateRequests(): void
    {
        $this->authenticate(
            RozetkaPayAuthenticator::fromAuthDTO($this->authDto),
        );
    }

    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        $errorResponse = ErrorResponseDTO::fromResponse($response);

        return new RozetkaPayException($errorResponse);
    }
}
