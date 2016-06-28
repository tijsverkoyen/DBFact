<?php

namespace TijsVerkoyen\DBFact\Types;

/**
 * DBFact Statussen class
 *
 * @author Jonas De Keukelaere <jonas@sumocoders.be>
 */
class Statussen extends BaseObject
{
    /**
     * @var array
     */
    public $Status;

    protected $typeMap = [
        'Collection' => [
            'Status',
        ],
    ];
}
