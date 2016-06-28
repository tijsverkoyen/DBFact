<?php

namespace TijsVerkoyen\DBFact\Types;

/**
 * DBFact Appendices class
 *
 * @author Tijs Verkoyen <php-dbfact@verkoyen.eu>
 */
class Appendices extends BaseObject
{
    /**
     * @var string
     */
    public $Tml_BaseArt;

    /**
     * @var array
     */
    public $Appendix;

    /**
     * Map the properties to a given type
     *
     * @var array
     */
    protected $typeMap = [
        'Collection' => [
            'Appendix',
        ],
    ];
}
