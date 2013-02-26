<?php
namespace TijsVerkoyen\DBFact\Types;

/**
 * DBFact Appendix class
 *
 * @author		Tijs Verkoyen <php-dbfact@verkoyen.eu>
 */
class Appendix extends BaseObject
{
    /**
     * @var string
     */
    public $Id;

    /**
     * @var string
     */
    public $Type;

    /**
     * @var string
     */
    public $FileName;

    /**
     * @var string
     */
    public $Description;

    /**
     * @var \DateTime
     */
    public $DateTime;

    /**
     * @var string
     */
    public $Found;

    /**
     * @var int
     */
    public $FileSizeInBytes;

    /**
     * @var string
     */
    public $Language;

    /**
     * @var string
     */
    public $Country;

    /**
     * @var string
     */
    public $Category;

    /**
     * @var string
     */
    public $CustomDescription1;

    /**
     * @var string
     */
    public $CustomDescription2;

    /**
     * @var string
     */
    public $CustomDescription3;

    /**
     * @var string
     */
    public $CustomDescription4;

    /**
     * Map the properties to a given type
     *
     * @var array
     */
    protected $typeMap = array(
        'int' => array(
            'FileSizeInBytes',
        ),
        'DateTime' => array(
            'DateTime',
        ),
    );
}
