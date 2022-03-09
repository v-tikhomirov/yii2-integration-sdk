<?php

namespace Tikhomirov\IntegrationSdk\Response;

use ClientInterface\Response;
use Tikhomirov\IntegrationSdk\DTO\CardDTO;

class CardsListResponse extends CollectionResponse implements Response
{
    /**
     * @var CardDTO[]|null
     */
    public $Cards;

    public $Discount;
}
