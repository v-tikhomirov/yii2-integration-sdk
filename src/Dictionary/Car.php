<?php

namespace Tikhomirov\IntegrationSdk\Dictionary;

class Car
{
    /**
     * @var int|null
     */
    public $id;

    /**
     * @var int|null
     */
    public $brandId;

    /**
     * @var string|null
     */
    public $name;

    public function __construct(int $id, int $brandId, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->brandId = $brandId;
    }
}
