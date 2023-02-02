<?php

namespace App\Blog\Infrastructure\Controllers\Api;

use App\Blog\Application\UseCases\CreatePostUseCase;
use App\Blog\Application\UseCases\Dto\CreatePostInputDto;
use DateTimeImmutable;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreatePostController extends AbstractController
{
    public function __construct(protected CreatePostUseCase $useCase)
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(Request $request): JsonResponse
    {
        $input = $this->createInput($request);
        $result = $this->useCase->execute($input);

        return $this->json($result, Response::HTTP_OK);
    }

    /**
     * @throws Exception
     */
    private function createInput(Request $request): CreatePostInputDto
    {
        $body = $request->toArray();
        $input = new CreatePostInputDto();
        $input->slug = $body['slug'];
        $input->title = $body['title'];
        $input->content = $body['content'];
        $input->created_at = new DateTimeImmutable($body['created_at']);
        $input->description = $body['description'];
        $input->keywords = $body['keywords'];
        $input->category = $body['category'];
        $input->enabled = $body['enabled'];

        return $input;
    }
}