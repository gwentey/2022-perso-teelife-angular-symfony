<?php

namespace App\Controller;

use App\Entity\Magasin;
use App\Repository\MagasinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class MagasinController extends AbstractController
{
    #[Route('/api/magasin', name: 'magasin', methods: ['GET'])]
    public function getAllMagasin(MagasinRepository $magasinRepository, SerializerInterface $serializer): JsonResponse
    {
        $magasin = $magasinRepository->findAll();

        $jsonMagasin = $serializer->serialize($magasin, 'json', ['groups' => 'get:info_magasin']);

        return new JsonResponse($jsonMagasin, Response::HTTP_OK, [], true);
    }

    #[Route('/api/magasin/{id}', name: 'unMagasin', methods: ['GET'])]
    public function getOneMagasin(Magasin $magasin, SerializerInterface $serializer): JsonResponse
    {

        $jsonMagasin = $serializer->serialize($magasin, 'json', ['groups' => 'get:info_magasin']);
        return new JsonResponse($jsonMagasin, Response::HTTP_OK, [], true);
    }
}
