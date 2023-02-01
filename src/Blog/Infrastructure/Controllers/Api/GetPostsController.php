<?php

namespace App\Blog\Infrastructure\Controllers\Api;

use App\Blog\Application\UseCases\Dto\GetPostsInputDto;
use App\Blog\Application\UseCases\GetPostsUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetPostsController extends AbstractController
{
    public function __construct(protected GetPostsUseCase $interactor)
    {
    }

    public function __invoke(): JsonResponse
    {
        // TODO: Добавить пагинацию
        $result = $this->interactor->execute(new GetPostsInputDto());
        return $this->json($result);
    }
}