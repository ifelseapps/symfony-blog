<?php

namespace App\Blog\Application\Factories;

use App\Blog\Application\Gateways\CategoryRepositoryInterface;
use App\Blog\Application\Gateways\PostRepositoryInterface;
use App\Blog\Application\Gateways\TagRepositoryInterface;
use App\Blog\Application\UseCases\Dto\CreatePostInputDto;
use App\Blog\Application\UseCases\Dto\EditPostInputDto;
use App\Blog\Infrastructure\Entities\Post;
use App\Blog\Infrastructure\Entities\Tag;
use App\Core\Exceptions\NotFoundException;

class PostFactory
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository,
        protected PostRepositoryInterface $postRepository,
        protected TagRepositoryInterface $tagRepository,
    )
    {
    }

    public function create(CreatePostInputDto $input): Post
    {
        $post = new Post();
        $post->setSlug($input->slug);
        $post->setTitle($input->title);
        $post->setContent($input->content);
        $post->setCreatedAt($input->created_at);
        $post->setDescription($input->description);
        $post->setKeywords($input->keywords);

        $category = $this->categoryRepository->findById($input->category);
        $post->setCategory($category);

        $post->setEnabled($input->enabled);

        return $post;
    }

    public function edit(EditPostInputDto $input): Post
    {
        $post = $this->postRepository->findById($input->id);
        if (null === $post) {
            throw new NotFoundException('Post not found');
        }

        $fields = $input->fields;

        if (isset($fields['slug'])) {
            $post->setSlug($fields['slug']);
        }

        if (isset($fields['title'])) {
            $post->setTitle($fields['title']);
        }

        if (isset($fields['content'])) {
            $post->setContent($fields['content']);
        }

        if (isset($fields['created_at'])) {
            $post->setCreatedAt($fields['created_at']);
        }

        if (isset($fields['description'])) {
            $post->setDescription($fields['description']);
        }

        if (isset($fields['keywords'])) {
            $post->setKeywords($fields['keywords']);
        }

        if (isset($fields['enabled'])) {
            $post->setEnabled($fields['enabled']);
        }

        if (isset($fields['tags']) && is_array($fields['tags'])) {
            /**
             * @var Tag[] $allTags
             * @todo В будущем можем упереться в производительность при очень большом количестве тегов
             */
            $allTags = $this->tagRepository->findAll();

            foreach ($allTags as $tag) {
                $title = $tag->getTitle();
                if (in_array($title, $fields['tags'])) {
                    $post->addTag($tag);
                } else {
                    $post->removeTag($tag);
                }
            }
        }

        if (isset($fields['category'])) {
            $category = $this->categoryRepository->findById($fields['category']);
            if (null === $category) {
                throw new NotFoundException('Category not found');
            }
            $post->setCategory($category);
        }

        return $post;
    }
}