<?php

namespace Tikhomirov\IntegrationSdk\DTO;

use Assert\Assert;

class ClientDTO extends BaseDTO
{
    /**
     * Идентификатор
     * @var int|null
     */
    public $Id;

    /**
     * Фамилия
     * @var string|null
     * @required
     */
    public $Surname;

    /**
     * Имя
     * @var string|null
     * @required
     */
    public $Name;

    /**
     * Отчество
     * @var string|null
     */
    public $Patronymic;

    /**
     * Идентификатор компании
     * @var int|null
     */
    public $CompanyId;

    /**
     * Дата рождения
     * @var string|null
     */
    public $BirthDate;

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
     * Кем выдан
     * @var string|null
     */
    public $IssuedBy;

    /**
     * Дата выдачи
     * @var string|null
     */
    public $IssueDate;

    /**
     * Адрес места жительства
     * @var string|null
     */
    public $ResidenceAddress;

    /**
     * Телефон клиента
     * @var string|null
     */
    public $Phone;

    /**
     * Другая контактная информация
     * @var string|null
     */
    public $OtherInfo;

    /**
     * Примечание
     * @var string|null
     */
    public $Note;

    /**
     * Идентификатор карты
     * @var int|null
     */
    public $CardId;

    /**
     * Идентификатор города
     * @var int|null
     * @required
     */
    public $CityId;

    /**
     * Идентификатор модели автомобиля
     * @var int|null
     */
    public $CarModelId;

    /**
     * Регистрационный номер
     * @var string|null
     */
    public $RegistrationNumber;

    /**
     * Год выпуска
     * @var int|null
     */
    public $Year;

    /**
     * VIN
     * @var string|null
     */
    public $VIN;

    /**
     * Программа страхования
     *   1 – ОСАГО
     *   2 - КАСКО
     * @var int|null
     */
    public $InsurenceId;

    /**
     * № полиса
     * @var string|null
     */
    public $InsurenceNumber;

    /**
     * Страховая компания
     * @var string|null
     */
    public $InsurenceCompany;

    /**
     * Франшиза
     *   1 – Условная
     *   2 – Безусловная
     * @var string|null
     */
    public $Franchise;

    /**
     * Сумма франшизы
     * @var string|null
     */
    public $FranchiseSum;

    protected function rules(): array
    {
        return [
            'justRequired' => [['Surname', 'Name', 'CityId'], function ($value) {
                Assert::that($value)->notEmpty();
            }],
        ];
    }
}
