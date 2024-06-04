<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/api/user', name: 'app_user', methods: ['GET'])]
    public function getClientList(UserRepository $userRepository, SerializerInterface $serializer): JsonResponse
    {

        $userList = $userRepository->findAll();
        $jsonUserList = $serializer->serialize($userList, 'json', ['groups' => 'getProfil']);

        return new JsonResponse($jsonUserList, Response::HTTP_OK, [], true);
    }
}
