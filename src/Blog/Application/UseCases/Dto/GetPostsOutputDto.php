<?php

namespace App\Blog\Application\UseCases\Dto;

class GetPostsOutputDto extends BaseOutputDto
{
    /** @var PostItemDto[] */
    public array $posts;
}