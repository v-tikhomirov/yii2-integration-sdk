<?php

namespace Tikhomirov\IntegrationSdk\Request;

use ClientInterface\Request;
use Tikhomirov\IntegrationSdk\DTO\ClientFilterDTO;
use Tikhomirov\IntegrationSdk\DTO\TasksListFilterDTO;

class ContractRequest extends CollectionRequest
{
    protected function rules(): array
    {
        return [];
    }
}
