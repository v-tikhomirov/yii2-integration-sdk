<?php

namespace Tikhomirov\IntegrationSdk\Request;

use ClientInterface\Request;
use Tikhomirov\IntegrationSdk\DTO\CardFilterDTO;

class CardsListRequest extends CollectionRequest implements Request
{
    /**
     * @var CardFilterDTO|null
     */
    public $filter;

    protected function rules(): array
    {
        return [];
    }
}
