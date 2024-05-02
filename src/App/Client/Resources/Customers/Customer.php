<?php
/**
 * Description of CreatePaymentCustomerDTO.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\RozetkaPay\App\Client\Resources\Customers;

use Dots\Data\DTO;
use Dots\RozetkaPay\App\Client\Resources\Consts\Locale;
use Dots\RozetkaPay\App\Client\Resources\Customers\Consts\CustomerColorMode;

class Customer extends DTO
{
    protected ?CustomerColorMode $color_mode;

    protected ?Locale $locale;

    protected ?string $account_number;

    protected ?string $email;

    protected ?string $phone;

    protected ?string $external_id;

    protected ?string $first_name;

    protected ?string $last_name;

    protected ?string $patronym;

    protected CustomerPaymentMethod $payment_method;

    public function getColorMode(): ?CustomerColorMode
    {
        return $this->color_mode;
    }

    public function getLocale(): ?Locale
    {
        return $this->locale;
    }

    public function getAccountNumber(): ?string
    {
        return $this->account_number;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getExternalId(): ?string
    {
        return $this->external_id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function getPatronym(): ?string
    {
        return $this->patronym;
    }

    public function getPaymentMethod(): CustomerPaymentMethod
    {
        return $this->payment_method;
    }
}
