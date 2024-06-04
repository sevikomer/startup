<?php

namespace App\Controller;

use App\Repository\ProfilRepository;
use App\Repository\ClientsRepository;
use App\Entity\Profil;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;


use Symfony\Component\Routing\Attribute\Route;

class ProfilController extends AbstractController
{
    #[Route('/api/profil', name: 'app_profil', methods: ['GET'])]
    public function getClientList(ProfilRepository $profilRepository, SerializerInterface $serializer): JsonResponse
    {

        $profilList = $profilRepository->findAll();
        $jsonProfilList = $serializer->serialize($profilList, 'json', ['groups' => 'getProfil']);

        return new JsonResponse($jsonProfilList, Response::HTTP_OK, [], true);
    }


    #[Route('/api/profil/{id}', name: "updateProfil", methods: ['PUT'])]

    public function updateBook(Request $request, SerializerInterface $serializer, Profil $currentProfil, EntityManagerInterface $em, ValidatorInterface $validator): JsonResponse
    {
        $updatedProfil = $serializer->deserialize(
            $request->getContent(),
            Profil::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $currentProfil]
        );

        // On vérifie les erreurs
        $errors = $validator->validate($updatedProfil);

        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }

        // $content = $request->toArray();
        // $idClient = $content['id'] ?? -1;
        // $updatedProfil->setAuthor($clientsRepository->find($idClient));

        $em->persist($updatedProfil);
        $em->flush();
        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
