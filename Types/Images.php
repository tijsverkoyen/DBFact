<?php

namespace TijsVerkoyen\DBFact\Types;

/**
 * DBFact Images class
 *
 * @author Tijs Verkoyen <php-dbfact@verkoyen.eu>
 */
class Images extends BaseObject
{
    /**
     * @var string
     */
    public $Tml_BaseArt;

    /**
     * @var array
     */
    public $Image;

    /**
     * Map the properties to a given type
     *
     * @var array
     */
    protected $typeMap = [
        'Collection' => [
            'Image',
        ],
    ];
}
