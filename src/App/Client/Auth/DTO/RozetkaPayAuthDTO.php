<?php
/**
 * Description of RozetkaPayAuthDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client\Auth\DTO;

use Dots\Data\DTO;

class RozetkaPayAuthDTO extends DTO
{
    protected string $login;

    protected string $password;

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
