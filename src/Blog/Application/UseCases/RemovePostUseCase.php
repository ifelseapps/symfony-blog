<?php

namespace App\Blog\Application\UseCases;

use App\Blog\Application\Gateways\PostRepositoryInterface;
use App\Blog\Application\UseCases\Dto\RemovePostInputDto;
use App\Blog\Application\UseCases\Dto\RemovePostOutputDto;
use App\Core\Exceptions\NotFoundException;

class RemovePostUseCase
{
    public function __construct(protected PostRepositoryInterface $postRepository)
    {
    }

    public function execute(RemovePostInputDto $input): RemovePostOutputDto
    {
        $post = $this->postRepository->findById($input->id);
        if (null === $post) {
            throw new NotFoundException('Post not found');
        }

        $this->postRepository->remove($post, true);

        $output = new RemovePostOutputDto();
        $output->success = true;

        return $output;
    }
}