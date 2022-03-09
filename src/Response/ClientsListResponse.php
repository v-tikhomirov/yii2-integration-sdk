<?php

namespace Tikhomirov\IntegrationSdk\Response;

use ClientInterface\Response;
use Tikhomirov\IntegrationSdk\DTO\ClientDTO;

class ClientsListResponse extends CollectionResponse implements Response
{
    /**
     * @var ClientDTO[]|null
     */
    public $Clients;
}
