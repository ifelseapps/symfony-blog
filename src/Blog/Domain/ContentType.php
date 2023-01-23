<?php

namespace App\Blog\Domain;

enum ContentType: string
{
    case TEXT = 'TEXT';
    case PICTURES = 'PICTURES';
}
