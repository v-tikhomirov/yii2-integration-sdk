<?php

namespace Tikhomirov\IntegrationSdk\Request;

use Assert\Assert;
use Tikhomirov\IntegrationSdk\DTO\CardCancelDTO;
use Tikhomirov\IntegrationSdk\DTO\CardDTO;
use Tikhomirov\IntegrationSdk\DTO\CardSaleDTO;
use Tikhomirov\IntegrationSdk\DTO\ClientDTO;
use Tikhomirov\IntegrationSdk\DTO\TaskDTO;

class EntityRequest extends AbstractRequest
{
    /**
     * @var ClientDTO|TaskDTO|CardDTO|CardSaleDTO|CardCancelDTO
     */
    protected $entityData;

    /**
     * @var string|int|null
     */
    protected $entityId;

    public function setEntityId($entityId): void
    {
        $this->entityId = $entityId;
    }

    public function getEntityId()
    {
        return $this->entityId;
    }

    public function setEntityData($entityData): void
    {
        $this->entityData = $entityData;
    }

    public function getEntityData()
    {
        return $this->entityData;
    }

    protected function rules(): array
    {
        return [
            'justRequired' => [$this->getValidatedParams(), function ($value) {
                Assert::that($value)->notNull();
            }]

        ];
    }

    private function getValidatedParams(): array
    {
        if (!$this->entityData && !$this->entityId) {
            return ['entityData', 'entityId'];
        }
        return [];
    }
}
