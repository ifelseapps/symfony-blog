<?php

namespace App\Blog\Application\Interactors;

use App\Blog\Application\Gateways\PostRepositoryInterface;
use App\Blog\Infrastructure\Entities\Post;
use App\Blog\Infrastructure\Entities\Tag;

class GetPostsInteractor
{
    public function __construct(protected PostRepositoryInterface $postRepository)
    {
    }

    public function execute(GetPostsInputDto $input): GetPostsOutputDto
    {
        $posts = $this->postRepository->getAll(page: $input->page, perPage: $input->perPage);
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
        }, $posts);

        return $output;
    }
}