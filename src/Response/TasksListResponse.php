<?php

namespace Tikhomirov\IntegrationSdk\Response;

use ClientInterface\Response;
use Tikhomirov\IntegrationSdk\DTO\PriorityDTO;
use Tikhomirov\IntegrationSdk\DTO\StatusDTO;
use Tikhomirov\IntegrationSdk\DTO\TaskDTO;

class TasksListResponse extends CollectionResponse implements Response
{
    /**
     * @var TaskDTO[]|null
     */
    public $Tasks;

    /**
     * @var StatusDTO[]|null
     */
    public $Statuses;

    /**
     * @var PriorityDTO[]|null
     */
    public $Priorities;
}
