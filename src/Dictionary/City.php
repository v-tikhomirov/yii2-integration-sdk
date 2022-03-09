<?php

namespace Tikhomirov\IntegrationSdk\Dictionary;

class City
{
    /**
     * @var int|null
     */
    public $id;

    /**
     * @var string|null
     */
    public $name;

    /**
     * @var string|null
     */
    public $kladr;

    public function __construct(int $id, string $name, ?string $kladr)
    {
        $this->id = $id;
        $this->name = $name;
        $this->kladr = $kladr;
    }
}
