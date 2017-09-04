<?php

declare(strict_types = 1);

namespace Sergiors\Iugu\Payer;

/**
 * @author Sérgio Rafael Siqueira <sergio@inbep.com.br>
 */
final class Address
{
    /**
     * @var string
     */
    private $street;

    /**
     * @var int
     */
    private $number;

    /**
     * @var string
     */
    private $district;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $country;

    /**
     * @var int
     */
    private $zipCode;

    public function __construct(
        string $street,
        string $number,
        string $district,
        string $city,
        string $state,
        string $country,
        string $zipCode
    ) {
        $this->street = $street;
        $this->number = $number;
        $this->district = $district;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
        $this->zipCode = $zipCode;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getDistrict(): string
    {
        return $this->district;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getCountry(): string
    {
        return $this->city;
    }

    public function getZipCode(): string
    {
        return $this->zipCode;
    }
}
