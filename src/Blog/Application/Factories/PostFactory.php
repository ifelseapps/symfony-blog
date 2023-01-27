<?php

namespace App\Blog\Application\Factories;

use App\Blog\Application\Interactors\CreatePostInputDto;
use App\Blog\Infrastructure\Entities\Category;
use App\Blog\Infrastructure\Entities\Post;

class PostFactory
{
    public function create(CreatePostInputDto $input): Post
    {
        $post = new Post();
        $post->setSlug($input->slug);
        $post->setTitle($input->title);
        $post->setContent($input->content);
        $post->setCreatedAt($input->created_at);
        $post->setDescription($input->description);
        $post->setKeywords($input->keywords);

//        $post->setCategory($input->category);

        $post->setEnabled($input->enabled);

        return $post;
    }
}