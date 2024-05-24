<?php
/**
 * Description of PaymentDetailsGenerator.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\Generators;

use Dots\RozetkaPay\App\Client\Resources\Consts\CurrencyCode;
use Dots\RozetkaPay\App\Client\Resources\Consts\PaymentMethod;
use Dots\RozetkaPay\App\Client\Resources\Consts\PaymentStatus;
use Dots\RozetkaPay\App\Client\Resources\PaymentDetails;
use Dots\RozetkaPay\App\Client\Resources\PaymentDetailsList;
use Dots\RozetkaPay\App\Client\Resources\PaymentFee;
use Illuminate\Support\Str;

class PaymentDetailsGenerator
{
    public static function generateList(int $count = 1): PaymentDetailsList
    {
        $result = new PaymentDetailsList();
        for ($i = 0; $i < $count; $i++) {
            $result->add(self::generate());
        }

        return $result;
    }

    public static function generate(array $data = []): PaymentDetails
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
