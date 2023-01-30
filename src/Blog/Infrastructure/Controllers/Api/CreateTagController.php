<?php

namespace App\Blog\Infrastructure\Controllers\Api;

use App\Blog\Application\Interactors\CreateTagInputDto;
use App\Blog\Application\Interactors\CreateTagInteractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateTagController extends AbstractController
{
    public function __construct(protected CreateTagInteractor $interactor)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $result = $this->interactor->execute(CreateTagInputDto::createFromRequest($request));

        return $this->json(['success' => true, 'id' => $result->id], Response::HTTP_OK);
    }
}