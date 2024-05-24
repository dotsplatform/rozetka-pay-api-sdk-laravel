<?php
/**
 * Description of PaymentInfoRequestDTOTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace App\Client\Requests\Payments\DTO;

use Dots\RozetkaPay\App\Client\Requests\Payments\DTO\PaymentInfoRequestDTO;
use Tests\TestCase;

class PaymentInfoRequestDTOTest extends TestCase
{
    public function testFromArrayToArray(): void
    {
        $dto = PaymentInfoRequestDTO::fromArray([
            'external_id' => $this->uuid(),
        ]);

        $this->assertEquals(
            $dto->toArray(),
            PaymentInfoRequestDTO::fromArray($dto->toArray())->toArray(),
        );
    }
}
