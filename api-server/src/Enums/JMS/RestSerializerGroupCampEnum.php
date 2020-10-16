<?php


namespace App\Enums\JMS;


use MyCLabs\Enum\Enum;

/**
 * @method static RestSerializerGroupCampEnum HISTORISABLE()
 * @method static RestSerializerGroupCampEnum NOT_SET()
 *
 * @method static RestSerializerGroupCampEnum MODULE_ADMIN()
 */
class RestSerializerGroupCampEnum extends Enum
{
    /**
     * Propriété modifiable depuis l'UI
     * et dont les changement seront tracés (camp_historique_modification)
     */
    public const HISTORISABLE = "camp-historisable";

    /**
     * Propriétés non encore affecté à un module (écran)
     */
    public const NOT_SET = "not-set";

    /**
     * Propriétés affectées au module "Administration" (principal)
     */
    public const MODULE_ADMIN = 'module-admin';

}
