<?php

namespace App\Core\Domain;

class BaseEntity
{
    protected string $id;

    public function __construct(?string $id)
    {
        $this->id = $id ?? Uuid::generate();
    }

    public function getId()
    {
        return $this->id;
    }
}