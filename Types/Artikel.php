<?php
namespace TijsVerkoyen\DBFact\Types;

/**
 * DBFact Artikel class
 *
 * @author		Tijs Verkoyen <php-dbfact@verkoyen.eu>
 */
class Artikel extends BaseObject
{
    /**
     * @var string
     */
    public $ArtCode;

    /**
     * @var string
     */
    public $ArtNummer;

    /**
     * @var string
     */
    public $VolgNummer;

    /**
     * @var string
     */
    public $Groep;

    /**
     * @var string
     */
    public $Soort;

    /**
     * @var string
     */
    public $Omschrijving;

    /**
     * @var string
     */
    public $Omschrijving2;

    /**
     * @var string
     */
    public $Omschrijving3;

    /**
     * @var string
     */
    public $Omschrijving4;

    /**
     * @var string
     */
    public $Specificaties;

    /**
     * @var string
     */
    public $DetailSpecificaties;

    /**
     * @var string
     */
    public $MerkId;

    /**
     * @var string
     */
    public $Merk;

    /**
     * @var string
     */
    public $StukNummer;

    /**
     * @var string
     */
    public $Opmerking;

    /**
     * @var string
     */
    public $Status;

    /**
     * @var string
     */
    public $StockControle;

    /**
     * @var string
     */
    public $VeldC1;

    /**
     * @var string
     */
    public $VeldC2;

    /**
     * @var string
     */
    public $VeldC3;

    /**
     * @var string
     */
    public $VeldC4;

    /**
     * @var string
     */
    public $VeldC5;

    /**
     * @var string
     */
    public $VeldC6;

    /**
     * @var string
     */
    public $Website;

    /**
     * @var string
     */
    public $TopSeller;

    /**
     * @var string
     */
    public $VeldL3;

    /**
     * @var string
     */
    public $VeldL4;

    /**
     * @var string
     */
    public $VeldL5;

    /**
     * @var string
     */
    public $BOKlant;

    /**
     * @var string
     */
    public $BOLeverancier;

    /**
     * @var string
     */
    public $Kleur;

    /**
     * @var string
     */
    public $Maat;

    /**
     * @var string
     */
    public $WebLink;

    /**
     * @var string
     */
    public $TypeArtikel;

    /**
     * @var string
     */
    public $Referentie;

    /**
     * @var string
     */
    public $Fabrikant;

    /**
     * @var string
     */
    public $LotnummerArtikel;

    /**
     * @var string
     */
    public $ExtraTekstTaal1;

    /**
     * @var string
     */
    public $ExtraTekstTaal2;

    /**
     * @var string
     */
    public $ExtraTekstTaal3;

    /**
     * @var string
     */
    public $ExtraTekstTaal4;

    /**
     * @var string
     */
    public $VeldM2;

    /**
     * @var string
     */
    public $VeldM3;

    /**
     * @var string
     */
    public $KortingsGroep;

    /**
     * @var float
     */
    public $Stock;

    /**
     * @var float
     */
    public $MinimumStock;

    /**
     * @var float
     */
    public $NominaleStock;

    /**
     * @var float
     */
    public $VeldN1;

    /**
     * @var float
     */
    public $VeldN2;

    /**
     * @var float
     */
    public $VeldN3;

    /**
     * @var float
     */
    public $VeldN4;

    /**
     * @var float
     */
    public $VeldN5;

    /**
     * @var float
     */
    public $BtwPercentage;

    /**
     * @var float
     */
    public $VerkoopsVerpakking;

    /**
     * @var float
     */
    public $VerkoopsAantal;

    /**
     * @var float
     */
    public $MinimumAfname;

    /**
     * @var float
     */
    public $Inhoud;

    /**
     * @var float
     */
    public $M3;

    /**
     * @var float
     */
    public $BrutoGewichtInKg;

    /**
     * @var float
     */
    public $NettoGewichtInKg;

    /**
     * @var float
     */
    public $VerpakkingsGewicht;

    /**
     * @var int
     */
    public $VerpakkingsLengte;

    /**
     * @var int
     */
    public $VerpakkingsBreedte;

    /**
     * @var int
     */
    public $VerpakkingsHoogte;

    /**
     * @var int
     */
    public $ArtikelLengte;

    /**
     * @var int
     */
    public $ArtikelBreedte;

    /**
     * @var int
     */
    public $ArtikelHoogte;

    /**
     * @var \DateTime
     */
    public $CreatieDat;

    /**
     * @var \DateTime
     */
    public $VerwachtDat;

    /**
     * @var \DateTime
     */
    public $VeldD1;

    /**
     * @var \DateTime
     */
    public $VeldD2;

    /**
     * @var \DateTime
     */
    public $VeldD3;

    /**
     * @var \DateTime
     */
    public $VeldD4;

    /**
     * @var \DateTime
     */
    public $VeldD5;

    /**
     * @var \TijsVerkoyen\DBFact\Types\Prijzen
     */
    public $Prijzen;

    /**
     * @var \TijsVerkoyen\DBFact\Types\Kosten
     */
    public $Kosten;

    /**
     * Map the properties to a given type
     *
     * @var array
     */
    protected $typeMap = array(
        'array' => array(
            'Images'
        ),
        'float' => array(
            'Stock', 'MinimumStock', 'NominaleStock',
            'VeldN1', 'VeldN2', 'VeldN3', 'VeldN4', 'VeldN5',
            'BtwPercentage',
            'VerkoopsVerpakking', 'VerkoopsAantal',
            'MinimumAfname',
            'Inhoud',
            'M3',
            'VerpakkingsGewicht', 'BrutoGewichtInKg', 'NettoGewichtInKg',
        ),
        'int' => array(
            'VerpakkingsLengte', 'VerpakkingsBreedte', 'VerpakkingsHoogte',
            'ArtikelLengte', 'ArtikelBreedte', 'ArtikelHoogte',
        ),
        'DateTime' => array(
            'CreatieDat', 'VerwachtDat',
            'VeldD1', 'VeldD2', 'VeldD3', 'VeldD4', 'VeldD5',
        ),
        'Custom' => array(
            'Prijzen', 'Kosten', //'Images', //'Appendices', //'Barcodes',
        ),
    );
}
