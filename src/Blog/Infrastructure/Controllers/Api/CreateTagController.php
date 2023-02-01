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
        try {
            $input = $this->createInput($request);
            $result = $this->useCase->execute($input);

            return $this->json($result, Response::HTTP_OK);
        } catch (Exception $e) {
            $result = new CreateTagOutputDto();
            $result->success = false;
            $result->error = ErrorDto::createFromException($e);

            return $this->json($result, Response::HTTP_BAD_REQUEST);
        }
    }

    public function createInput(Request $request): CreateTagInputDto
    {
        $body = $request->toArray();
        $dto = new CreateTagInputDto();
        $dto->title = $body['title'];

        return $dto;
    }
}