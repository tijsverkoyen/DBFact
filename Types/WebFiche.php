<?php

namespace TijsVerkoyen\DBFact\Types;

/**
 * DBFact Image class
 *
 * @author Tijs Verkoyen <php-dbfact@verkoyen.eu>
 */
class WebFiche extends BaseObject
{
    /**
     * @var string
     */
    public $WebArticle;

    /**
     * @var string
     */
    public $Promo;

    /**
     * @var string
     */
    public $PromoStartDate;

    /**
     * @var string
     */
    public $PromoEndDate;

    /**
     * @var int
     */
    public $IdentityNumber;

    /**
     * @var string
     */
    public $Category1;

    /**
     * @var string
     */
    public $Category2;

    /**
     * @var string
     */
    public $Category3;

    /**
     * @var string
     */
    public $Category4;

    /**
     * @var string
     */
    public $Color;

    /**
     * @var string
     */
    public $Size;

    /**
     * @var string
     */
    public $WebLink;

    /**
     * @var string
     */
    public $Memo1;

    /**
     * @var string
     */
    public $Memo2;

    /**
     * @var string
     */
    public $Memo3;

    /**
     * @var string
     */
    public $Memo4;

    /**
     * @var string
     */
    public $HtmlMemo1;

    /**
     * @var string
     */
    public $HtmlMemo2;

    /**
     * @var string
     */
    public $HtmlMemo3;

    /**
     * @var string
     */
    public $HtmlMemo4;

    /**
     * @var string
     */
    public $IcecatLink;

    /**
     * Map the properties to a given type
     *
     * @var array
     */
    protected $typeMap = [
        'int' => [
            'IdentityNumber',
        ],
    ];
}
