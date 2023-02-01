<?php

namespace App\Blog\Infrastructure\Controllers\Api;

use App\Blog\Application\UseCases\Dto\EditPostInputDto;
use App\Blog\Application\UseCases\Dto\EditPostOutputDto;
use App\Blog\Application\UseCases\Dto\ErrorDto;
use App\Blog\Application\UseCases\EditPostUseCase;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EditPostController extends AbstractController
{
    public function __construct(protected EditPostUseCase $useCase)
    {
    }

    public function __invoke(Request $request): Response
    {
        try {
            $input = $this->createInput($request);
            $result = $this->useCase->execute($input);

            return $this->json($result, Response::HTTP_OK);
        } catch (Exception $e) {
            $result = new EditPostOutputDto();
            $result->success = false;
            $result->error = ErrorDto::createFromException($e);

            return $this->json($result, Response::HTTP_BAD_REQUEST);
        }
    }

    public function createInput(Request $request): EditPostInputDto
    {
        $body = $request->toArray();
        $input = new EditPostInputDto();
        $input->id = $body['id'];
        $input->fields = $body['fields'];

        return $input;
    }
}