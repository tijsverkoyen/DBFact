<?php

namespace TijsVerkoyen\DBFact\Types;

use TijsVerkoyen\DBFact\DBFact;

/**
 * DBFact BaseObject class
 *
 * @author Tijs Verkoyen <php-dbfact@verkoyen.eu>
 */
class BaseObject
{
    /**
     * Map the properties to a given type
     *
     * @var array
     */
    protected $typeMap = [];

    /**
     * Initialize the object
     *
     * @param SimpleXMLElement $xml
     */
    public function initialize(\SimpleXMLElement $xml)
    {
        foreach ($xml as $property) {
            $name = (string) $property->getName();
            $value = $property;

            if (isset($this->typeMap['array']) && in_array($name, $this->typeMap['array'])) {
                $items = [];
                foreach ($property as $item) {
                    $itemName = (string) $item->getName();
                    $items[] = DBFact::convertToObject(
                        $item,
                        'TijsVerkoyen\\DBFact\\Types\\' . $itemName
                    );
                }
                $value = $items;
            } elseif (isset($this->typeMap['bool']) && in_array($name, $this->typeMap['bool'])) {
                $value = (strtolower($value) == 'true');
            } elseif (isset($this->typeMap['float']) && in_array($name, $this->typeMap['float'])) {
                $value = (float) str_replace(',', '.', $value);
            } elseif (isset($this->typeMap['int']) && in_array($name, $this->typeMap['int'])) {
                $value = (int) $value;
            } elseif (isset($this->typeMap['DateTime']) && in_array($name, $this->typeMap['DateTime'])) {
                if (substr_count($value, '/') > 0) {
                    $day = (int) substr($value, 0, 2);
                    $month = (int) substr($value, 3, 2);
                    $year = (int) substr($value, 6, 4);
                } else {
                    $day = (int) substr($value, 6, 2);
                    $month = (int) substr($value, 4, 2);
                    $year = (int) substr($value, 0, 4);
                }
                if ($month == 0 || $day == 0 || $year == 0) {
                    $value = null;
                } else {
                    $value = new \DateTime();
                    $value->setDate($year, $month, $day);
                    $value->setTime(0, 0, 0);
                }
            } elseif (isset($this->typeMap['Custom']) && in_array($name, $this->typeMap['Custom'])) {
                $value = DBFact::convertToObject(
                    $property,
                    'TijsVerkoyen\\DBFact\\Types\\' . $name
                );
            } elseif (isset($this->typeMap['Collection']) && in_array($name, $this->typeMap['Collection'])) {
                $items = [];
                foreach ($xml->{$name} as $item) {
                    $itemName = (string) $item->getName();
                    $items[] = DBFact::convertToObject(
                        $item,
                        'TijsVerkoyen\\DBFact\\Types\\' . $itemName
                    );
                }
                $value = $items;
            } else {
                $value = (string) $value;
                if ($value == '') {
                    $value = null;
                }
            }

            $this->{$name} = $value;
        }
    }
}
