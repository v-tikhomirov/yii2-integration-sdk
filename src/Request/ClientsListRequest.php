<?php

namespace Tikhomirov\IntegrationSdk\Request;

use ClientInterface\Request;
use Tikhomirov\IntegrationSdk\DTO\ClientFilterDTO;

class ClientsListRequest extends CollectionRequest implements Request
{
    /**
     * @var ClientFilterDTO|null
     */
    public $filter;

    protected function rules(): array
    {
        return [];
    }
}
