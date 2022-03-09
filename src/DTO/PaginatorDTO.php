<?php

namespace Tikhomirov\IntegrationSdk\DTO;

class PaginatorDTO extends BaseDTO
{
    /**
     * Общее число ресурсов в коллекции
     * @var int|null
     */
    public $Count;

    /**
     * Номер отображаемой страницы
     * @var int|null
     */
    public $Page;

    /**
     * Количество страниц
     * @var int|null
     */
    public $PageCount;

    /**
     * Количество ресурсов на странице
     * @var int|null
     */
    public $PageSize;

    /**
     * Возвращенное количество ресурсов на странице
     * @var int|null
     */
    public $CountOnPage;
}
