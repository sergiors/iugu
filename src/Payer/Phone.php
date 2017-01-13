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

    /**
     * @param int $prefix
     * @param int $number
     */
    public function __construct(int $prefix, int $number)
    {
        $this->prefix = $prefix;
        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }
}
