<?php
namespace TijsVerkoyen\DBFact\Types;

/**
 * DBFact Artikel class
 *
 * @author		Tijs Verkoyen <php-dbfact@verkoyen.eu>
 */
class Artikel extends BaseObject
{
    public $ArtCode, $ArtNummer, $VolgNummer, $Groep, $Soort, $Omschrijving,
        $Omschrijving2, $Omschrijving3, $Omschrijving4, $Specificaties, $DetailSpecificaties,
        $MerkId, $Merk, $StukNummer, $Opmerking, $Status, $StockControle, $VeldC1, $VeldC2,
        $VeldC3, $VeldC4, $VeldC5, $VeldC6, $Website, $TopSeller, $VeldL3, $VeldL4, $VeldL5,
        $BOKlant, $BOLeverancier, $Kleur, $Maat, $WebLink, $TypeArtikel, $Referentie, $Fabrikant,
		$LotnummerArtikel, $ExtraTekstTaal1, $ExtraTekstTaal2, $ExtraTekstTaal3, $ExtraTekstTaal4,
		$VeldM2, $VeldM3, $KortingsGroep;


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
