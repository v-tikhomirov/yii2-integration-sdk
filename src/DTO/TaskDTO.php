<?php

namespace Tikhomirov\IntegrationSdk\DTO;

class TaskDTO extends BaseDTO
{
    /**
     * Идентификатор заявки
     * @var int|null
     * @required
     */
    public $Id;

    /**
     * Идентификатор приоритета
     * @var int|null
     */
    public $PriorityId;

    /**
     * Идентификатор статуса
     * @var int|null
     */
    public $StatusId;

    /**
     * Идентификатор сервиса
     * @var int|null
     */
    public $ServiceId;

    /**
     * Идентификатор родительской заявки
     * @var int|null
     */
    public $ParentId;

    /**
     * Название
     * @var string|null
     * @required
     */
    public $Name;

    /**
     * Описание
     * @var string|null
     * @required
     */
    public $Description;

    /**
     * Срок
     * @var string|null
     */
    public $Deadline;

    /**
     * Дата создания
     * @var string|null
     */
    public $Created;

    /**
     * Дата изменения
     * @var string|null
     */
    public $Changed;

    /**
     * Идентификатор заявителя
     * @var int|null
     */
    public $CreatorId;

    /**
     * Идентификатор пользователя
     * @var int|null
     */
    public $EditorId;

    /**
     * Список исполнителей
     * @var string|null
     * @required
     */
    public $Executors;

    /**
     * Список наблюдателей
     * @var string|null
     */
    public $ObserverIds;

    /**
     * Список имен файлов
     * @var string|null
     * @required
     */
    public $Files;

    /**
     * Идентификаторы файлов
     * @var string|null
     */
    public $FileIds;

    /**
     * Стоимость
     * @var float|null
     */
    public $Price;

    /**
     * Идентификатор типа
     * @var int|null
     */
    public $TypeId;

    /**
     * Срок выполнения
     * @var bool|null
     */
    public $ResolutionOverdue;

    /**
     * Значение дополнительных полей заявки в виде xml
     * @var string|null
     * @required
     */
    public $Data;

    /**
     * Дата оплаты
     * @var string|null
     */
    public $PayDay;

    /**
     * Себестоимость
     * @var float|null
     */
    public $Cost;

    /**
     * Идентификатор клиента
     * @var int|null
     */
    public $ClientId;

    /**
     * Идентификатор карты клиента
     * @var int|null
     */
    public $CardId;

    /**
     * Идентификатор города
     * @var int|null
     */
    public $CityId;

    /**
     * N от страховой
     * @var string|null
     */
    public $NumberFromInsurance;

    /**
     * Идентификатор страховой компании
     * @var int|null
     */
    public $InsurenceCompanyId;
}
