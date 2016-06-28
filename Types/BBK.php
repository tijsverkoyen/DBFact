<?php

namespace TijsVerkoyen\DBFact\Types;

/**
 * DBFact BBK class
 *
 * @author Jonas De Keukelaere <jonas@sumocoders.be>
 */
class BBK extends BaseObject
{
    /**
     * @var string
     */
    public $Document;

    /**
     * @var string
     */
    public $Relatie;

    /**
     * @var string
     */
    public $Adres1;

    /**
     * @var string
     */
    public $Adres2;

    /**
     * @var string
     */
    public $PostCode;

    /**
     * @var string
     */
    public $Plaats;

    /**
     * @var string
     */
    public $Land;

    /**
     * @var \DateTime
     */
    public $DocumentDatum;

    /**
     * @var \Datetime
     */
    public $LeverDatum;

    /**
     * @var string
     */
    public $Referentie;

    /**
     * @var float
     */
    public $TotaalExcl;

    /**
     * @var float
     */
    public $TotaalBtw;

    /**
     * @var float
     */
    public $TotaalIncl;

    /**
     * @var array
     */
    public $Regel;

    /**
     * Map the properties to a given type.
     *
     * @var array
     */
    protected $typeMap = [
        'DateTime' => [
            'DocumentDatum', 'LeverDatum',
        ],
        'float' => [
            'TotaalExcl', 'TotaalBtw', 'TotaalIncl',
        ],
        'Collection' => [
            'Regel',
        ],
    ];
}
