<?php

namespace Tikhomirov\IntegrationSdk\Response;

use ClientInterface\Response;

class ContractResponse extends AbstractResponse implements Response
{
    /**
     * @var string
     */
    public $fileContent;

    public $headers;

    public function isSuccess(): bool
    {
        return !empty($this->fileContent);
    }
}
