<?php
/**
 * Description of RozetkaPayOperationGenerator.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\Mocks\Payments\Generators;

use Dots\RozetkaPay\App\Client\Resources\Consts\CurrencyCode;
use Dots\RozetkaPay\App\Client\Resources\Consts\Locale;
use Dots\RozetkaPay\App\Client\Resources\Consts\PaymentActionType;
use Dots\RozetkaPay\App\Client\Resources\Consts\PaymentMethod;
use Dots\RozetkaPay\App\Client\Resources\Consts\PaymentMethodType;
use Dots\RozetkaPay\App\Client\Resources\Consts\PaymentStatus;
use Dots\RozetkaPay\App\Client\Resources\Customers\Consts\CustomerColorMode;
use Dots\RozetkaPay\App\Client\Resources\Customers\Customer;
use Dots\RozetkaPay\App\Client\Resources\Customers\CustomerPaymentMethod;
use Dots\RozetkaPay\App\Client\Resources\Payment;
use Dots\RozetkaPay\App\Client\Resources\PaymentAction;
use Dots\RozetkaPay\App\Client\Resources\PaymentDetails;
use Dots\RozetkaPay\App\Client\Resources\PaymentFee;
use Dots\RozetkaPay\App\Client\Resources\PaymentInfo;
use Illuminate\Support\Str;

class RozetkaPayResponseDemoDataGenerator
{
    public static function generateBadRequestResponse(array $data = []): array
    {
        return array_merge([
            'code' => 'authorization_failed',
            'message' => 'string',
            'param' => 'string',
            'payment_id' => 'string',
            'type' => 'invalid_request_error',
            'error_id' => 'string',
        ], $data);
    }

    public static function generateSuccessCreatePaymentResponse(array $data = []): Payment
    {
        return self::generateHold($data);
    }

    public static function generatePaymentInfo(array $data = []): PaymentInfo
    {
        $purchaseDetails = self::generatePaymentDetails($data['purchase_details'] ?? []);
        $confirmationDetails = self::generatePaymentDetails($data['confirmation_details'] ?? []);
        $cancelDetails = self::generatePaymentDetails($data['cancel_details'] ?? []);
        $refundDetails = self::generatePaymentDetails($data['refund_details'] ?? []);
        unset(
            $data['purchase_details'],
            $data['confirmation_details'],
            $data['cancel_details'],
            $data['refund_details'],
        );

        return PaymentInfo::fromArray(array_merge([
            'id' => Str::uuid()->toString(),
            'external_id' => Str::uuid()->toString(),
            'amount' => 100.0,
            'amount_confirmed' => 100.0,
            'amount_canceled' => 0,
            'amount_refunded' => 0,
            'currency' => 'UAH',
            'purchased' => true,
            'purchase_details' => $purchaseDetails,
            'confirmed' => true,
            'confirmation_details' => $confirmationDetails,
            'canceled' => false,
            'cancellation_details' => $cancelDetails,
            'refunded' => false,
            'refund_details' => $refundDetails,
            'receipt_url' => Str::uuid()->toString(),
            'created_at' => Str::uuid()->toString(),
            'action_required' => true,
            'action' => PaymentAction::fromArray([
                'type' => PaymentActionType::URL,
                'value' => Str::uuid()->toString(),
            ]),
            'customer' => Customer::fromArray([
                'color_mode' => CustomerColorMode::DARK,
                'locale' => Locale::EN,
                'account_number' => Str::uuid()->toString(),
                'email' => Str::uuid()->toString(),
                'phone' => Str::uuid()->toString(),
                'external_id' => Str::uuid()->toString(),
                'first_name' => Str::uuid()->toString(),
                'last_name' => Str::uuid()->toString(),
                'patronym' => Str::uuid()->toString(),
                'payment_method' => CustomerPaymentMethod::fromArray([
                    'type' => PaymentMethodType::APPLE_PAY,
                ]),
            ]),
        ], $data));
    }

    public static function generateHold(array $data = []): Payment
    {
        return self::generatePayment(detailsData: array_merge([
            'method' => PaymentMethod::AUTH,
            'status' => PaymentStatus::SUCCESS,
        ], $data));
    }

    public static function generateCapture(array $data = []): Payment
    {
        return self::generatePayment(detailsData: array_merge([
            'method' => PaymentMethod::CAPTURE,
            'status' => PaymentStatus::SUCCESS,
        ], $data));
    }

    public static function generateCancel(array $data = []): Payment
    {
        return self::generatePayment(detailsData: array_merge([
            'method' => PaymentMethod::VOID,
            'status' => PaymentStatus::SUCCESS,
        ], $data));
    }

    public static function generatePayment(
        array $data = [],
        array $detailsData = [],
    ): Payment {
        return Payment::fromArray(array_merge([
            'id' => Str::uuid()->toString(),
            'external_id' => Str::uuid()->toString(),
            'is_success' => true,
            'details' => self::generatePaymentDetails($detailsData),
            'action' => PaymentAction::fromArray([
                'type' => PaymentActionType::URL,
                'value' => Str::uuid()->toString(),
            ]),
            'action_required' => true,
            'payment_method' => [],
            'receipt_url' => Str::uuid()->toString(),
            'operation' => Str::uuid()->toString(),
        ], $data));
    }

    public static function generatePaymentDetails(array $data = []): PaymentDetails
    {
        return PaymentDetails::fromArray(array_merge([
            'amount' => 100.0,
            'auth_code' => Str::uuid()->toString(),
            'billing_order_id' => Str::uuid()->toString(),
            'gateway_order_id' => Str::uuid()->toString(),
            'payload' => Str::uuid()->toString(),
            'payment_id' => Str::uuid()->toString(),
            'processed_at' => Str::uuid()->toString(),
            'rrn' => Str::uuid()->toString(),
            'status' => PaymentStatus::SUCCESS,
            'status_code' => Str::uuid()->toString(),
            'status_description' => Str::uuid()->toString(),
            'transaction_id' => Str::uuid()->toString(),
            'terminal_name' => Str::uuid()->toString(),
            'created_at' => Str::uuid()->toString(),
            'currency' => CurrencyCode::UAH,
            'description' => Str::uuid()->toString(),
            'fee' => PaymentFee::fromArray([
                'amount' => 1.0,
                'currency' => 'UAH',
            ]),
            'method' => PaymentMethod::AUTH,
        ], $data));
    }
}
