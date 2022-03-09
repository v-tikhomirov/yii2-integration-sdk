<?php

namespace Tikhomirov\IntegrationSdk\Response;

use ClientInterface\Response;

class MessageResponse extends CollectionResponse implements Response
{
    /**
     * @var string
     */
    public $Message;

    public function isSuccess(): bool
    {
        return $this->Message === 'Операция выполнена успешно.';
    }
}
