<?php

namespace Tikhomirov\IntegrationSdk\Client;

use GuzzleHttp\json_decode;
use GuzzleHttp\Exception\BadResponseException;

trait ErrorHadler
{
    /**
     * @param BadResponseException|string $exception
     * @return array
     */
    public function getErrors($exception): array
    {
        $rawBody = is_string($exception) ? $exception : $exception->getResponse()->getBody()->getContents();
        $body = json_decode($rawBody, true);

        if (array_key_exists('Message', $body)) {
            return [$body['Message']];
        }

        throw $exception;
    }
}
