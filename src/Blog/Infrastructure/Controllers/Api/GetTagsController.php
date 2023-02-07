<?php

namespace App\Blog\Infrastructure\Controllers\Api;

use App\Blog\Application\UseCases\GetTagsUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GetTagsController extends AbstractController
{
    public function __construct(protected GetTagsUseCase $useCase)
    {
    }

    public function __invoke(): Response
    {
        $result = $this->useCase->execute();

        return $this->json($result, Response::HTTP_OK);
    }
}