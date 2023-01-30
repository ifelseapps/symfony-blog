<?php

namespace App\Blog\Application\Interactors;

use App\Blog\Application\Gateways\PostRepositoryInterface;

class GetPostsInteractor
{
    public function __construct(protected PostRepositoryInterface $postRepository)
    {
    }

    public function execute(GetPostInputDto $input): array
    {
        return $this->postRepository->getAll($input);
    }
}