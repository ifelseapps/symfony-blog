<?php

namespace App\Blog\Domain;

use App\Core\Domain\BaseEntity;

class Tag extends BaseEntity
{
    protected string $title;

    public function __construct(string $title, ?string $id)
    {
        $this->title = $title;
        parent::__construct($id);
    }

    public function getTitle()
    {
        return $this->title;
    }
}