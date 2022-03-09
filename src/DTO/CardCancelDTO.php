<?php

namespace Tikhomirov\IntegrationSdk\DTO;

use Assert\Assert;

class CardCancelDTO extends CardDTO
{
    const VALIDATED_PARAMS = [
        'StatusId',
    ];

    protected function rules(): array
    {
        return [
            'justRequired' => [self::VALIDATED_PARAMS, function ($value) {
                Assert::that($value)->notNull($value);
            }],
        ];
    }
}
