<?php

namespace Tikhomirov\IntegrationSdk\Response;

use ClientInterface\Base\PhpDocReader\AnnotationException;
use ClientInterface\Base\StructureHelper;
use ClientInterface\Response;
use ReflectionException;

abstract class AbstractResponse implements Response
{
    /**
     * @var array
     */
    private $errors = [];

    /**
     * @param array $rawData
     * @throws AnnotationException
     * @throws ReflectionException
     */
    public function fill(array $rawData): void
    {
        StructureHelper::fill($this, $rawData, false);
    }

    public function isSuccess(): bool
    {
        return true;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setErrors(array $errors): array
    {
        return $this->errors = $errors;
    }
}
