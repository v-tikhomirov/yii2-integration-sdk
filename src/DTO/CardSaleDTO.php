<?php

namespace Tikhomirov\IntegrationSdk\DTO;

use Assert\Assert;

class CardSaleDTO extends CardDTO
{
    const VALIDATED_PARAMS = [
        'ClientId',
        'SellingDate',
        'StatusId',
        'StartingDate',
        'Price',
        'Time',
        'OnCredit',
        'Manager',
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
