<?php

namespace App\Blog\Application\Interactors;

use App\Blog\Application\Factories\PostFactory;
use App\Blog\Application\Gateways\PostRepositoryInterface;

class CreatePostInteractor
{
    protected PostRepositoryInterface $postRepository;

    protected PostFactory $postFactory;

    public function __construct(
        PostRepositoryInterface $postRepository,
        PostFactory $postFactory,
    )
    {
        $this->postRepository = $postRepository;
        $this->postFactory = $postFactory;
    }
    public function execute(CreatePostInputDto $input): CreatePostOutputDto
    {
        $post = $this->postFactory->create($input);
//        $this->postRepository->save($post, true);

        $output = new CreatePostOutputDto();
        $output->id = 123;

        return $output;
    }
}