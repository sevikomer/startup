<?php

namespace App\Controller;

use App\Repository\CaRepository;
use App\Entity\Ca;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class CaController extends AbstractController
{
    #[Route('/api/ca', name: 'app_ca', methods: ['GET'])]
    public function getClientList(CaRepository $caRepository, SerializerInterface $serializer): JsonResponse
    {

        $caList = $caRepository->findAll();
        $jsonCaList = $serializer->serialize($caList, 'json', ['groups' => 'getProfil']);

        return new JsonResponse($jsonCaList, Response::HTTP_OK, [], true);
    }


    #[Route('/api/ca', name: "createCa", methods: ['POST'])]
    public function createCa(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator): JsonResponse
    {

        $ca = $serializer->deserialize($request->getContent(), Ca::class, 'json');
        $em->persist($ca);
        $em->flush();

        $jsonCa = $serializer->serialize($ca, 'json');

        $location = $urlGenerator->generate('createCa', ['id' => $ca->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        return new JsonResponse($jsonCa, Response::HTTP_CREATED, ["Location" => $location], true);
    }
}
