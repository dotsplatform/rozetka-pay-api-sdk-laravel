<?php
/**
 * Description of ConfirmPaymentRequestDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace App\Client\Requests\Payments\DTO;

use Dots\RozetkaPay\App\Client\Requests\Payments\DTO\ConfirmPaymentRequestDTO;
use Dots\RozetkaPay\App\Client\Resources\Consts\CurrencyCode;
use Tests\TestCase;

class ConfirmPaymentRequestDTOTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = ConfirmPaymentRequestDTO::fromArray([
            'external_id' => $this->uuid(),
            'amount' => 100.0,
            'currency' => CurrencyCode::UAH,
            'callback_url' => $this->uuid(),
            'payload' => $this->uuid(),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            ConfirmPaymentRequestDTO::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = ConfirmPaymentRequestDTO::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'external_id' => 'external_id',
                    'amount' => 100.0,
                    'currency' => CurrencyCode::UAH,
                    'callback_url' => 'callback_url',
                    'payload' => 'payload',
                ],
                'expectedData' => [
                    'external_id' => 'external_id',
                    'amount' => 100.0,
                    'currency' => CurrencyCode::UAH->value,
                    'callback_url' => 'callback_url',
                    'payload' => 'payload',
                ],
            ],
            'Test expects null by default' => [
                'data' => [
                    'external_id' => 'external_id',
                ],
                'expectedData' => [
                    'amount' => null,
                    'currency' => null,
                    'callback_url' => null,
                    'payload' => null,
                ],
            ],
        ];
    }
}
