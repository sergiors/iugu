<?php

declare(strict_types = 1);

namespace Sergiors\Iugu;

/**
 * @author Sérgio Rafael Siqueira <sergio@inbep.com.br>
 */
final class Credentials
{
    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $email;

    public function __construct(string $apiKey, string $email)
    {
        $this->apiKey = $apiKey;
        $this->email = $email;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
