<?php
/**
 * Description of PaymentInfoTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace App\Resources;

use Dots\RozetkaPay\App\Client\Resources\Consts\CurrencyCode;
use Dots\RozetkaPay\App\Client\Resources\Consts\Locale;
use Dots\RozetkaPay\App\Client\Resources\Consts\PaymentActionType;
use Dots\RozetkaPay\App\Client\Resources\Consts\PaymentMethodType;
use Dots\RozetkaPay\App\Client\Resources\Customers\Consts\CustomerColorMode;
use Dots\RozetkaPay\App\Client\Resources\Customers\Customer;
use Dots\RozetkaPay\App\Client\Resources\Customers\CustomerPaymentMethod;
use Dots\RozetkaPay\App\Client\Resources\PaymentAction;
use Dots\RozetkaPay\App\Client\Resources\PaymentInfo;
use Tests\Generators\PaymentDetailsGenerator;
use Tests\TestCase;

class PaymentInfoTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = PaymentInfo::fromArray([
            'id' => $this->uuid(),
            'external_id' => $this->uuid(),
            'amount' => 100.0,
            'amount_confirmed' => 100.0,
            'amount_canceled' => 0,
            'amount_refunded' => 0,
            'currency' => 'UAH',
            'purchased' => true,
            'purchase_details' => PaymentDetailsGenerator::generateList(1),
            'confirmed' => true,
            'confirmation_details' => PaymentDetailsGenerator::generateList(1),
            'canceled' => false,
            'cancellation_details' => PaymentDetailsGenerator::generateList(1),
            'refunded' => false,
            'refund_details' => PaymentDetailsGenerator::generateList(1),
            'receipt_url' => $this->uuid(),
            'created_at' => $this->uuid(),
            'action_required' => true,
            'action' => PaymentAction::fromArray([
                'type' => PaymentActionType::URL,
                'value' => $this->uuid(),
            ]),
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
            PaymentInfo::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = PaymentInfo::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'amount' => 100.0,
                    'amount_confirmed' => 100.0,
                    'amount_canceled' => 0,
                    'amount_refunded' => 0,
                    'currency' => 'UAH',
                    'purchased' => true,
                    'purchase_details' => [],
                    'confirmed' => true,
                    'confirmation_details' => null,
                    'canceled' => false,
                    'cancellation_details' => null,
                    'refunded' => false,
                    'refund_details' => null,
                    'receipt_url' => 'receipt_url',
                    'created_at' => 'created_at',
                    'action_required' => true,
                    'action' => PaymentAction::fromArray([
                        'type' => PaymentActionType::URL,
                        'value' => 'value',
                    ]),
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
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'amount' => 100.0,
                    'amount_confirmed' => 100.0,
                    'amount_canceled' => 0,
                    'amount_refunded' => 0,
                    'currency' => 'UAH',
                    'purchased' => true,
                    'purchase_details' => [],
                    'confirmed' => true,
                    'confirmation_details' => null,
                    'canceled' => false,
                    'cancellation_details' => null,
                    'refunded' => false,
                    'refund_details' => null,
                    'receipt_url' => 'receipt_url',
                    'created_at' => 'created_at',
                    'action_required' => true,
                    'action' => [
                        'type' => PaymentActionType::URL->value,
                        'value' => 'value',
                    ],
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
        ];
    }

    /**
     * @dataProvider methodsProvider
     */
    public function testMethods(
        string $method,
        array $methodData,
        array $data,
        mixed $expectedResult,
    ): void {
        $dto = PaymentInfo::fromArray($data);
        $result = $dto->$method(...$methodData);
        if (is_array($expectedResult)) {
            $this->assertArraysEqual($expectedResult, $result);

            return;
        }
        $this->assertEquals($expectedResult, $result);
    }

    public static function methodsProvider(): array
    {
        return [
            'Test getActualAmount expects confirmed amount' => [
                'method' => 'getActualAmount',
                'methodData' => [],
                'data' => [
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'amount' => 100,
                    'currency' => CurrencyCode::UAH->value,
                    'amount_confirmed' => 50,
                    'purchase_details' => [],
                    'action_required' => true,
                    'confirmed' => true,
                    'canceled' => false,
                    'refunded' => false,
                    'purchased' => true,
                ],
                'expectedResult' => 50,
            ],

            'Test getActualAmount expects canceled amount' => [
                'method' => 'getActualAmount',
                'methodData' => [],
                'data' => [
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'amount' => 100,
                    'currency' => CurrencyCode::UAH->value,
                    'amount_canceled' => 90,
                    'purchase_details' => [],
                    'action_required' => true,
                    'confirmed' => false,
                    'canceled' => true,
                    'refunded' => false,
                    'purchased' => true,
                ],
                'expectedResult' => 90,
            ],

            'Test getActualAmount expects refunded amount' => [
                'method' => 'getActualAmount',
                'methodData' => [],
                'data' => [
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'amount' => 100,
                    'currency' => CurrencyCode::UAH->value,
                    'amount_refunded' => 80,
                    'purchase_details' => [],
                    'action_required' => true,
                    'confirmed' => false,
                    'canceled' => false,
                    'refunded' => true,
                    'purchased' => true,
                ],
                'expectedResult' => 80,
            ],

            'Test getActualAmount expects amount' => [
                'method' => 'getActualAmount',
                'methodData' => [],
                'data' => [
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'amount' => 100,
                    'currency' => CurrencyCode::UAH->value,
                    'purchase_details' => [],
                    'action_required' => true,
                    'confirmed' => false,
                    'canceled' => false,
                    'refunded' => false,
                    'purchased' => true,
                ],
                'expectedResult' => 100,
            ],
        ];
    }
}
