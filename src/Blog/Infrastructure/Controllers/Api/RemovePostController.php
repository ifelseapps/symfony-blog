<?php

namespace App\Blog\Infrastructure\Controllers\Api;

use App\Blog\Application\UseCases\Dto\RemovePostInputDto;
use App\Blog\Application\UseCases\RemovePostUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RemovePostController extends AbstractController
{
    public function __construct(protected RemovePostUseCase $useCase)
    {
    }

    public function __invoke(Request $request)
    {
        $body = $request->toArray();
        $input = new RemovePostInputDto();
        $input->id = $body['id'];

        $result = $this->useCase->execute($input);

        return $this->json($result, Response::HTTP_OK);
    }
}