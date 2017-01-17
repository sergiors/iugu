<?php

declare(strict_types = 1);

namespace Sergiors\Iugu;

use Sergiors\Iugu\Payer\Payer;

/**
 * @author Sérgio Rafael Siqueira <sergio@inbep.com.br>
 */
final class Charge
{
    /**
     * @var Payer
     */
    private $payer;

    /**
     * @var ItemCollection
     */
    private $items;

    public function __construct(Payer $payer, ItemCollection $items)
    {
        $this->payer = $payer;
        $this->items = $items;
    }

    public function getPayer(): Payer
    {
        return $this->payer;
    }

    public function getItems(): ItemCollection
    {
        return $this->items;
    }

}
