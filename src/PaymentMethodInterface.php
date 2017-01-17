<?php

namespace Sergiors\Iugu;

/**
 * @author Sérgio Rafael Siqueira <sergio@inbep.com.br>
 */
interface PaymentMethodInterface
{
    public function getName(): string;

    public function getEndpoint(): string;
}