<?php

namespace App\Blog\Infrastructure\Controllers\Api;

use App\Blog\Application\Interactors\GetPostsInputDto;
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
        // TODO: Добавить пагинацию
        $result = $this->interactor->execute(new GetPostsInputDto());
        return $this->json($result);
    }
}