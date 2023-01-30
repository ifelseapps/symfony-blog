<?php

namespace App\Blog\Infrastructure\Controllers\Api;

use App\Blog\Application\Interactors\GetPostInputDto;
use App\Blog\Application\Interactors\GetPostsInteractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class GetPostsController extends AbstractController
{
    public function __construct(protected GetPostsInteractor $interactor)
    {
    }

    public function __invoke(): JsonResponse
    {
        $posts = $this->interactor->execute(new GetPostInputDto());
        return $this->json(['posts' => $posts], Response::HTTP_OK, [], [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function (object $obj) {
                return $obj->getId();
            }
        ]);
    }
}