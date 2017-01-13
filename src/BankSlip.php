<?php

declare(strict_types = 1);

namespace Sergiors\Iugu;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

/**
 * @author Sérgio Rafael Siqueira <sergio@inbep.com.br>
 */
final class BankSlip
{
    /**
     * @var string
     */
    private $endpoint = 'https://api.iugu.com/v1/charge';

    /**
     * @param Credentials          $credentials
     * @param Charge               $charge
     * @param ClientInterface|null $httpClient
     */
    public function __construct(
        Credentials $credentials,
        Charge $charge,
        ClientInterface $httpClient = null
    ) {
        $this->credentials = $credentials;
        $this->charge = $charge;
        $this->httpClient = $httpClient ?: new HttpClient();
    }

    /**
     * @return array
     */
    public function getResponse(): array
    {
        $payer = $this->charge->getPayer();
        $items = $this->charge->getItems();

        try {
            $response = $this->httpClient->request('POST', $this->endpoint, [
                'auth' => [$this->credentials->getApiKey(), ''],
                'json' => [
                    'email' => $this->credentials->getEmail(),
                    'method' => 'bank_slip',
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
                    ],
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new \InvalidArgumentException($e->getMessage());
        }
    }
}
