<?php

namespace App\Blog\Application\UseCases;

use App\Blog\Application\Factories\PostFactory;
use App\Blog\Application\Gateways\PostRepositoryInterface;
use App\Blog\Application\UseCases\Dto\CreatePostInputDto;
use App\Blog\Application\UseCases\Dto\CreatePostOutputDto;

class CreatePostUseCase
{
    public function __construct(
        protected PostRepositoryInterface $postRepository,
        protected PostFactory $postFactory,
    )
    {
    }
    public function execute(CreatePostInputDto $input): CreatePostOutputDto
    {
        $post = $this->postFactory->create($input);
        $this->postRepository->save($post, true);

        $output = new CreatePostOutputDto();
        $output->id = $post->getId();

        return $output;
    }
}