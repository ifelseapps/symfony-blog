<?php

namespace App\Blog\Application\UseCases;

use App\Blog\Application\Gateways\PostRepositoryInterface;
use App\Blog\Application\UseCases\Dto\CategoryDto;
use App\Blog\Application\UseCases\Dto\GetPostsInputDto;
use App\Blog\Application\UseCases\Dto\GetPostsOutputDto;
use App\Blog\Application\UseCases\Dto\PostItemDto;
use App\Blog\Application\UseCases\Dto\TagItemDto;
use App\Blog\Infrastructure\Entities\Post;
use App\Blog\Infrastructure\Entities\Tag;

class GetPostsUseCase
{
    /** @var Post[] */
    public array $posts;

    public function __construct(protected PostRepositoryInterface $postRepository)
    {
    }

    public function execute(GetPostsInputDto $input): GetPostsOutputDto
    {
        $this->posts = $this->postRepository->getAll(page: $input->page, perPage: $input->perPage);
        return $this->createResult();
    }

    public function createResult(): GetPostsOutputDto
    {
        $output = new GetPostsOutputDto();
        $output->success = true;
        $output->posts = array_map(function (Post $post) {
            $postDto = new PostItemDto();
            $postDto->id = $post->getId();
            $postDto->title = $post->getTitle();
            $postDto->slug = $post->getSlug();
            $postDto->created_at = $post->getCreatedAt()->getTimestamp();
            $postDto->content = $post->getContent();
            $postDto->description = $post->getDescription();
            $postDto->keywords = $post->getKeywords();
            $postDto->enabled = $post->isEnabled();

            $category = $post->getCategory();
            $categoryDto = new CategoryDto();
            $categoryDto->id = $category->getId();
            $categoryDto->title = $category->getTitle();
            $categoryDto->description = $category->getDescription();
            $categoryDto->keywords = $category->getKeywords();
            $categoryDto->slug = $category->getSlug();
            $categoryDto->preview_text = $category->getPreviewText();
            $postDto->category = $categoryDto;

            $postDto->tags = array_map(function (Tag $tag) {
                $tagDto = new TagItemDto();
                $tagDto->id = $tag->getId();
                $tagDto->title = $tag->getTitle();

                return $tagDto;
            }, $post->getTags()->toArray());

            return $postDto;
        }, $this->posts);

        return $output;
    }
}