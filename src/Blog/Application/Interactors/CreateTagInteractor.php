<?php

namespace App\Blog\Application\Interactors;

use App\Blog\Application\Gateways\TagRepositoryInterface;
use App\Blog\Infrastructure\Entities\Tag;

class CreateTagInteractor
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
        $output->id = $tag->getId();

        return $output;
    }
}