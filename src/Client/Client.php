<?php

namespace Tikhomirov\IntegrationSdk\Client;

use ClientInterface\Base\PhpDocReader\AnnotationException;
use ClientInterface\Base\StructureHelper;
use ClientInterface\Client as ClientInterface;
use GuzzleHttp\Client as TransportClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\BadResponseException;
use Psr\Http\Message\ResponseInterface;
use ReflectionException;
use Tikhomirov\IntegrationSdk\Base\JSONGenerator;
use Tikhomirov\IntegrationSdk\Request\AbstractRequest;
use Tikhomirov\IntegrationSdk\Request\ClientsListRequest;
use Tikhomirov\IntegrationSdk\Request\CollectionRequest;
use Tikhomirov\IntegrationSdk\Request\EntityRequest;
use Tikhomirov\IntegrationSdk\Request\ContractRequest;
use Tikhomirov\IntegrationSdk\Request\TasksListRequest;
use Tikhomirov\IntegrationSdk\Request\CardsListRequest;
use Tikhomirov\IntegrationSdk\Response\AbstractResponse;
use Tikhomirov\IntegrationSdk\Response\CardResponse;
use Tikhomirov\IntegrationSdk\Response\ClientsListResponse;
use Tikhomirov\IntegrationSdk\Response\CollectionResponse;
use Tikhomirov\IntegrationSdk\Response\ContractResponse;
use Tikhomirov\IntegrationSdk\Response\MessageResponse;
use Tikhomirov\IntegrationSdk\Response\TasksListResponse;
use Tikhomirov\IntegrationSdk\Response\ClientResponse;
use Tikhomirov\IntegrationSdk\Response\CardsListResponse;
use Tikhomirov\IntegrationSdk\Response\FileResponse;

class Client implements ClientInterface
{
    use ErrorHadler;

    /**
     * Endpoint заявок
     */
    private const PATH_TASKS = 'task';

    /**
     * Endpoint клиентов
     */
    private const PATH_CLIENTS = 'client';

    /**
     * Endpoint карт
     */
    private const PATH_CARDS = 'card';

    /**
     * Endpoint для получения заполненного договора
     */
    private const PATH_CONTRACT = 'contractcard';

    /**
     * Endpoint загрузки документов
     */
    private const PATH_CARDFILE = 'CardFile';

    private const METHOD_GET = 'GET';
    private const METHOD_POST = 'POST';
    private const METHOD_PUT = 'PUT';

    /**
     * @var TransportClient
     */
    private $transport;

    /**
     * @var Config
     */
    private $config;

    /**
     * @var JSONGenerator
     */
    private $jsonGenerator;

    /**
     * @var array
     */
    private $lastRequest = [];

    /**
     * @var array
     */
    private $lastResponse = [];

