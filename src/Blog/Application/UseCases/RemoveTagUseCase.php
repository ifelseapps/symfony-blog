<?php

namespace App\Blog\Application\UseCases;

use App\Blog\Application\Gateways\TagRepositoryInterface;
use App\Blog\Application\UseCases\Dto\RemoveTagInputDto;
use App\Blog\Application\UseCases\Dto\RemoveTagOutputDto;
use App\Core\Exceptions\NotFoundException;

class RemoveTagUseCase
{
    public function __construct(protected TagRepositoryInterface $tagRepository)
    {
    }

    public function execute(RemoveTagInputDto $input): RemoveTagOutputDto
    {
        $tag = $this->tagRepository->findById($input->id);
        if (null === $tag) {
            throw new NotFoundException();
        }

        $this->tagRepository->remove($tag, true);

        $output = new RemoveTagOutputDto();
        $output->success = true;

        return $output;
    }
}