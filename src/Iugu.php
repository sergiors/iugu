<?php

namespace Sergiors\Iugu;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

/**
 * @author Sérgio Rafael Siqueira <sergio@inbep.com.br>
 */
final class Iugu
{
    const HOST = 'https://api.iugu.com';

    /**
     * @var Credentials
     */
    private $credentials;

    /**
     * @var Charge
     */
    private $charge;

    /**
     * @var PaymentMethodInterface
     */
    private $paymentMethod;

    /**
     * @var HttpClient
     */
    private $httpClient;

    public function __construct(
        Credentials $credentials,
        Charge $charge,
        PaymentMethodInterface $paymentMethod,
        ClientInterface $httpClient = null
    ) {
        $this->credentials = $credentials;
        $this->charge = $charge;
        $this->paymentMethod = $paymentMethod;
        $this->httpClient = $httpClient ?: new HttpClient();
    }

    public function getResponse(): array
    {
        $payer = $this->charge->getPayer();
        $items = $this->charge->getItems();
        $uriAddress = self::HOST.$this->paymentMethod->getEndpoint();

        try {
            $response = $this->httpClient->request('POST', $uriAddress, [
                'auth' => [$this->credentials->getApiKey(), ''],
                'json' => [
                    'email' => $this->credentials->getEmail(),
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
                    ],
                ],
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new \InvalidArgumentException($e->getMessage());
        }
    }
}