<?php

namespace App\Blog\Application\Interactors;

use App\Blog\Application\Factories\PostFactory;
use App\Blog\Application\Gateways\PostRepositoryInterface;

class CreatePostInteractor
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