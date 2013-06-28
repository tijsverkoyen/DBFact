<?php
namespace TijsVerkoyen\DBFact\Types;

/**
 * DBFact Regel class
 *
 * @author Jonas De Keukelaere <jonas@sumocoders.be>
 */
class Regel extends BaseObject
{
	/**
	 * @var string
	 */
	public $Artikel;

	/**
	 * @var string
	 */
	public $Referentie;

	/**
	 * @var string
	 */
	public $Omschrijving;

	/**
	 * @var float
	 */
	public $Aantal;

	/**
	 * @var float
	 */
	public $EenheidExcl;

	/**
	 * @var int
	 */
	public $Korting;

	/**
	 * @var float
	 */
	public $Totaal;

	/**
	 * @var int
	 */
	public $VerpId;

	/**
	 * @var string
	 */
	public $VerpOms;

	/**
	 * Map the properties to a given type
	 *
	 * @var array
	 */
	protected $typeMap = array(
		'float' => array(
			'Aantal', 'EenheidExcl', 'Totaal'
		),
		'int' => array(
			'Korting', 'VerpId'
		)
	);
}