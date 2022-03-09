<?php

namespace Tikhomirov\IntegrationSdk\Client;

class Config
{
    /**
     * @var string|null
     */
    private $login;

    /**
     * @var string|null
     */
    private $password;

    /**
     * @var string|null
     */
    private $baseUri;

    public function __construct(string $baseUri, string $login, string $password)
    {
        $this->baseUri = $baseUri;
        $this->login = $login;
        $this->password = $password;
    }

    public function getBaseUri(): ?string
    {
        return $this->baseUri;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }
}
