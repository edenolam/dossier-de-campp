<?php


namespace App\Enums\JMS;


use MyCLabs\Enum\Enum;

/**
 * @method static RestSerializerGroupRefsEnum FICHE()
 * @method static RestSerializerGroupRefsEnum LISTE()
 */
class RestSerializerGroupRefsEnum extends Enum
{
    public const FICHE = "refs-fiche";
    public const LISTE = "refs-liste";

    public const MODULE = "refs-module";
    public const NUMERO_UTILE = "refs-numero-utile";
}
