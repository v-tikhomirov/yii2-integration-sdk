<?php

namespace Tikhomirov\IntegrationSdk\DTO;

use ClientInterface\Base\StructureHelper;
use ClientInterface\Base\Validate;

abstract class BaseDTO
{
    use Validate;

    public function toArray(): array
    {
        return StructureHelper::toArray($this);
    }

    protected function rules(): array
    {
        return [];
    }
}
