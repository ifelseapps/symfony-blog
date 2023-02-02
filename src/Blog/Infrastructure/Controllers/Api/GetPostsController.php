<?php

namespace App\Blog\Infrastructure\Controllers\Api;

use App\Blog\Application\UseCases\Dto\GetPostsInputDto;
use App\Blog\Application\UseCases\GetPostsUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetPostsController extends AbstractController
{
    public function __construct(protected GetPostsUseCase $useCase)
    {
    }

    public function __invoke(): JsonResponse
    {
        // TODO: Добавить пагинацию
        $result = $this->useCase->execute(new GetPostsInputDto());
        return $this->json($result, Response::HTTP_OK);
    }
}