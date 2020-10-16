<?php


namespace App\Enums\JMS;


use MyCLabs\Enum\Enum;

/**
 *
 */
class RestSerializerGroupEnum extends Enum
{
    public const IDENTIFIANT = "identifiant";
    /**
     * Propriété devant être toujours sérialisée
     */
    public const TOUJOURS = "toujours";

    /**
     * Permet de filtrer les propriétés nécessaires à la création
     * afin d'avoir une doc swagger cohérente pour l'input
     */
    public const CREATION = "creation";

    public const CREATION_ENFANT = "creation-enfant";

    public const MODIFICATION = "modification";

    /**
     * Permet de retourner l'identifiant d'une référence
     * afin d'avoir une doc swagger cohérente pour l'input
     */
    public const REF =  "ref";

    /**
     * Permet de marquer les propriétés seulement retournées
     * lors d'une recherche pour un affichage fiche (complet)
     */
    public const FICHE = "fiche";

}
