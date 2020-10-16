<?php


namespace App\Enums;


use MyCLabs\Enum\Enum;

/**
 * @method static RestSerializerGroupCampEnum OUVERT()
 * @method static RestSerializerGroupCampEnum CLOTURE()
 */
class CampDiscussionSujetStatutEnum extends Enum
{
    public const OUVERT = 1;
    public const CLOTURE = 2;
}
