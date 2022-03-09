<?php

namespace Tikhomirov\IntegrationSdk\DTO;

class ClientFilterDTO extends BaseFilterDTO
{
    /**
     * Идентификатор
     * @var int|null
     */
    public $Id;

    /**
     * Фамилия
     * @var string|null
     */
    public $Surname;

    /**
     * Имя
     * @var string|null
     */
    public $Name;

    /**
     * Отчество
     * @var string|null
     */
    public $Patronymic;

    /**
     * Паспорт серия
     * @var string|null
     */
    public $PassportSeries;

    /**
     * Паспорт номер
     * @var string|null
     */
    public $PassportNumber;

    /**
     * VIN
     * @var string|null
     */
    public $VIN;

    /**
     * Идентификатор страховой компании
     * @var string|null
     */
    public $InsurenceId;
}
