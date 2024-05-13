<?php
/**
 * Description of PaymentInfoRequestDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client\Requests\Payments\DTO;

use Dots\Data\DTO;

class PaymentInfoRequestDTO extends DTO
{
    protected string $external_id;
}
