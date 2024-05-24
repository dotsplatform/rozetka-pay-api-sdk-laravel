<?php
/**
 * Description of PaymentTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace App\Resources;

use Dots\RozetkaPay\App\Client\Resources\Consts\CurrencyCode;
use Dots\RozetkaPay\App\Client\Resources\Consts\PaymentActionType;
use Dots\RozetkaPay\App\Client\Resources\Consts\PaymentMethod;
use Dots\RozetkaPay\App\Client\Resources\Consts\PaymentStatus;
use Dots\RozetkaPay\App\Client\Resources\Payment;
use Dots\RozetkaPay\App\Client\Resources\PaymentAction;
use Dots\RozetkaPay\App\Client\Resources\PaymentDetails;
use Dots\RozetkaPay\App\Client\Resources\PaymentFee;
use Tests\Generators\PaymentDetailsGenerator;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = Payment::fromArray([
            'id' => $this->uuid(),
            'external_id' => $this->uuid(),
            'is_success' => true,
            'details' => PaymentDetailsGenerator::generate(),
            'action' => PaymentAction::fromArray([
                'type' => PaymentActionType::URL,
                'value' => $this->uuid(),
            ]),
            'action_required' => true,
            'payment_method' => [],
            'receipt_url' => $this->uuid(),
            'operation' => $this->uuid(),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            Payment::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = Payment::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'is_success' => true,
                    'details' => PaymentDetails::fromArray([
                        'amount' => 100.0,
                        'auth_code' => 'auth_code',
                        'billing_order_id' => 'billing_order_id',
                        'gateway_order_id' => 'gateway_order_id',
                        'payload' => 'payload',
                        'payment_id' => 'payment_id',
                        'processed_at' => 'processed_at',
                        'rrn' => 'rrn',
                        'status' => PaymentStatus::SUCCESS,
                        'status_code' => 'status_code',
                        'status_description' => 'status_description',
                        'transaction_id' => 'transaction_id',
                        'terminal_name' => 'terminal_name',
                        'created_at' => 'created_at',
                        'currency' => CurrencyCode::UAH,
                        'description' => 'description',
                        'fee' => PaymentFee::fromArray([
                            'amount' => 1.0,
                            'currency' => 'UAH',
                        ]),
                        'method' => PaymentMethod::AUTH,
                    ]),
                    'action' => PaymentAction::fromArray([
                        'type' => PaymentActionType::URL,
                        'value' => 'value',
                    ]),
                    'action_required' => true,
                    'payment_method' => [],
                    'receipt_url' => 'receipt_url',
                    'operation' => 'operation',
                ],
                'expectedData' => [
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'is_success' => true,
                    'details' => [
                        'amount' => 100.0,
                        'auth_code' => 'auth_code',
                        'billing_order_id' => 'billing_order_id',
                        'gateway_order_id' => 'gateway_order_id',
                        'payload' => 'payload',
                        'payment_id' => 'payment_id',
                        'processed_at' => 'processed_at',
                        'rrn' => 'rrn',
                        'status' => PaymentStatus::SUCCESS->value,
                        'status_code' => 'status_code',
                        'status_description' => 'status_description',
                        'transaction_id' => 'transaction_id',
                        'terminal_name' => 'terminal_name',
                        'created_at' => 'created_at',
                        'currency' => CurrencyCode::UAH->value,
                        'description' => 'description',
                        'fee' => [
                            'amount' => 1.0,
                            'currency' => CurrencyCode::UAH->value,
                        ],
                        'method' => PaymentMethod::AUTH->value,
                    ],
                    'action' => [
                        'type' => PaymentActionType::URL->value,
                        'value' => 'value',
                    ],
                    'action_required' => true,
                    'payment_method' => [],
                    'receipt_url' => 'receipt_url',
                    'operation' => 'operation',
                ],
            ],
            'Test expects null by default' => [
                'data' => [
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'is_success' => true,
                    'action_required' => true,
                ],
                'expectedData' => [
                    'details' => null,
                    'action' => null,
                    'payment_method' => null,
                    'receipt_url' => null,
                    'operation' => null,
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
        $dto = Payment::fromArray($data);
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
            'Test isOnHold expects false if not success' => [
                'method' => 'isOnHold',
                'methodData' => [],
                'data' => [
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'is_success' => false,
                    'action_required' => true,
                    'details' => PaymentDetails::fromArray([
                        'amount' => 100,
                        'method' => PaymentMethod::AUTH,
                        'status' => PaymentStatus::SUCCESS,
                    ]),
                ],
                'expectedResult' => false,
            ],

            'Test isOnHold expects false if details is null' => [
                'method' => 'isOnHold',
                'methodData' => [],
                'data' => [
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'is_success' => true,
                    'action_required' => true,
                ],
                'expectedResult' => false,
            ],

            'Test isOnHold expects false if details method is null' => [
                'method' => 'isOnHold',
                'methodData' => [],
                'data' => [
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'is_success' => true,
                    'action_required' => true,
                    'details' => PaymentDetails::fromArray([
                        'amount' => 100,
                        'status' => PaymentStatus::SUCCESS,
                    ]),
                ],
                'expectedResult' => false,
            ],

            'Test isOnHold expects false if details status is null' => [
                'method' => 'isOnHold',
                'methodData' => [],
                'data' => [
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'is_success' => true,
                    'action_required' => true,
                    'details' => PaymentDetails::fromArray([
                        'amount' => 100,
                        'method' => PaymentMethod::AUTH,
                    ]),
                ],
                'expectedResult' => false,
            ],

            'Test isOnHold expects false if details method is not auth' => [
                'method' => 'isOnHold',
                'methodData' => [],
                'data' => [
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'is_success' => true,
                    'action_required' => true,
                    'details' => PaymentDetails::fromArray([
                        'amount' => 100,
                        'method' => PaymentMethod::CAPTURE,
                        'status' => PaymentStatus::SUCCESS,
                    ]),
                ],
                'expectedResult' => false,
            ],

            'Test isOnHold expects false if details status is not success' => [
                'method' => 'isOnHold',
                'methodData' => [],
                'data' => [
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'is_success' => true,
                    'action_required' => true,
                    'details' => PaymentDetails::fromArray([
                        'amount' => 100,
                        'method' => PaymentMethod::AUTH,
                        'status' => PaymentStatus::FAILURE,
                    ]),
                ],
                'expectedResult' => false,
            ],

            'Test isOnHold expects true' => [
                'method' => 'isOnHold',
                'methodData' => [],
                'data' => [
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'is_success' => true,
                    'action_required' => true,
                    'details' => PaymentDetails::fromArray([
                        'amount' => 100,
                        'method' => PaymentMethod::AUTH,
                        'status' => PaymentStatus::SUCCESS,
                    ]),
                ],
                'expectedResult' => true,
            ],

            'Test isCaptured expects false if not success' => [
                'method' => 'isCaptured',
                'methodData' => [],
                'data' => [
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'is_success' => false,
                    'action_required' => true,
                    'details' => PaymentDetails::fromArray([
                        'amount' => 100,
                        'method' => PaymentMethod::CAPTURE,
                        'status' => PaymentStatus::SUCCESS,
                    ]),
                ],
                'expectedResult' => false,
            ],

            'Test isCaptured expects false if details is null' => [
                'method' => 'isCaptured',
                'methodData' => [],
                'data' => [
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'is_success' => true,
                    'action_required' => true,
                ],
                'expectedResult' => false,
            ],

            'Test isCaptured expects false if details method is null' => [
                'method' => 'isCaptured',
                'methodData' => [],
                'data' => [
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'is_success' => true,
                    'action_required' => true,
                    'details' => PaymentDetails::fromArray([
                        'amount' => 100,
                        'status' => PaymentStatus::SUCCESS,
                    ]),
                ],
                'expectedResult' => false,
            ],

            'Test isCaptured expects false if details status is null' => [
                'method' => 'isCaptured',
                'methodData' => [],
                'data' => [
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'is_success' => true,
                    'action_required' => true,
                    'details' => PaymentDetails::fromArray([
                        'amount' => 100,
                        'method' => PaymentMethod::AUTH,
                    ]),
                ],
                'expectedResult' => false,
            ],

            'Test isCaptured expects false if details method is not capture' => [
                'method' => 'isCaptured',
                'methodData' => [],
                'data' => [
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'is_success' => true,
                    'action_required' => true,
                    'details' => PaymentDetails::fromArray([
                        'amount' => 100,
                        'method' => PaymentMethod::AUTH,
                        'status' => PaymentStatus::SUCCESS,
                    ]),
                ],
                'expectedResult' => false,
            ],

            'Test isCaptured expects false if details status is not success' => [
                'method' => 'isCaptured',
                'methodData' => [],
                'data' => [
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'is_success' => true,
                    'action_required' => true,
                    'details' => PaymentDetails::fromArray([
                        'amount' => 100,
                        'method' => PaymentMethod::CAPTURE,
                        'status' => PaymentStatus::FAILURE,
                    ]),
                ],
                'expectedResult' => false,
            ],

            'Test isCaptured expects true' => [
                'method' => 'isCaptured',
                'methodData' => [],
                'data' => [
                    'id' => 'id',
                    'external_id' => 'external_id',
                    'is_success' => true,
                    'action_required' => true,
                    'details' => PaymentDetails::fromArray([
                        'amount' => 100,
                        'method' => PaymentMethod::CAPTURE,
                        'status' => PaymentStatus::SUCCESS,
                    ]),
                ],
                'expectedResult' => true,
            ],
        ];
    }
}
