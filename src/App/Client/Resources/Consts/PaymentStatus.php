<?php
/**
 * Description of PaymentStatus.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client\Resources\Consts;

enum PaymentStatus: string
{
    case INIT = 'init';
    case PENDING = 'pending';

    case AUTH = 'auth';
    case SUCCESS = 'success';
    case FAILURE = 'failure';

    public function isAuth(): bool
    {
        return $this === self::AUTH;
    }

    public function isSuccess(): bool
    {
        return $this === self::SUCCESS;
    }

    public function isFailure(): bool
    {
        return $this === self::FAILURE;
    }
}
