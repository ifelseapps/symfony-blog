<?php

namespace App\Blog\Application\Interactors;

use App\Blog\Application\Factories\PostFactory;
use App\Blog\Application\Gateways\PostRepositoryInterface;

class EditPostInteractor
{
    public function __construct(
        protected PostFactory $postFactory,
        protected PostRepositoryInterface $postRepository,
    )
    {
    }

    public function execute(EditPostInputDto $input): EditPostOutputDto
    {
        $post = $this->postFactory->edit($input);
        $this->postRepository->save($post, true);

        $output = new EditPostOutputDto();
        $output->id = $post->getId();

        return $output;
    }
}