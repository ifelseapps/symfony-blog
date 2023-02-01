<?php

namespace App\Blog\Infrastructure\Controllers\Api;

use App\Blog\Application\UseCases\Dto\EditPostInputDto;
use App\Blog\Application\UseCases\EditPostUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EditPostController extends AbstractController
{
    public function __construct(protected EditPostUseCase $interactor)
    {
    }

    public function __invoke(Request $request): Response
    {
        $body = json_decode($request->getContent(), true);
        $input = new EditPostInputDto();
        $input->id = $body['id'];
        $input->fields = $body['fields'];

        $result = $this->interactor->execute($input);

        return $this->json(['success' => true, 'id' => $result->id]);
    }
}