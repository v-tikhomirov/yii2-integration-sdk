<?php

namespace Tikhomirov\IntegrationSdk\Response;

use ClientInterface\Response;

class CardResponse extends CollectionResponse implements Response
{
    /**
     * Идентификатор карты
     * @var int|null
     */
    public $Id;

    /**
     * Идентификатор компании
     * @var int|null
     */
    public $CompanyId;

    /**
     * № карты
     * @var string|null
     */
    public $Item;

    /**
     * Идентификатор шаблона карты
     * @var int|null
     */
    public $TemplateId;

    /**
     * Идентификатор клиента
     * @var int|null
     */
    public $ClientId;

    /**
     * Дата продажи
     * @var string|null
     */
    public $SellingDate;

    /**
     * Дата начала
     * @var string|null
     */
    public $StartingDate;

    /**
     * Стоимость (руб.)
     * @var float|null
     */
    public $Price;

    /**
     * Срок (лет)
     * @var int|null
     */
    public $Time;

    /**
     * Идентификатор статуса
     * @var int|null
     */
    public $StatusId;

    /**
     * История
     * @var string|null
     */
    public $History;

    /**
     * Дата окончания
     * @var string|null
     */
    public $EndingDate;

    /**
     * ФИО менеджера
     * @var string|null
     */
    public $Manager;

    /**
     * В кредит
     * @var bool|null
     */
    public $OnCredit;

    /**
     * Список имен шаблонов договоров
     * @var string|null
     */
    public $Templates;

    /**
     * Идентификаторы шаблонов договоров
     * @var string|null
     */
    public $TemplateIds;
}
