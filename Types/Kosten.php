<?php

namespace TijsVerkoyen\DBFact\Types;

/**
 * DBFact Kosten class
 *
 * @author Tijs Verkoyen <php-dbfact@verkoyen.eu>
 */
class Kosten extends BaseObject
{
    /**
     * @var float
     */
    public $Bebat;

    /**
     * @var float
     */
    public $Recupel;

    /**
     * @var float
     */
    public $Auteur;

    /**
     * @var float
     */
    public $Reprobel;

    /**
     * @var float
     */
    public $FostPlus;

    /**
     * @var float
     */
    public $Leeggoed;

    /**
     * @var float
     */
    public $Andere;

    /**
     * @var float
     */
    public $BebatInclBtw;

    /**
     * @var float
     */
    public $RecupelInclBtw;

    /**
     * @var float
     */
    public $AuteurInclBtw;

    /**
     * @var float
     */
    public $ReprobelInclBtw;

    /**
     * @var float
     */
    public $FostPlusInclBtw;

    /**
     * @var float
     */
    public $LeeggoedInclBtw;

    /**
     * @var float
     */
    public $AndereInclBtw;

    /**
     * Map the properties to a given type
     *
     * @var array
     */
    protected $typeMap = [
        'float' => [
            'Bebat', 'Recupel', 'Auteur', 'Reprobel', 'FostPlus', 'Leeggoed',
            'Andere', 'BebatInclBtw', 'RecupelInclBtw', 'AuteurInclBtw',
            'ReprobelInclBtw', 'FostPlusInclBtw', 'LeeggoedInclBtw',
            'AndereInclBtw',
        ],
    ];
}
