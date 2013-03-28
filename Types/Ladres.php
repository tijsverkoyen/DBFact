<?php
namespace TijsVerkoyen\DBFact\Types;

/**
 * DBFact Ladres class
 *
 * @author		Tijs Verkoyen <php-dbfact@verkoyen.eu>
 */
class Ladres extends BaseObject
{
    /**
     * @var string
     */
    public $dossier;

    /**
     * @var string
     */
    public $l_relnum;

    /**
     * @var string
     */
    public $l_naam;

    /**
     * @var string
     */
    public $l_adres;

    /**
     * @var string
     */
    public $l_adres2;

    /**
     * @var string
     */
    public $l_postcode;

    /**
     * @var string
     */
    public $l_plaats;

    /**
     * @var string
     */
    public $l_land;

    /**
     * @var string
     */
    public $l_isoland;

    /**
     * @var string
     */
    public $l_recno;

    /**
     * @var string
     */
    public $l_naam2;

    /**
     * @var string
     */
    public $l_tel1;

    /**
     * @var string
     */
    public $l_fax;

    /**
     * @var string
     */
    public $l_opmerk;

    /**
     * @var string
     */
    public $l_lanummer;

    /**
     * @var string
     */
    public $l_ean;

    /**
     * @var string
     */
    public $l_route;

    /**
     * @var string
     */
    public $l_aannemer;

    /**
     * @var string
     */
    public $l_architec;

    /**
     * @var string
     */
    public $l_verteg;

    /**
     * @var int
     */
    public $l_typadr;

    /**
     * @var bool
     */
    public $l_defadr;

    /**
     * @var string
     */
    public $l_relnum2;

    /**
     * @var float
     */
    public $l_distance;

    /**
     * @var float
     */
    public $l_drivtime;

    /**
     * @var float
     */
    public $l_drivcost;

    /**
     * @var string
     */
    public $l_gln;

    /**
     * @var bool
     */
    public $l_deffadr;

    /**
     * @var float
     */
    public $l_lattitud;

    /**
     * @var float
     */
    public $l_longitud;

    /**
     * @var string
     */
    public $l_guid;

    /**
     * @var string
     */
    public $l_taal;

    /**
     * @var string
     */
    public $l_regionum;

    /**
     * @var string
     */
    public $l_memo;

    /**
     * @var string
     */
    public $l_sluit;

    /**
     * @var bool
     */
    public $l_linkadr;

    /**
     * @var string
     */
    public $l_transid;

    /**
     * @var int
     */
    public $l_categ1;

    /**
     * @var int
     */
    public $l_categ2;

    /**
     * @var int
     */
    public $l_categ3;

    /**
     * @var int
     */
    public $l_categ4;

    /**
     * @var int
     */
    public $l_categ5;

    /**
     * @var bool
     */
    public $l_website;

    /**
     * @var string
     */
    public $catoms1_1;

    /**
     * @var string
     */
    public $catoms1_2;

    /**
     * @var string
     */
    public $catoms1_3;

    /**
     * @var string
     */
    public $catoms1_4;

    /**
     * @var string
     */
    public $catoms2_1;

    /**
     * @var string
     */
    public $catoms2_2;

    /**
     * @var string
     */
    public $catoms2_3;

    /**
     * @var string
     */
    public $catoms2_4;

    /**
     * @var string
     */
    public $catoms3_1;

    /**
     * @var string
     */
    public $catoms3_2;

    /**
     * @var string
     */
    public $catoms3_3;

    /**
     * @var string
     */
    public $catoms3_4;

    /**
     * @var string
     */
    public $catoms4_1;

    /**
     * @var string
     */
    public $catoms4_2;

    /**
     * @var string
     */
    public $catoms4_3;

    /**
     * @var string
     */
    public $catoms4_4;

    /**
     * @var string
     */
    public $catoms5_1;

    /**
     * @var string
     */
    public $catoms5_2;

    /**
     * @var string
     */
    public $catoms5_3;

    /**
     * @var string
     */
    public $catoms5_4;

    /**
     * @var string
     */
    public $l_tekst1;

    /**
     * @var string
     */
    public $l_tekst2;

    /**
     * Map the properties to a given type
     *
     * @var array
     */
    protected $typeMap = array(
        'int' => array('l_typadr', 'l_categ1', 'l_categ2', 'l_categ3', 'l_categ4', 'l_categ5'),
        'bool' => array('l_defadr', 'l_deffadr', 'l_linkadr', 'l_website'),
        'float' => array('l_distance', 'l_drivcost', 'l_lattitud', 'l_longitud'),
    );
}
