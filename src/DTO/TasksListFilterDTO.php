<?php

namespace Tikhomirov\IntegrationSdk\DTO;

class TasksListFilterDTO extends BaseFilterDTO
{
    public const INCLUDE_PRIORITY = 'priority';
    public const INCLUDE_SERVICE = 'service';
    public const INCLUDE_STATUS = 'status';

    /**
     * @var string|null
     */
    public $serviceid;

    /**
     * @var string|null
     */
    public $search;

    /**
     * @var string|null
     */
    public $include;
}
