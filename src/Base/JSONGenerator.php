<?php

namespace Tikhomirov\IntegrationSdk\Base;

use Tikhomirov\IntegrationSdk\Request\AbstractRequest;

class JSONGenerator
{
    public function getJSON(AbstractRequest $request): ?string
    {
        $arrayData = $request->toArray();

        return json_encode($arrayData) ?: null;
    }
}
