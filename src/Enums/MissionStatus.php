<?php

namespace App\Enums;

enum MissionStatus: int
{
    case StandBy = 1;
    case Processing = 2;
    case Success = 3;
    case Failed = 4;

    public function toFrench(): string
    {
        return match ($this) {
            self::StandBy => 'En attente',
            self::Processing => 'En cours',
            self::Success => 'Réussi',
            self::Failed => 'Échoué',
        };
    }
}
