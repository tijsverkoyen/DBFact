<?php

namespace TijsVerkoyen\DBFact\Types;

/**
 * DBFact Class TransportFee
 *
 * @author Jonas De Keukelaere <jonas@sumocoders.be>
 */
class TransportFee extends BaseObject
{
    /**
     * @var string
     */
    public $TransportArticle;

    /**
     * @var string
     */
    public $TransportArticleCode;

    /**
     * @var float
     */
    public $TransportUpTo;

    /**
     * @var float
     */
    public $CustomTransportFee;
}
