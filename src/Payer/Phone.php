<?php

declare(strict_types = 1);

namespace Sergiors\Iugu\Payer;

/**
 * @author Sérgio Rafael Siqueira <sergio@inbep.com.br>
 */
final class Phone
{
    /**
     * @var int
     */
    private $prefix;

    /**
     * @var int
     */
    private $number;

    public function __construct(int $prefix, int $number)
    {
        $this->prefix = $prefix;
        $this->number = $number;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function getNumber()
    {
        return $this->number;
    }
}
