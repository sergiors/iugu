<?php

namespace Sergiors\Iugu;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Sergiors\Iugu\Invoice\Response;
use Sergiors\Iugu\Invoice\ResponseInterface;

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
     * @var PaymentFormatter
     */
    private $paymentFormatter;

    /**
     * @var HttpClient
     */
    private $httpClient;

    public function __construct(
        Credentials $credentials,
        PaymentFormatter $paymentFormatter,
        ClientInterface $httpClient = null
    ) {
        $this->credentials = $credentials;
        $this->paymentFormatter = $paymentFormatter;
        $this->httpClient = $httpClient ?: new HttpClient();
    }

    public function doInvoice(): ResponseInterface
    {
        $paymentMethod = $this->paymentFormatter->getPaymentMethod();
        $uriAddress = self::HOST.$paymentMethod->getEndpoint();

        try {
            $response = $this->httpClient->request('POST', $uriAddress, [
                'auth' => [$this->credentials->getApiKey(), ''],
                'json' => $this->paymentFormatter->toArray(),
            ]);
            
            $data = json_decode($response->getBody()->getContents(), true);
            return new Response($data);
        } catch (GuzzleException $e) {
            throw new \InvalidArgumentException($e->getMessage());
        }
    }
}
