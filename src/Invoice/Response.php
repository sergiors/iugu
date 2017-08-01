<?php

declare(strict_types = 1);

namespace Sergiors\Iugu\Invoice;

/**
 * @TODO it's should improved
 */
class Response implements ResponseInterface
{
    public function __construct(array $data)
    {
        $this->data = $data;
    }
}
