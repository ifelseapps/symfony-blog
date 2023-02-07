<?php

namespace App\Blog\Application\UseCases\Dto;

class GetTagsOutputDto extends BaseOutputDto
{
    /** @var TagItemDto[] */
    public array $tags;
}