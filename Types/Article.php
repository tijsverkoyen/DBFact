<?php
namespace TijsVerkoyen\DBFact\Types;

/**
 * DBFact Article class
 *
 * @author		Tijs Verkoyen <php-dbfact@verkoyen.eu>
 */
class Article extends BaseObject
{
    /**
     * @var string
     */
    public $ArtCode;

    /**
     * @var string
     */
    public $SoortPrijs;

    /**
     * @var string
     */
    public $TypeKorting;

    /**
     * @var string
     */
    public $Korting;

    /**
     * @var string
     */
    public $ExtraKorting;

    /**
     * @var float
     */
    public $KortExclBtw;

    /**
     * @var float
     */
    public $KortInclBtw;

    /**
     * @var string
     */
    public $VoorrangBTW;

    /**
     * @var float
     */
    public $NettoExclBtw;

    /**
     * @var float
     */
    public $NettoInclBtw;

    /**
     * @var float
     */
    public $BrutoExclBtw;

    /**
     * @var float
     */
    public $BrutoInclBtw;

    /**
     * @var string
     */
    public $a_nummer;

    /**
     * @var string
     */
    public $a_lomschrn;

    /**
     * @var float
     */
    public $a_winkel;

    /**
     * @var float
     */
    public $a_winkelinclkosten;

    /**
     * @var float
     */
    public $a_inkoop;

    /**
     * @var float
     */
    public $a_vrystock;

    /**
     * @var string
     */
    public $a_omschrn;

    /**
     * @var string
     */
    public $a_omschrnl;

    /**
     * @var float
     */
    public $a_winex;

    /**
     * @var float
     */
    public $a_basisex;

    /**
     * @var float
     */
    public $a_dealer;

    /**
     * @var float
     */
    public $a_aanbevol;

    /**
     * @var float
     */
    public $a_minverk;

    /**
     * @var float
     */
    public $a_prijs1;

    /**
     * @var float
     */
    public $a_prijs2;

    /**
     * @var float
     */
    public $a_prijs3;

    /**
     * @var float
     */
    public $a_prijs4;

    /**
     * @var float
     */
    public $a_prijs5;

    /**
     * @var float
     */
    public $a_btwcode;

    /**
     * @var string
     */
    public $a_gkort;

    /**
     * @var float
     */
    public $a_maxkort;

    /**
     * @var float
     */
    public $a_minmarge;

    /**
     * @var float
     */
    public $a_maat;

    /**
     * @var float
     */
    public $a_typsamen;

    /**
     * @var float
     */
    public $b_btw1;

    /**
     * @var float
     */
    public $originkoop;

    /**
     * Map the properties to a given type
     *
     * @var array
     */
    protected $typeMap = array(
        'float' => array(
            'KortExclBtw', 'KortInclBtw', 'NettoExclBtw', 'NettoInclBtw',
            'BrutoExclBtw', 'BrutoInclBtw', 'a_winkel', 'a_winkelinclkosten',
            'a_inkoop', 'a_vrystock', 'a_winex', 'a_basisex', 'a_dealer',
            'a_aanbevol', 'a_minverk', 'a_prijs1', 'a_prijs2', 'a_prijs3',
            'a_prijs4', 'a_prijs5', 'a_btwcode', 'a_maxkort', 'a_minmarge',
            'a_maat', 'a_typsamen', 'b_btw1', 'originkoop'
        ),
    );
}
