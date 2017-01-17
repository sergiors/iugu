<?php

declare(strict_types = 1);

namespace Sergiors\Iugu;

/**
 * @author Sérgio Rafael Siqueira <sergio@inbep.com.br>
 */
final class BankSlip implements PaymentMethodInterface
{
    /**
     * @var string
     */
    const ENDPOINT = '/v1/charge';

    public function getName(): string
    {
        return 'bank_slip';
    }

    public function getEndpoint(): string
    {
        return self::ENDPOINT;
    }
}
