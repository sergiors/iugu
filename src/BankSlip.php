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
     * 
     * @TODO it's should moved
     */
    const ENDPOINT = '/v1/invoices';

    /**
     * @var \DateTime
     */
    private $dueDate;

    public function __construct(\DateTime $dueDate = null)
    {
        $this->dueDate = $dueDate ?: new \DateTime('now + 3 days');
    }

    public function getName(): string
    {
        return 'bank_slip';
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function getEndpoint(): string
    {
        return self::ENDPOINT;
    }
}
