<?php
namespace TijsVerkoyen\DBFact\Types;

/**
 * DBFact Message class
 *
 * @author		Tijs Verkoyen <php-dbfact@verkoyen.eu>
 */
class Message extends BaseObject
{
    /**
     * @var string
     */
    public $Tml_Toegang;

    /**
     * @var string
     */
    public $SessionId;

    /**
     * @var string
     */
    public $CustomerNumber;

    /**
     * @var string
     */
    public $Name;

    /**
     * @var string
     */
    public $Dossier;

    /**
     * @var string
     */
    public $Language;

    /**
     * @var string
     */
    public $RelationCode;

    /**
     * @var string
     */
    public $ValutaCode;

    /**
     * @var string
     */
    public $Email;

    /**
     * @var string
     */
    public $MustPayTransportCost;

    /**
     * @var string
     */
    public $WebRight1;

    /**
     * @var string
     */
    public $WebRight2;

    /**
     * @var string
     */
    public $WebRight3;

    /**
     * @var string
     */
    public $WebRight4;

    /**
     * @var string
     */
    public $WebRight5;

    /**
     * @var string
     */
    public $PartnerTypeId;

    /**
     * @var string
     */
    public $PartnerType;

    /**
     * @var string
     */
    public $ContpersId;

    /**
     * @var string
     */
    public $Account;

    /**
     * @var string
     */
    public $AccountId;

    /**
     * @var array
     */
    public $Article;

    /**
     * @var string
     */
    public $KeepAlive;

    /**
     * @var string
     */
    public $Success;

	/**
	 * @var TransportFee
	 */
	public $TransportFee;

    /**
     * Map the properties to a given type
     *
     * @var array
     */
    protected $typeMap = array(
        'Collection' => array(
            'Article', 'FacCre', 'ServiceRapport', 'BBK', 'Backorder'
        ),
        'Custom' => array(
	        'TransportFee'
        )
    );
}
