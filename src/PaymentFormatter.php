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
            'payable_with' => $this->paymentMethod->getName(),
            'due_date' => $this->paymentMethod->getDueDate()->format('Y-m-d'),
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
                'phone_prefix' => (string) $payer->getPhone()->getPrefix(),
                'phone' => (string) $payer->getPhone()->getNumber(),
                'address' => [
                    'street' => $payer->getAddress()->getStreet(),
                    'number' => (string) $payer->getAddress()->getNumber(),
                    'city' => $payer->getAddress()->getCity(),
                    'district' => $payer->getAddress()->getDistrict(),
                    'state' => $payer->getAddress()->getState(),
                    'country' => $payer->getAddress()->getCountry(),
                    'zip_code' => (string) $payer->getAddress()->getZipCode(),
                ],
            ]
        ];
    }
}
