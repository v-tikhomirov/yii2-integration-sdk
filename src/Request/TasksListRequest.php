<?php

namespace Tikhomirov\IntegrationSdk\Request;

use ClientInterface\Request;
use Tikhomirov\IntegrationSdk\DTO\TasksListFilterDTO;

class TasksListRequest extends CollectionRequest implements Request
{
    /**
     * @var TasksListFilterDTO|null
     */
    public $filter;

    protected function rules(): array
    {
        return [];
    }
}
