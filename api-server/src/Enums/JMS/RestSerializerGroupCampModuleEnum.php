<?php


namespace App\Enums\JMS;


use MyCLabs\Enum\Enum;

/**
 * @method static RestSerializerGroupCampModuleEnum INFO_GENERALE()
 * @method static RestSerializerGroupCampModuleEnum PARTICIPANT()
 * @method static RestSerializerGroupCampModuleEnum STAFF()
 */
class RestSerializerGroupCampModuleEnum extends Enum
{
    /**
     * Propriétés non encore affecté à un module (écran)
     */
    public const NOT_SET = "NOT_SET";

    /**
     * Propriétés affectées au module "Administration" (principal)
     */
    public const INFO_GENERALE = 'INFO_GENERALE';
    public const PARTICIPANT = 'PARTICIPANT';
    public const STAFF = 'STAFF';

}
