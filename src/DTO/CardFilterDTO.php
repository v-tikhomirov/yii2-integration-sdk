<?php

namespace Tikhomirov\IntegrationSdk\DTO;

class CardFilterDTO extends BaseFilterDTO
{
    /**
     * Идентификатор компании
     * @var int|null
     */
    public $CompanyId;

    /**
     * № карты
     * @var string|null
     */
    public $Item;

    /**
     * Идентификатор клиента
     * @var int|null
     */
    public $ClientId;

    /**
     * Идентификатор статуса
     * @var int|null
     */
    public $StatusId;
}
