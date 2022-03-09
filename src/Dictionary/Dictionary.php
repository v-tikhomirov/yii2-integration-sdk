<?php

namespace Tikhomirov\Dictionary;

class Dictionary
{
    private const DICTIONARY_PATH = 'dictionary';
    private const DICTIONARY_NAME_BRANDS = 'brands';
    private const DICTIONARY_NAME_CITIES = 'cities';
    private const DICTIONARY_NAME_CARS = 'cars';

    /**
     * @return Brand[]
     */
    public function getBrands(): array
    {
        $result = [];

        foreach ($this->getDictionaryContent(self::DICTIONARY_NAME_BRANDS) as $entityData) {
            $result[] = new Brand($entityData['id'], $entityData['name']);
        }

        return $result;
    }

    /**
     * @return City[]
     */
    public function getCities(): array
    {
        $result = [];

        foreach ($this->getDictionaryContent(self::DICTIONARY_NAME_CITIES) as $entityData) {
            $result[] = new City($entityData['id'], $entityData['name'], $entityData['kladr']);
        }

        return $result;
    }

    /**
     * @return Car[]
     */
    public function getCars(): array
    {
        $result = [];

        foreach ($this->getDictionaryContent(self::DICTIONARY_NAME_CARS) as $entityData) {
            $result[] = new Car($entityData['id'], $entityData['brandId'], $entityData['name']);
        }

        return $result;
    }

    private function getDictionaryContent($dictionary): array
    {
        $fileName = __DIR__ . '/' . self::DICTIONARY_PATH . '/' . $dictionary . '.php';

        return file_exists($fileName) ? require $fileName : [];
    }
}
