<?php

namespace TijsVerkoyen\DBFact\Types;

use DateTime;
use SimpleXMLElement;
use TijsVerkoyen\DBFact\DBFact;

/**
 * DBFact BaseObject class
 *
 * @author Tijs Verkoyen <php-dbfact@verkoyen.eu>
 */
class BaseObject
{
    const TYPE_LOCATION = 'TijsVerkoyen\\DBFact\\Types\\';

    /**
     * Map the properties to a given type
     *
     * @var array
     */
    protected $typeMap = [];

    /**
     * @param string $type
     *
     * @return bool
     */
    protected function isTypeMapped($type)
    {
        return isset($this->typeMap[$type]);
    }

    /**
     * @param $type
     *
     * @return array
     */
    protected function getMappedVariablesForType($type)
    {
        if (!$this->isTypeMapped($type)) {
            return [];
        }

        return $this->typeMap[$type];
    }

    /**
     * @param $name
     * @param $type
     *
     * @return bool
     */
    protected function isVariableTypeOf($name, $type)
    {
        return in_array($name, $this->getMappedVariablesForType($type));
    }

    /**
     * @param $string
     *
     * @return DateTime
     */
    protected function createDateTimeFromString($string)
    {
        $day = (int) substr($string, 6, 2);
        $month = (int) substr($string, 4, 2);
        $year = (int) substr($string, 0, 4);

        if (substr_count($string, '/') > 0) {
            $day = (int) substr($string, 0, 2);
            $month = (int) substr($string, 3, 2);
            $year = (int) substr($string, 6, 4);
        }

        if ($month == 0 || $day == 0 || $year == 0) {
            return;
        }

        $date = new DateTime();
        $date->setDate($year, $month, $day);
        $date->setTime(0, 0, 0);

        return $date;
    }

    protected static function getPossibleMappedTypes()
    {
        return [
            'array',
            'bool',
            'float',
            'int',
            'DateTime',
            'Custom',
            'Collection'
        ];
    }

    protected function getMappedTypeForName($name)
    {
        foreach (self::getPossibleMappedTypes() as $type) {
            if ($this->isVariableTypeOf($name, $type)) {
                return $type;
            }
        }
    }

    /**
     * Initialize the object
     *
     * @param SimpleXMLElement $xml
     */
    public function initialize(SimpleXMLElement $xml)
    {
        foreach ($xml as $property) {
            $name = (string) $property->getName();
            $value = $property;

            // Transform the value to the correct type.
            switch ($this->getMappedTypeForName($name)) {
                case 'array':
                    $items = [];
                    foreach ($property as $item) {
                        $itemName = (string) $item->getName();
                        $items[] = DBFact::convertToObject(
                            $item,
                            self::TYPE_LOCATION . $itemName
                        );
                    }
                    $value = $items;
                    break;
                case 'bool':
                    $value = (strtolower($value) == 'true');
                    break;
                case 'float':
                    $value = (float) str_replace(',', '.', $value);
                    break;
                case 'int':
                    $value = (int) $value;
                    break;
                case 'DateTime':
                    $value = $this->createDateTimeFromString($value);
                    break;
                case 'Custom':
                    $value = DBFact::convertToObject($property, self::TYPE_LOCATION . $name);
                    break;
                case 'Collection':
                    $items = [];
                    foreach ($xml->{$name} as $item) {
                        $itemName = (string) $item->getName();
                        $items[] = DBFact::convertToObject(
                            $item,
                            self::TYPE_LOCATION . $itemName
                        );
                    }
                    $value = $items;
                    break;
                default:
                    $value = (string) $value;
                    if ($value == '') {
                        $value = null;
                    }
            }

            $this->{$name} = $value;
        }
    }
}
