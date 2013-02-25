<?php
namespace TijsVerkoyen\DBFact\Types;

/**
 * DBFact Image class
 *
 * @author		Tijs Verkoyen <php-dbfact@verkoyen.eu>
 */
class Image extends BaseObject
{
	/**
	 * @var string
	 */
	public $Id;

	/**
	 * @var string
	 */
	public $Filename;

	/**
	 * @var string
	 */
	public $Description;

	/**
	 * @var int
	 */
	public $SizeInKb;

	/**
	 * @var \DateTime
	 */
	public $DateTime;

	/**
	 * @var string
	 */
	public $UniqueName;

	/**
	 * @var string
	 */
	public $Website;

	/**
	 * @var string
	 */
	public $Catalog;

	/**
	 * @var string
	 */
	public $Email;

	/**
	 * @var string
	 */
	public $Default;

	/**
	 * Map the properties to a given type
	 *
	 * @var array
	 */
	protected $typeMap = array(
		'int' => array(
			'SizeInKb',
		),
		'DateTime' => array(
			'DateTime',
		),
	);
}
