<?php
namespace TijsVerkoyen\DBFact\Types;

/**
 * DBFact Image class
 *
 * @author		Tijs Verkoyen <php-dbfact@verkoyen.eu>
 */
class WebFiche extends BaseObject
{
    /**
     * @var strings
     */
    public $WebArticle;

    /**
     * @var strings
     */
    public $Promo;

    /**
     * @var strings
     */
    public $PromoStartDate;

    /**
     * @var strings
     */
    public $PromoEndDate;

    /**
     * @var int
     */
    public $IdentityNumber;

    /**
     * @var strings
     */
    public $Category1;

    /**
     * @var strings
     */
    public $Category2;

    /**
     * @var strings
     */
    public $Category3;

    /**
     * @var strings
     */
    public $Category4;

    /**
     * @var strings
     */
    public $Color;

    /**
     * @var strings
     */
    public $Size;

    /**
     * @var strings
     */
    public $WebLink;

    /**
     * @var strings
     */
    public $Memo1;

    /**
     * @var strings
     */
    public $Memo2;

    /**
     * @var strings
     */
    public $Memo3;

    /**
     * @var strings
     */
    public $Memo4;

    /**
     * @var strings
     */
    public $HtmlMemo1;

    /**
     * @var strings
     */
    public $HtmlMemo2;

    /**
     * @var strings
     */
    public $HtmlMemo3;

    /**
     * @var strings
     */
    public $HtmlMemo4;

    /**
     * @var strings
     */
    public $IcecatLink;

    /**
     * Map the properties to a given type
     *
     * @var array
     */
    protected $typeMap = array(
        'int' => array(
            'IdentityNumber',
        ),
    );
}
