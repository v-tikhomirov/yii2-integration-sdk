<?php

namespace Tikhomirov\IntegrationSdk\Request;

use Tikhomirov\IntegrationSdk\DTO\BaseFilterDTO;
use Tikhomirov\IntegrationSdk\DTO\PaginationDTO;

abstract class CollectionRequest extends AbstractRequest
{
    /**
     * @var BaseFilterDTO
     */
    public $filter;

    /**
     * @var array[]
     */
    public $fields;

    /**
     * @var PaginationDTO
     */
    public $pagination;

    protected function rules(): array
    {
        return [];
    }
}
