<?php

namespace App\Blog\Application\UseCases;

use App\Blog\Application\Gateways\TagRepositoryInterface;
use App\Blog\Application\UseCases\Dto\CreateTagInputDto;
use App\Blog\Application\UseCases\Dto\CreateTagOutputDto;
use App\Blog\Infrastructure\Entities\Tag;

class CreateTagUseCase
{
    public function __construct(protected TagRepositoryInterface $tagRepository)
    {
    }

    public function execute(CreateTagInputDto $input): CreateTagOutputDto
    {
        $tag = new Tag();
        $tag->setTitle($input->title);

        $this->tagRepository->save($tag, true);

        $output = new CreateTagOutputDto();
        $output->success = true;
        $output->id = $tag->getId();

        return $output;
    }
}