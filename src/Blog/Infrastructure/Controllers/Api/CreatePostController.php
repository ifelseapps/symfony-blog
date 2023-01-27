<?php

namespace App\Blog\Infrastructure\Controllers\Api;

use App\Blog\Application\Interactors\CreatePostInputDto;
use App\Blog\Application\Interactors\CreatePostInteractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreatePostController extends AbstractController
{
    public function __construct(protected CreatePostInteractor $interactor)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $result = $this->interactor->execute(CreatePostInputDto::createFromRequest($request));
        return $this->json(['success' => true, 'id' => $result->id]);
    }
}