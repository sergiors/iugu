<?php

declare(strict_types = 1);

namespace Sergiors\Iugu\Payer;

/**
 * @author Sérgio Rafael Siqueira <sergio@inbep.com.br>
 */
final class Payer
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var int
     */
    private $cpfCnpj;

    /**
     * @var Phone
     */
    private $phone;

    /**
     * @var Address
     */
    private $address;

    /**
     * @param string  $name
     * @param string  $email
     * @param int     $cpfCnpj
     * @param Phone   $phone
     * @param Address $address
     */
    public function __construct(string $name, string $email, int $cpfCnpj, Phone $phone, Address $address)
    {
        $this->name = $name;
        $this->email = $email;
        $this->cpfCnpj = $cpfCnpj;
        $this->phone = $phone;
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getCpfCnpj(): int
    {
        return $this->cpfCnpj;
    }

    /**
     * @return Phone
     */
    public function getPhone(): Phone
    {
        return $this->phone;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }
}
