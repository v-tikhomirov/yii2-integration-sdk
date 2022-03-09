<?php

namespace Tikhomirov\IntegrationSdk\Request;

use ClientInterface\Base\Validate;
use ClientInterface\Base\StructureHelper;

trait BaseRequestTrait
{
    use Validate;

    public function toArray(): array
    {
        return StructureHelper::toArray($this);
    }
}
