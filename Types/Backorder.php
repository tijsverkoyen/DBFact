<?php
namespace TijsVerkoyen\DBFact\Types;

/**
 * DBFact Backorder class
 *
 * @author Jonas De Keukelaere <jonas@sumocoders.be>
 */
class Backorder extends BaseObject
{
	/**
	 * @var string
	 */
	public $Artikel;

	/**
	 * @var string
	 */
	public $ReferentieLev;

	/**
	 * @var string
	 */
	public $Omschrijving;

	/**
	 * @var float
	 */
	public $Besteld;

	/**
	 * @var float
	 */
	public $Open;

	/**
	 * @var string
	 */
	public $Bestelbon;

	/**
	 * @var \DateTime
	 */
	public $BestelbonDatum;

	/**
	 * @var \DateTime
	 */
	public $LeverDatum;

	protected $typeMap = array(
		'DateTime' => array(
			'BestelbonDatum', 'LeverDatum'
		),
		'float' => array(
			'Besteld', 'Open'
		)
	);
}