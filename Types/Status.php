<?php
namespace TijsVerkoyen\DBFact\Types;

/**
 * DBFact Status class
 *
 * @author Jonas De Keukelaere <jonas@sumocoders.be>
 */
class Status extends BaseObject
{
	/**
	 * @var string
	 */
	public $Code;

	/**
	 * @var \DateTime
	 */
	public $Datum;

	/**
	 * @var string
	 */
	public $Uur;

	/**
	 * @var string
	 */
	public $Opmerking;

	/**
	 * @var string
	 */
	public $Technieker;

	/**
	 * @var string
	 */
	public $Omschrijving;

	protected $typeMap = array(
		'DateTime' => array(
			'Datum'
		)
	);
}