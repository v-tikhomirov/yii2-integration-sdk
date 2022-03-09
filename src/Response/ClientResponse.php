<?php

namespace Tikhomirov\IntegrationSdk\Response;

use ClientInterface\Response;

class ClientResponse extends CollectionResponse implements Response
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
     *
     */
    public $Name;

    /**
     * Отчество
     * @var string|null
     */
    public $Patronymic;

    /**
     * ИИдентификатор компании
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
     * @required
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
     * @var int|null
     */
    public $InsurenceId;

    /**
     * Номер полиса
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
     * 1 – Условная
     * 2 – Безусловная
     * @var string|null
     */
    public $Franchise;

    /**
     * Сумма франшизы
     * @var string|null
     */
    public $FranchiseSum;

    public function isSuccess(): bool
    {
        return empty($this->getErrors());
    }
}
