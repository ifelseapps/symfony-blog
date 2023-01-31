<?php

namespace App\Core\Infrastructure\Controllers\Api;

use App\Core\Application\Gateways\UserRepositoryInterface;
use App\Core\Infrastructure\Entities\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUserController extends AbstractController
{
    /** @todo создать интерактор */
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected UserPasswordHasherInterface $hasher,
    )
    {
    }

    public function __invoke(Request $request): Response
    {
        $body = json_decode($request->getContent(), true);
        $user = new User();
        $user->setUsername($body['username']);
        $user->setPassword($this->hasher->hashPassword($user, $body['password']));
        $user->setRoles($body['roles']);
        $user->setToken($body['token']);

        $this->userRepository->save($user, true);

        return $this->json(['success' => true, 'id' => $user->getId()]);
    }
}