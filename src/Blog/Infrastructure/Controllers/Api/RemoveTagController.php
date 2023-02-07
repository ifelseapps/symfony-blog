<?php

namespace App\Blog\Infrastructure\Controllers\Api;

use App\Blog\Application\UseCases\Dto\RemoveTagInputDto;
use App\Blog\Application\UseCases\RemoveTagUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RemoveTagController extends AbstractController
{
    public function __construct(protected RemoveTagUseCase $useCase)
    {
    }

    public function __invoke(Request $request): Response
    {
        $body = $request->toArray();
        $input = new RemoveTagInputDto();
        $input->id = $body['id'];

        $result = $this->useCase->execute($input);

        return $this->json($result, Response::HTTP_OK);
    }
}