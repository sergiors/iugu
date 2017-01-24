<?php

declare(strict_types = 1);

namespace Sergiors\Iugu;

final class PaymentFormatter
{
    /**
     * @var Charge
     */
    private $charge;

    /**
     * @var PaymentMethod
     */
    private $paymentMethod;

    public function __construct(
        Charge $charge,
        PaymentMethodInterface $paymentMethod
    ) {
        $this->charge = $charge;
        $this->paymentMethod = $paymentMethod;
    }

    public function getCharge(): Charge
    {
        return $this->charge;
    }

    public function getPaymentMethod(): PaymentMethodInterface
    {
        return $this->paymentMethod;
    }

    public function toArray(): array
    {
        $payer = $this->charge->getPayer();
        $items = $this->charge->getItems();

        return [
            /*
             * Must be customer's e-mail, according to
             * Iugu's official documentation:
             * https://iugu.com/referencias/api
             */
            'email' => $payer->getEmail(),
            'method' => $this->paymentMethod->getName(),
            'items' => array_map(function (Item $item) {
                return [
                    'description' => $item->getDescription(),
                    'quantity' => $item->getQuantity(),
                    'price_cents' => (string) ($item->getAmount() * 100),
                ];
            }, $items->toArray()),
            'payer' => [
                'name' => $payer->getName(),
                'email' => $payer->getEmail(),
                'cpf_cnpj' => $payer->getCpfCnpj(),
                'phone_prefix' => $payer->getPhone()->getPrefix(),
                'phone' => $payer->getPhone()->getNumber(),
                'address' => [
                    'street' => $payer->getAddress()->getStreet(),
                    'number' => $payer->getAddress()->getNumber(),
                    'city' => $payer->getAddress()->getCity(),
                    'state' => $payer->getAddress()->getState(),
                    'country' => $payer->getAddress()->getCountry(),
                    'zip_code' => $payer->getAddress()->getZipCode(),
                ],
            ]
        ];
    }
}
