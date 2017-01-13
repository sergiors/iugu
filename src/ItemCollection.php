<?php

declare(strict_types = 1);

namespace Sergiors\Iugu;

/**
 * @author Sérgio Rafael Siqueira <sergio@inbep.com.br>
 */
final class ItemCollection
{
    /**
     * @var Item[]
     */
    private $items;

    /**
     * @param Item[]
     */
    public function __construct(Item ...$items)
    {
        $this->items = $items;
    }

    /**
     * @param Item $item
     */
    public function add(Item $item)
    {
        $this->items[] = $item;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->items;
    }
}
