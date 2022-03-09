<?php

namespace Tests;

use ClientInterface\Base\PhpDocReader\AnnotationException;
use ClientInterface\Exception\ValidationException;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Tikhomirov\IntegrationSdk\Client\Client;
use Tikhomirov\IntegrationSdk\Client\Config;
use Tikhomirov\IntegrationSdk\DTO\ClientDTO;
use Tikhomirov\IntegrationSdk\Request\ClientsListRequest;
use Tikhomirov\IntegrationSdk\Request\EntityRequest;

class ClientRequestsTest extends TestCase
{
    /**
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function testRecieveOneClient()
    {
        $client = $this->getSdkClient();
        $request = $this->getClientRequest();
        $response = $client->getClient($request);
        $this->assertEquals(true, $response->isSuccess());
    }

    /**
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function testRecieveClientsList()
    {
        $client = $this->getSdkClient();
        $request = $this->getClientsListRequest();
        $response = $client->getClientsList($request);
        $this->assertEquals(true, $response->isSuccess());
    }

    /**
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     * @throws ValidationException
     */
    public function testAddClient()
    {
        $clientSdk = $this->getSdkClient();
        $request = $this->makeCreateClientRequest();
        $response = $clientSdk->doAddClient($request);
        $this->assertEquals(true, $response->isSuccess());
    }

    private function getClientRequest(): EntityRequest
    {
        $request = new EntityRequest();
        $request->setEntityId(47902);
        return $request;
    }

    /**
     * @return ClientsListRequest
     */
    private function getClientsListRequest(): ClientsListRequest
    {
        $request = new ClientsListRequest();
        return $request;
    }

    private function makeCreateClientRequest(): EntityRequest
    {
        $entity = new ClientDTO();

        $entity->Surname = 'Петров';
        $entity->Name = 'Петр';
        $entity->CityId = 45;

        $request = new EntityRequest();
        $request->setEntityData($entity);

        return $request;
    }

    protected function getSdkClient(): Client
    {
        $config = new Config('http://sdk.integration.com/api/', 'test', 'test');

        return new Client($config);
    }
}
