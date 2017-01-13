<?php

declare(strict_types = 1);

namespace Sergiors\Iugu;

/**
 * @author Sérgio Rafael Siqueira <sergio@inbep.com.br>
 */
final class Item
{
    /**
     * @var string
     */
    private $description;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @param string $description
     * @param float  $amount
     * @param int    $quantity
     */
    public function __construct(string $description, float $amount, int $quantity = 1)
    {
        $this->description = $description;
        $this->quantity = $quantity;
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }
}
