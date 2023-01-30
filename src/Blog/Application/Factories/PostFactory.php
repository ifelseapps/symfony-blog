<?php

namespace App\Blog\Application\Factories;

use App\Blog\Application\Gateways\CategoryRepositoryInterface;
use App\Blog\Application\Interactors\CreatePostInputDto;
use App\Blog\Infrastructure\Entities\Category;
use App\Blog\Infrastructure\Entities\Post;
use Symfony\Component\Uid\Uuid;

class PostFactory
{
    public function __construct(protected CategoryRepositoryInterface $categoryRepository)
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
}