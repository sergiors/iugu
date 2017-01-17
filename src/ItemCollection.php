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

    public function __construct(Item ...$items)
    {
        $this->items = $items;
    }

    public function add(Item $item)
    {
        $this->items[] = $item;
    }

    public function toArray(): array
    {
        return $this->items;
    }
}
