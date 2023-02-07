<?php

namespace App\Blog\Application\UseCases;

use App\Blog\Application\Gateways\TagRepositoryInterface;
use App\Blog\Application\UseCases\Dto\GetTagsOutputDto;
use App\Blog\Application\UseCases\Dto\TagItemDto;
use App\Blog\Domain\Tag;

class GetTagsUseCase
{
    public function __construct(protected TagRepositoryInterface $tagRepository)
    {
    }

    public function execute(): GetTagsOutputDto
    {
        $output = new GetTagsOutputDto();

        $tags = $this->tagRepository->findAll();
        $output->success = true;
        $output->tags = array_map(
            function (Tag $tag) {
                $tagItem = new TagItemDto();
                $tagItem->id = $tag->getId();
                $tagItem->title = $tag->getTitle();

                return $tagItem;
            },
            $tags
        );

        return $output;
    }
}