<?php
/**
 * Description of RozetkaPayAuthDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace App\Client\Auth\DTO;

use Dots\RozetkaPay\App\Client\Auth\DTO\RozetkaPayAuthDTO;
use Tests\TestCase;

class RozetkaPayAuthDTOTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = RozetkaPayAuthDTO::fromArray([
            'login' => $this->uuid(),
            'password' => $this->uuid(),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            RozetkaPayAuthDTO::fromArray($dto->toArray())->toArray(),
        );
    }

    /**
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray(
        array $data,
        array $expectedData,
    ): void {
        $dto = RozetkaPayAuthDTO::fromArray($data);
        $this->assertArraysEqual($expectedData, $dto->toArray());
    }

    public static function fromArrayDataProvider(): array
    {
        return [
            'Test with full data' => [
                'data' => [
                    'login' => 'login',
                    'password' => 'password',
                ],
                'expectedData' => [
                    'login' => 'login',
                    'password' => 'password',
                ],
            ],
        ];
    }
}
