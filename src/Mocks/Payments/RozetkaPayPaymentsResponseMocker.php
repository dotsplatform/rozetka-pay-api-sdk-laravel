<?php
/**
 * Description of RozetkaPayPaymentsResponseMocker.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\Mocks\Payments;

use Dots\RozetkaPay\App\Client\Requests\Payments\CancelPaymentRequest;
use Dots\RozetkaPay\App\Client\Requests\Payments\ConfirmPaymentRequest;
use Dots\RozetkaPay\App\Client\Requests\Payments\CreatePaymentRequest;
use Dots\RozetkaPay\App\Client\Requests\Payments\PaymentInfoRequest;
use Dots\RozetkaPay\App\Client\Requests\Payments\ResendPaymentCallbackRequest;
use Dots\RozetkaPay\App\Client\Resources\Payment;
use Dots\RozetkaPay\App\Client\Resources\PaymentInfo;
use Dots\RozetkaPay\Mocks\Payments\Generators\RozetkaPayResponseDemoDataGenerator;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

class RozetkaPayPaymentsResponseMocker
{
    public static function mockSuccessCreatePayment(array $data = []): Payment
    {
        $dto = RozetkaPayResponseDemoDataGenerator::generateSuccessCreatePaymentResponse($data);
        MockClient::global([
            CreatePaymentRequest::class => MockResponse::make($dto->toArray()),
        ]);

        return $dto;
    }

    public static function mockSuccessPaymentStatus(array $data = []): PaymentInfo
    {
        $dto = RozetkaPayResponseDemoDataGenerator::generatePaymentInfo($data);
        MockClient::global([
            PaymentInfoRequest::class => MockResponse::make($dto->toArray()),
        ]);

        return $dto;
    }

    public static function mockSuccessResendPaymentWebhook(): void
    {
        MockClient::global([
            ResendPaymentCallbackRequest::class => MockResponse::make(),
        ]);
    }

    public static function mockSuccessConfirm(array $data = []): Payment
    {
        $dto = RozetkaPayResponseDemoDataGenerator::generateCapture($data);
        MockClient::global([
            ConfirmPaymentRequest::class => MockResponse::make($dto->toArray()),
        ]);

        return $dto;
    }

    public static function mockSuccessCancel(array $data = []): Payment
    {
        $dto = RozetkaPayResponseDemoDataGenerator::generateCancel($data);
        MockClient::global([
            CancelPaymentRequest::class => MockResponse::make($dto->toArray()),
        ]);

        return $dto;
    }

    public static function mockFailCreatePayment(array $data = []): array
    {
        $data = RozetkaPayResponseDemoDataGenerator::generateBadRequestResponse($data);
        MockClient::global([
            CreatePaymentRequest::class => MockResponse::make($data, 400),
        ]);

        return $data;
    }

    public static function mockFailConfirmPayment(array $data = []): array
    {
        $data = RozetkaPayResponseDemoDataGenerator::generateBadRequestResponse($data);
        MockClient::global([
            ConfirmPaymentRequest::class => MockResponse::make($data, 400),
        ]);

        return $data;
    }

    public static function mockFailCancelPayment(array $data = []): array
    {
        $data = RozetkaPayResponseDemoDataGenerator::generateBadRequestResponse($data);
        MockClient::global([
            CancelPaymentRequest::class => MockResponse::make($data, 400),
        ]);

        return $data;
    }
}
