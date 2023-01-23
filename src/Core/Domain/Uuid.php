<?php

namespace App\Core\Domain;

class Uuid
{
    public static function generate(): string
    {
        return \Symfony\Component\Uid\Uuid::v4();
    }
}