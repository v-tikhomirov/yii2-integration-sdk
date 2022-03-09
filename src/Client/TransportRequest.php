<?php

namespace Tikhomirov\IntegrationSdk\Client;

class TransportRequest
{
    /**
     * @var string|null
     */
    private $method;

    /**
     * @var string|null
     */
    private $path;

    /**
     * @var array
     */
    private $queryParams = [];

    /**
     * @var array
     */
    private $body = [];

    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setQueryParams(array $queryParams): void
    {
        $this->queryParams = $queryParams;
    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    public function setBody(array $body): void
    {
        $this->body = $body;
    }

    public function getBody(): array
    {
        return array_filter($this->body, function ($var) {
            return !is_null($var);
        });
    }

    public function getBodyWithoutFileContents(): array
    {
        return array_map(
            function ($body) {
                if (isset($body['contents'])) {
                    $body['contents'] = 'Содержимое Base64';
                }
                return $body;
            }, $this->body
        );
    }
}
