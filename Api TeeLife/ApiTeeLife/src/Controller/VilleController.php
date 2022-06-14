<?php


namespace App\Controller;

use App\Repository\VilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class VilleController extends AbstractController
{
    #[Route('/api/ville', name: 'ville', methods: ['GET'])]
    public function getAllVille(VilleRepository $villeRepository, SerializerInterface $serializer): JsonResponse
    {
        $ville = $villeRepository->findAll();

        $jsonVille = $serializer->serialize($ville, 'json', ['groups' => 'get:ville']);

        return new JsonResponse($jsonVille, Response::HTTP_OK, [], true);
    }
}
