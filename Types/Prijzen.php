<?php
namespace TijsVerkoyen\DBFact\Types;

/**
 * DBFact Prijzen class
 *
 * @author		Tijs Verkoyen <php-dbfact@verkoyen.eu>
 */
class Prijzen extends BaseObject
{
    /**
     * @var string
     */
    public $PromoActief;

    /**
     * @var string
     */
    public $PromoPrijsVan;

    /**
     * @var string
     */
    public $PromoPrijsTot;

    /**
     * @var string
     */
    public $Valuta;

    /**
     * @var float
     */
    public $WinkelIncl;

    /**
     * @var float
     */
    public $WinkelExcl;

    /**
     * @var float
     */
    public $Dealer;

    /**
     * @var float
     */
    public $PromoPrijsExcl;

    /**
     * @var float
     */
    public $PromoPrijsIncl;

    /**
     * @var float
     */
    public $PromoPrijsDealerExcl;

    /**
     * @var float
     */
    public $PromoPrijsDealerIncl;

    /**
     * @var float
     */
    public $PromoPrijsMinVerkExcl;

    /**
     * @var float
     */
    public $PromoPrijsMinVerkIncl;

    /**
     * @var float
     */
    public $AanbevolenIncl;

    /**
     * @var float
     */
    public $BasisExcl;

    /**
     * @var float
     */
    public $MinimumVerkoopExcl;

    /**
     * @var float
     */
    public $ValutaNetto;

    /**
     * @var float
     */
    public $Prijs1;

    /**
     * @var float
     */
    public $Prijs2;

    /**
     * @var float
     */
    public $Prijs3;

    /**
     * @var float
     */
    public $Prijs4;

    /**
     * @var float
     */
    public $Prijs5;

    /**
     * Map the properties to a given type
     *
     * @var array
     */
    protected $typeMap = array(
        'float' => array(
            'WinkelIncl', 'WinkelExcl', 'Dealer', 'PromoPrijsExcl',
            'PromoPrijsIncl', 'PromoPrijsDealerExcl', 'PromoPrijsDealerIncl',
            'PromoPrijsMinVerkExcl', 'PromoPrijsMinVerkIncl', 'AanbevolenIncl',
            'BasisExcl', 'MinimumVerkoopExcl', 'ValutaNetto', 'Prijs1',
            'Prijs2', 'Prijs3', 'Prijs4', 'Prijs5'
        ),
        'DateTime' => array(
            'PromoPrijsVan', 'PromoPrijsTot',
        ),
    );
}
