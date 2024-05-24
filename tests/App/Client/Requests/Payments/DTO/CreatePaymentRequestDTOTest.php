<?php
/**
 * Description of CreatePaymentRequestDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace App\Client\Requests\Payments\DTO;

use Dots\RozetkaPay\App\Client\Requests\Payments\DTO\CreatePaymentRequestDTO;
use Dots\RozetkaPay\App\Client\Resources\Consts\CurrencyCode;
use Dots\RozetkaPay\App\Client\Resources\Consts\Locale;
use Dots\RozetkaPay\App\Client\Resources\Consts\PaymentMethodType;
use Dots\RozetkaPay\App\Client\Resources\Consts\PaymentMode;
use Dots\RozetkaPay\App\Client\Resources\Customers\Consts\CustomerColorMode;
use Dots\RozetkaPay\App\Client\Resources\Customers\Customer;
use Dots\RozetkaPay\App\Client\Resources\Customers\CustomerPaymentMethod;
use Tests\TestCase;

class CreatePaymentRequestDTOTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = CreatePaymentRequestDTO::fromArray([
            'external_id' => $this->uuid(),
            'amount' => 100.0,
            'mode' => PaymentMode::HOSTED,
            'currency' => CurrencyCode::UAH,
            'callback_url' => $this->uuid(),
            'result_url' => $this->uuid(),
            'payload' => $this->uuid(),
            'confirm' => false,
            'description' => $this->uuid(),
            'products' => [],
            'recipient' => [],
            'customer' => Customer::fromArray([
                'color_mode' => CustomerColorMode::DARK,
                'locale' => Locale::EN,
                'account_number' => $this->uuid(),
                'email' => $this->uuid(),
                'phone' => $this->uuid(),
                'external_id' => $this->uuid(),
                'first_name' => $this->uuid(),
                'last_name' => $this->uuid(),
                'patronym' => $this->uuid(),
                'payment_method' => CustomerPaymentMethod::fromArray([
                    'type' => PaymentMethodType::APPLE_PAY,
                ]),
            ]),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            CreatePaymentRequestDTO::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = CreatePaymentRequestDTO::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'external_id' => 'external_id',
                    'amount' => 100.0,
                    'mode' => PaymentMode::HOSTED,
                    'currency' => CurrencyCode::UAH,
                    'callback_url' => 'callback_url',
                    'result_url' => 'result_url',
                    'payload' => 'payload',
                    'confirm' => false,
                    'description' => 'description',
                    'products' => [],
                    'recipient' => [],
                    'customer' => Customer::fromArray([
                        'color_mode' => CustomerColorMode::DARK,
                        'locale' => Locale::EN,
                        'account_number' => 'account_number',
                        'email' => 'email',
                        'phone' => 'phone',
                        'external_id' => 'external_id',
                        'first_name' => 'first_name',
                        'last_name' => 'last_name',
                        'patronym' => 'patronym',
                        'payment_method' => CustomerPaymentMethod::fromArray([
                            'type' => PaymentMethodType::APPLE_PAY,
                        ]),
                    ]),
                ],
                'expectedData' => [
                    'external_id' => 'external_id',
                    'amount' => 100.0,
                    'mode' => PaymentMode::HOSTED->value,
                    'currency' => CurrencyCode::UAH->value,
                    'callback_url' => 'callback_url',
                    'result_url' => 'result_url',
                    'payload' => 'payload',
                    'confirm' => false,
                    'description' => 'description',
                    'products' => [],
                    'recipient' => [],
                    'customer' => [
                        'color_mode' => CustomerColorMode::DARK->value,
                        'locale' => Locale::EN->value,
                        'account_number' => 'account_number',
                        'email' => 'email',
                        'phone' => 'phone',
                        'external_id' => 'external_id',
                        'first_name' => 'first_name',
                        'last_name' => 'last_name',
                        'patronym' => 'patronym',
                        'payment_method' => [
                            'type' => PaymentMethodType::APPLE_PAY->value,
                        ],
                    ],
                ],
            ],
            'Test expects null by default' => [
                'data' => [
                    'external_id' => 'external_id',
                    'amount' => 100.0,
                    'mode' => PaymentMode::HOSTED,
                    'currency' => CurrencyCode::UAH,
                    'confirm' => false,
                ],
                'expectedData' => [
                    'callback_url' => null,
                    'result_url' => null,
                    'payload' => null,
                    'description' => null,
                    'products' => null,
                    'recipient' => null,
                    'customer' => null,
                ],
            ],
        ];
    }
}
