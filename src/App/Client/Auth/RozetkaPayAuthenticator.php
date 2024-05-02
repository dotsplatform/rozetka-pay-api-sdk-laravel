<?php
/**
 * Description of RozetkaPayAuthenticator.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client\Auth;

use Dots\RozetkaPay\App\Client\Auth\DTO\RozetkaPayAuthDTO;
use Saloon\Http\Auth\BasicAuthenticator;

class RozetkaPayAuthenticator extends BasicAuthenticator
{
    public static function fromAuthDTO(RozetkaPayAuthDTO $dto): static
    {
        return new static(
            username: $dto->getLogin(),
            password: $dto->getPassword(),
        );
    }
}
