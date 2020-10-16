<?php


namespace App\Service;


use App\Entity\Adherent;
use App\Entity\TypeCamp;

class RefsService extends AbstractDdcService
{
    function getTypeCamps() : array {
        return $this->getDdcRepository(TypeCamp::class)->findBy(['actif' => true]);
    }

    /**
     * @param string $userNumero
     * @param string $numero
     * @return array
     */
    function getAdherents(string $userNumero, ?string $numero) : array {
        // FIXME Appeler le service Rest des Scouts
        // FIXME Prendre en compte l'utilisateur connecté ($userNumero)
        if ($numero)
            return [
                $this->getDdcRepository(Adherent::class)->find($numero)
            ];
        else
            return $this->getDdcRepository(Adherent::class)->findBy([], ["nom" => "ASC", "prenom" => "ASC"], 60);
    }
}