    /**
     * Client constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->jsonGenerator = new JSONGenerator();

        $this->initTransport();
    }

    public function getTransport(): TransportClient
    {
        return $this->transport;
    }

    /**
     * @param TasksListRequest $request
     * @return TasksListResponse
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function getTasksList(TasksListRequest $request): TasksListResponse
    {
        return $this->makeCollectionRequest(self::METHOD_GET, self::PATH_TASKS, $request, new TasksListResponse());
    }

    /**
     * @param ClientsListRequest $request
     * @return ClientsListResponse
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function getClientsList(ClientsListRequest $request): ClientsListResponse
    {
        return $this->makeCollectionRequest(self::METHOD_GET, self::PATH_CLIENTS, $request, new ClientsListResponse());
    }

    /**
     * @param CardsListRequest $request
     * @return CardsListResponse
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function getCardsList(CardsListRequest $request): CardsListResponse
    {
        return $this->makeCollectionRequest(self::METHOD_GET, self::PATH_CARDS, $request, new CardsListResponse());
    }

    /**
     * @param EntityRequest $request
     * @return CardResponse
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function getCard(EntityRequest $request): CardResponse
    {
        $cardId = $request->getEntityId();
        $path = self::PATH_CARDS . '/' . $cardId;
        return $this->makeRequest(self::METHOD_GET, $path, $request, new CardResponse());
    }

    /**
     * @param EntityRequest $request
     * @return MessageResponse
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function doCancelCard(EntityRequest $request): MessageResponse
    {
        $cardId = $request->getEntityId();
        $path = self::PATH_CARDS . '/' . $cardId;
        return $this->makeCreateRequest(self::METHOD_PUT, $path, $request, new MessageResponse());
    }

    /**
     * @param EntityRequest $request
     * @return MessageResponse
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function doSaleCard(EntityRequest $request): MessageResponse
    {
        $cardId = $request->getEntityId();
        $path = self::PATH_CARDS . '/' . $cardId;
        return $this->makeCreateRequest(self::METHOD_PUT, $path, $request, new MessageResponse());
    }

    /**
     * @param EntityRequest $request
     * @return ClientResponse
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function getClient(EntityRequest $request): ClientResponse
    {
        $clientId = $request->getEntityId();
        $path = self::PATH_CLIENTS . '/' . $clientId;
        return $this->makeRequest(self::METHOD_GET, $path, $request, new ClientResponse());
    }

    /**
     * @param ContractRequest $request
     * @return ContractResponse
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function getContract(ContractRequest $request): ContractResponse
    {
        return $this->makeContractRequest(self::METHOD_GET, self::PATH_CONTRACT, $request, new ContractResponse());
    }

    /**
     * @param EntityRequest $request
     * @return ClientResponse
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function doAddClient(EntityRequest $request): ClientResponse
    {
        return $this->makeCreateRequest(self::METHOD_POST, self::PATH_CLIENTS, $request, new ClientResponse());
    }

    /**
     * @param EntityRequest $request
     * @return ClientResponse
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function doSendFiles(EntityRequest $request): FileResponse
    {
        return $this->makeFileRequest(self::METHOD_POST, self::PATH_CARDFILE, $request, new FileResponse());
    }

    /**
     * @param EntityRequest $request
     * @return ClientResponse
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function doLinkFiles(EntityRequest $request): MessageResponse
    {
        $cardId = $request->getEntityId();
        $path = self::PATH_CARDS . '/' . $cardId;
        return $this->makeCreateRequest(self::METHOD_PUT, $path, $request, new MessageResponse());
    }

    public function getLastRequest(): array
    {
        return $this->lastRequest;
    }

    public function getLastResponse(): array
    {
        return $this->lastResponse;
    }

    /**
     * @param string $method
     * @param string $path
     * @param AbstractRequest $request
     * @param AbstractResponse $response
     * @return mixed|AbstractResponse
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    private function makeCreateRequest(string $method, string $path, EntityRequest $request, AbstractResponse $response)
    {
        $params = $request->getEntityData()->toArray();

        return $this->makeRequestCommon(
            $this->initTransportRequest($method, $path, [], $params),
            $response
        );
    }

    /**
     * @param string $method
     * @param string $path
     * @param CollectionRequest $request
     * @param CollectionResponse $response
     * @return AbstractResponse|mixed
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    private function makeCollectionRequest(string $method, string $path, CollectionRequest $request, CollectionResponse $response): AbstractResponse
    {
        $get = [];
        $params = StructureHelper::toArray($request);
        $get = array_merge($get, $params['pagination'] ?? []);
        unset($params['pagination']);

        $get = array_merge($get, $params['filter'] ?? []);
        unset($params['filter']);

        $get['fields'] = implode(',', $params['fields'] ?? []);
        unset($params['fields']);

        return $this->makeRequestCommon(
            $this->initTransportRequest($method, $path, $get, $params),
            $response
        );
    }

    /**
     * @param string $method
     * @param string $path
     * @param AbstractRequest $request
     * @param AbstractResponse $response
     * @return mixed|AbstractResponse
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    private function makeFileRequest(string $method, string $path, EntityRequest $request, AbstractResponse $response): AbstractResponse
    {
        $params = $request->getEntityData();

        return $this->makeSendFileRequest(
            $this->initTransportRequest($method, $path, [], $params),
            $response
        );
    }

    /**
     * @param string $method
     * @param string $path
     * @param ContractRequest $request
     * @param ContractResponse $response
     * @return ContractResponse
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    private function makeContractRequest(string $method, string $path, ContractRequest $request, ContractResponse $response): ContractResponse
    {
        $params = StructureHelper::toArray($request);
        $get = $params['fields'] ?? [];

        return $this->makeDownloadFileRequest(
            $this->initTransportRequest($method, $path, $get, []),
            $response
        );
    }

    /**
     * @param string $method
     * @param string $path
     * @param AbstractRequest $request
     * @param AbstractResponse $response
     * @return mixed|AbstractResponse
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    private function makeRequest(string $method, string $path, AbstractRequest $request, AbstractResponse $response): AbstractResponse
    {
        $params = StructureHelper::toArray($request);

        return $this->makeRequestCommon($this->initTransportRequest($method, $path, [], $params), $response);
    }

    /**
     * @param TransportRequest $request
     * @param AbstractResponse $response
     * @return AbstractResponse|mixed
     * @throws GuzzleException
     * @throws AnnotationException
     * @throws ReflectionException
     */
    private function makeRequestCommon(TransportRequest $request, AbstractResponse $response): AbstractResponse
    {
        try {
            $rawResponse = $this->sendRequest($request);
        } catch (BadResponseException $e) {
            $rawContent = $e->getResponse()->getBody()->getContents();
            $this->lastResponse = json_decode($rawContent, true);
            $response->setErrors($this->getErrors($rawContent));
            return $response;
        }
        $rawContent = $rawResponse->getBody()->getContents();
        $responseContent = json_decode($rawContent, true);
        $this->lastResponse = $responseContent;
        $response->fill($responseContent);

        return $response;
    }

