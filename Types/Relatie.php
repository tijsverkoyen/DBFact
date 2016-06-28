<?php

namespace TijsVerkoyen\DBFact\Types;

/**
 * DBFact Relatie class
 *
 * @author Tijs Verkoyen <php-dbfact@verkoyen.eu>
 */
class Relatie extends BaseObject
{
    /**
     * @var string
     */
    public $Dossier;

    /**
     * @var string
     */
    public $RelNummer;

    /**
     * @var string
     */
    public $GUID;

    /**
     * @var string
     */
    public $Naam;

    /**
     * @var string
     */
    public $Naam2;

    /**
     * @var string
     */
    public $FirstName;

    /**
     * @var string
     */
    public $LastName;

    /**
     * @var string
     */
    public $Adres;

    /**
     * @var string
     */
    public $Adres2;

    /**
     * @var string
     */
    public $Postcode;

    /**
     * @var string
     */
    public $Plaats;

    /**
     * @var string
     */
    public $Land;

    /**
     * @var string
     */
    public $IsoLand;

    /**
     * @var string
     */
    public $Tel1;

    /**
     * @var string
     */
    public $Tel2;

    /**
     * @var string
     */
    public $Tel3;

    /**
     * @var string
     */
    public $Fax;

    /**
     * @var string
     */
    public $Email;

    /**
     * @var string
     */
    public $BetalingsVoorwaarden;

    /**
     * @var string
     */
    public $SoortBTW;

    /**
     * @var string
     */
    public $SoortPrijs;

    /**
     * @var string
     */
    public $SoortExtraPrijs;

    /**
     * @var string
     */
    public $SluitingsDag;

    /**
     * @var string
     */
    public $Paswoord;

    /**
     * @var string
     */
    public $TransportWijze;

    /**
     * @var string
     */
    public $txtBetalingsVoorwaarden;

    /**
     * @var string
     */
    public $txtBetalingsVoorwaarden2;

    /**
     * @var string
     */
    public $txtBetalingsVoorwaarden3;

    /**
     * @var string
     */
    public $txtBetalingsVoorwaarden4;

    /**
     * @var string
     */
    public $txtSoortBTW;

    /**
     * @var string
     */
    public $txtSoortPrijs;

    /**
     * @var string
     */
    public $OndernemingsNummer;

    /**
     * @var string
     */
    public $TransportID;

    /**
     * @var string
     */
    public $TitelCode;

    /**
     * @var string
     */
    public $RelatieCode;

    /**
     * @var string
     */
    public $PartnerRelnum;

    /**
     * @var string
     */
    public $Website;

    /**
     * @var string
     */
    public $Division;

    /**
     * @var string
     */
    public $Kortingsgroep;

    /**
     * @var string
     */
    public $KortingsgroepId;

    /**
     * @var string
     */
    public $InteresseCodes;

    /**
     * @var string
     */
    public $PartnerInfo;

    /**
     * Map the properties to a given type
     *
     * @var array
     */
    protected $typeMap = [
        'int' => [
            'SoortBTW', 'SoortPrijs', 'SoortExtraPrijs', 'TransportWijze', 'TitelCode',
        ],
    ];
}
