<?php

namespace App\Blog\Infrastructure\Controllers\Api;

use App\Blog\Application\UseCases\Dto\ErrorDto;
use App\Blog\Application\UseCases\Dto\GetPostsInputDto;
use App\Blog\Application\UseCases\Dto\GetPostsOutputDto;
use App\Blog\Application\UseCases\GetPostsUseCase;
use Exception;
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
        try {
            // TODO: Добавить пагинацию
            $result = $this->useCase->execute(new GetPostsInputDto());
            return $this->json($result, Response::HTTP_OK);
        } catch (Exception $e) {
            $result = new GetPostsOutputDto();
            $result->success = false;
            $result->error = ErrorDto::createFromException($e);

            return $this->json($result, Response::HTTP_BAD_REQUEST);
        }
    }
}