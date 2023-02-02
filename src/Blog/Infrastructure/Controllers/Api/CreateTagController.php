<?php

namespace App\Blog\Infrastructure\Controllers\Api;

use App\Blog\Application\UseCases\CreateTagUseCase;
use App\Blog\Application\UseCases\Dto\CreateTagInputDto;
use App\Blog\Application\UseCases\Dto\CreateTagOutputDto;
use App\Blog\Application\UseCases\Dto\ErrorDto;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateTagController extends AbstractController
{
    public function __construct(protected CreateTagUseCase $useCase)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $input = $this->createInput($request);
        $result = $this->useCase->execute($input);

        return $this->json($result, Response::HTTP_OK);
    }

    public function createInput(Request $request): CreateTagInputDto
    {
        $body = $request->toArray();
        $dto = new CreateTagInputDto();
        $dto->title = $body['title'];

        return $dto;
    }
}