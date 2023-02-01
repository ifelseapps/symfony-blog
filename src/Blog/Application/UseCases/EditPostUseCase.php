<?php

namespace App\Blog\Application\UseCases;

use App\Blog\Application\Factories\PostFactory;
use App\Blog\Application\Gateways\PostRepositoryInterface;
use App\Blog\Application\UseCases\Dto\EditPostInputDto;
use App\Blog\Application\UseCases\Dto\EditPostOutputDto;

class EditPostUseCase
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
        $output->success = true;
        $output->id = $post->getId();

        return $output;
    }
}