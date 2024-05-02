<?php
/**
 * Description of PaymentDetailsList.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client\Resources;

use Dots\Data\FromArrayable;
use Illuminate\Support\Collection;

class PaymentDetailsList extends Collection implements FromArrayable
{
    public static function fromArray(array $data): static
    {
        return new static(array_map(
            fn (array $item) => PaymentDetails::fromArray($item),
            $data,
        ));
    }
}
