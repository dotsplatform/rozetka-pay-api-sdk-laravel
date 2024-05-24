<?php
/**
 * Description of RozetkaPayAuthenticatorTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Auth;

use Dots\RozetkaPay\App\Client\Auth\DTO\RozetkaPayAuthDTO;
use Dots\RozetkaPay\App\Client\Auth\RozetkaPayAuthenticator;
use Tests\TestCase;

class RozetkaPayAuthenticatorTest extends TestCase
{
    public function testExpectsFromAuthDTO(): void
    {
        $authDTO = RozetkaPayAuthDTO::fromArray([
            'login' => $this->uuid(),
            'password' => $this->uuid(),
        ]);
        $authenticator = RozetkaPayAuthenticator::fromAuthDTO($authDTO);

        $this->assertEquals($authDTO->getLogin(), $authenticator->username);
        $this->assertEquals($authDTO->getPassword(), $authenticator->password);
    }
}
