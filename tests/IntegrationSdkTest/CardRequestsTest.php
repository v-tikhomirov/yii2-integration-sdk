<?php

namespace Tests;

use ClientInterface\Base\PhpDocReader\AnnotationException;
use ClientInterface\Base\StructureHelper;
use DateTime;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Tikhomirov\IntegrationSdk\Client\Config;
use Tikhomirov\IntegrationSdk\Client\Client;
use Tikhomirov\IntegrationSdk\DTO\CardCancelDTO;
use Tikhomirov\IntegrationSdk\DTO\CardSaleDTO;
use Tikhomirov\IntegrationSdk\Request\CardsListRequest;
use Tikhomirov\IntegrationSdk\Request\EntityRequest;
use Tikhomirov\IntegrationSdk\Request\ContractRequest;

class CardRequestsTest extends TestCase
{
    /**
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function testReciveCardsList()
    {
        $client = $this->createSdkClient();
        $request = $this->createListRequest();
        $response = $client->getCardsList($request);
        $this->assertEquals(true, $response->isSuccess());
    }

    /**
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function testReciveCard()
    {
        $client = $this->createSdkClient();
        $request = $this->createCardRequest();
        $response = $client->getCard($request);
        $this->assertEquals(true, $response->isSuccess());
    }

    /**
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function testSaleCard()
    {
        $client = $this->createSdkClient();
        $request = $this->createSaleCardRequest();
        $response = $client->doSaleCard($request);
        $this->assertEquals(true, $response->isSuccess());
    }

    /**
     * @throws \ClientInterface\Exception\ValidationException
     */
    public function testErrors()
    {
        $request = $this->createValidationErrorRequest();
        $request->validate();
        $errors = $request->getErrors();
        $errorData = [
            'entityData' => [
                '{"OnCredit":["Value \"<NULL>\" is null, but non null value was expected."],"Manager":["Value \"<NULL>\" is null, but non null value was expected."]}'
            ]
        ];
        $this->assertEquals(1, count($errors));
        $this->assertEquals($errorData, $errors);
    }

    /**
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function testRecieveContract()
    {
        $client = $this->createSdkClient();
        $request = $this->createRecieveContractRequest();
        $response = $client->getContract($request);
        $this->assertEquals(true, $response->isSuccess());
    }

    /**
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function testCancelCard()
    {
        $client = $this->createSdkClient();
        $request = $this->createCancelCardRequest();
        $response = $client->doCancelCard($request);
        $this->assertEquals(true, $response->isSuccess());
    }

    /**
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function testPaginator()
    {
        $client = $this->createSdkClient();
        $request = $this->createPaginatorRequest();
        $response = $client->getCardsList($request);
        $this->assertEquals(3, count($response->Cards));
        $this->assertEquals(2, $response->Paginator->Page);
        $this->assertEquals(true, $response->isSuccess());
    }

    /**
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function testReturnFields()
    {
        $exceptedKeys = [
            'CompanyId',
            'TemplateId',
        ];
        $client = $this->createSdkClient();
        $request = $this->createReturnFieldsRequest($exceptedKeys);
        $response = $client->getCardsList($request);
        foreach ($response->Cards as $card) {
            $cardArray = array_filter(StructureHelper::toArray($card));
            $actualKeys = array_keys($cardArray);
            $this->assertEquals($exceptedKeys, $actualKeys);
        }
        $this->assertEquals(true, $response->isSuccess());
    }

    private function createPaginatorRequest(): CardsListRequest
    {
        $request = new CardsListRequest();
        $request->filter = [
            'page' => 2,
            'pagesize' => 3,
        ];
        return $request;
    }

    private function createReturnFieldsRequest(array $exceptedKeys): CardsListRequest
    {
        $request = new CardsListRequest();
        $request->fields = $exceptedKeys;
        return $request;
    }

    private function createListRequest(): CardsListRequest
    {
        $request = new CardsListRequest();
        return $request;
    }

    private function createRecieveContractRequest(): ContractRequest
    {
        $request = new ContractRequest();
        $request->fields = [
            'cardid' => 84829,
            'templateid' => 464
        ];
        return $request;
    }

    private function createCardRequest(): EntityRequest
    {
        $request = new EntityRequest();
        $request->setEntityId(84899);
        return $request;
    }

    private function createSaleCardRequest(): EntityRequest
    {
        $now = (new DateTime())->format('Y-m-d H:i');
        $request = new EntityRequest();

        $cardDto = new CardSaleDTO();

        $cardDto->ClientId = 47907;
        $cardDto->SellingDate = $now;
        $cardDto->StartingDate = $now;
        $cardDto->Price = '1440000';
        $cardDto->Time = 2;
        $cardDto->StatusId = 1;
        $cardDto->OnCredit = false;
        $cardDto->Manager = 'Иванов';

        $request->setEntityData($cardDto);
        $request->setEntityId('84879');

        return $request;
    }

    private function createValidationErrorRequest(): EntityRequest
    {
        $now = (new DateTime())->format('Y-m-d H:i');
        $request = new EntityRequest();

        $cardDto = new CardSaleDTO();

        $cardDto->ClientId = 47907;
        $cardDto->SellingDate = $now;
        $cardDto->StartingDate = $now;
        $cardDto->Price = '1440000';
        $cardDto->Time = 2;
        $cardDto->StatusId = 1;

        $request->setEntityData($cardDto);
        $request->setEntityId('84879');

        return $request;
    }

    private function createCancelCardRequest(): EntityRequest
    {
        $request = new EntityRequest();

        $cardDto = new CardCancelDTO();
        $cardDto->StatusId = 0;
        $request->setEntityData($cardDto);
        $request->setEntityId('84879');

        return $request;
    }

    private function createSdkClient(): Client
    {
        $config = new Config('http://sdk.integration.com/api/', 'test', 'test');

        return new Client($config);
    }
}
