<?php

namespace Tikhomirov\IntegrationSdk\Response;

use Tikhomirov\IntegrationSdk\DTO\PaginatorDTO;

abstract class CollectionResponse extends AbstractResponse
{
    /**
     * @var PaginatorDTO|null
     */
    public $Paginator;
}
