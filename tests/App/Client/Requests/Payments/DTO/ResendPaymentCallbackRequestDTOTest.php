<?php
/**
 * Description of ResendPaymentCallbackRequestDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace App\Client\Requests\Payments\DTO;

use Dots\RozetkaPay\App\Client\Requests\Payments\DTO\ResendPaymentCallbackRequestDTO;
use Dots\RozetkaPay\App\Client\Resources\Consts\PaymentOperation;
use Tests\TestCase;

class ResendPaymentCallbackRequestDTOTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = ResendPaymentCallbackRequestDTO::fromArray([
            'external_id' => $this->uuid(),
            'operation' => PaymentOperation::CONFIRM,
        ]);

        $this->assertEquals(
            $dto->toArray(),
            ResendPaymentCallbackRequestDTO::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = ResendPaymentCallbackRequestDTO::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'external_id' => 'external_id',
                    'operation' => PaymentOperation::CONFIRM,
                ],
                'expectedData' => [
                    'external_id' => 'external_id',
                    'operation' => PaymentOperation::CONFIRM->value,
                ],
            ],
        ];
    }
}
