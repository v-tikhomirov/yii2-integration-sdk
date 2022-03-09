<?php

namespace Tikhomirov\IntegrationSdk\Response;

use ClientInterface\Response;

class FileResponse extends CollectionResponse implements Response
{
    /**
     * Идентификатор файла в строке
     * @var string|null
     */
    public $FileTokens;
}
