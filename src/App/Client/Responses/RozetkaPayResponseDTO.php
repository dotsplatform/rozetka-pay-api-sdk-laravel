<?php
/**
 * Description of PlateByMonoResponseDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client\Responses;

use Dots\Data\DTO;
use Saloon\Http\Response;

abstract class RozetkaPayResponseDTO extends DTO
{
    public static function fromResponse(Response $response): static
    {
        return static::fromArray($response->json());
    }
}