    /**
     * @param TransportRequest $request
     * @param ContractResponse $response
     * @return ContractResponse|mixed
     * @throws AnnotationException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    private function makeDownloadFileRequest(TransportRequest $request, ContractResponse $response): ContractResponse
    {
        try {
            $rawResponse = $this->sendRequest($request);
        } catch (BadResponseException $e) {
            $response->setErrors($this->getErrors($e));
            return $response;
        }
        $responseContent = [
            'fileContent' => $rawResponse->getBody()->getContents(),
        ];
        $this->lastResponse = $responseContent;
        $response->fill($responseContent);
        $response->headers = $rawResponse->getHeaders();

        return $response;
    }

    /**
     * @param TransportRequest $request
     * @param AbstractResponse $response
     * @return AbstractResponse|mixed
     * @throws GuzzleException
     * @throws AnnotationException
     * @throws ReflectionException
     */
    private function makeSendFileRequest(TransportRequest $request, AbstractResponse $response): AbstractResponse
    {
        try {
            $rawResponse = $this->sendFileRequest($request);
        } catch (BadResponseException $e) {
            $rawContent = $e->getResponse()->getBody()->getContents();
            $this->lastResponse = json_decode($rawContent, true);
            $response->setErrors($this->getErrors($rawContent));
            return $response;
        }
        $rawContent = $rawResponse->getBody()->getContents();
        $responseContent = json_decode($rawContent, true);
        $this->lastResponse = $responseContent;
        $response->fill($responseContent);

        return $response;
    }

    private function initTransport(): void
    {
        $this->transport = new TransportClient();
    }

    private function initTransportRequest(string $method, string $path, array $get = [], array $post = []): TransportRequest
    {
        $request = new TransportRequest();

        $request->setMethod($method);
        $request->setPath($path);
        $request->setQueryParams($get);
        $request->setBody($post);

        return $request;
    }

    /**
     * @param TransportRequest $request
     * @param string $path
     * @return ResponseInterface|mixed
     * @throws GuzzleException
     */
    private function sendRequest(TransportRequest $request): ResponseInterface
    {
        $path = $request->getPath();

        $this->lastRequest = [
            'request' => $request->getBody(),
            'path' => $path,
            'queryParams' => $request->getQueryParams(),
        ];

        $rawResponse = $this->transport->request(
            $request->getMethod(),
            $this->config->getBaseUri() . $path,
            [
                'query' => $request->getQueryParams(),
                'json' => $request->getBody(),
                'auth' => [$this->config->getLogin(), $this->config->getPassword()],
            ]
        );
        return $rawResponse;
    }

    /**
     * @param TransportRequest $request
     * @param string $path
     * @return ResponseInterface|mixed
     * @throws GuzzleException
     */
    private function sendFileRequest(TransportRequest $request): ResponseInterface
    {
        $path = $request->getPath();

        $this->lastRequest = [
            'request' => $request->getBodyWithoutFileContents() ?? null,
            'path' => $path,
            'queryParams' => $request->getQueryParams() ?? null,
        ];
        $rawResponse = $this->transport->request(
            $request->getMethod(),
            $this->config->getBaseUri() . $path,
            [
                'query' => $request->getQueryParams() ?? null,
                'multipart' => $request->getBody() ?? null,
                'auth' => [$this->config->getLogin(), $this->config->getPassword()] ?? null,
            ]
        );
        return $rawResponse;
    }
}
