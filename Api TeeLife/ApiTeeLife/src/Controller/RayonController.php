<?php

namespace App\Controller;

use App\Entity\ProduitRayon;
use App\Repository\ProduitRayonRepository;
use App\Repository\RayonMagasinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class RayonController extends AbstractController
{

    #[Route('/api/magasin/{id_magasin}/rayon/{id_rayon}/produit', name: 'ProduitRayon', methods: ['GET'])]
    public function getAllProduitFromARayon(int $id_magasin, int $id_rayon, RayonMagasinRepository $rayonMagasinRepository, 
    ProduitRayonRepository $produitRayonRepository, SerializerInterface $serializer): JsonResponse
    {        
        $produitRayon = $produitRayonRepository->findBy(['id_rayon' => $id_rayon]);

        $jsonProduitRayon = $serializer->serialize($produitRayon, 'json', ['groups' => 'get:rayon_by_magasin']);

        return new JsonResponse($jsonProduitRayon, Response::HTTP_OK, [], true);
    }


    #[Route('/api/magasin/{id_magasin}/rayon', name: 'rayon', methods: ['GET'])]
    public function getAllRayonByMagasin(int $id_magasin, RayonMagasinRepository $rayonMagasinRepository, SerializerInterface $serializer): JsonResponse
    {
        $rayon = $rayonMagasinRepository->findBy(['id_magasin' => $id_magasin]);
        $jsonRayon = $serializer->serialize($rayon, 'json', ['groups' => 'get:rayon_by_magasin']);

        return new JsonResponse($jsonRayon, Response::HTTP_OK, [], true);
    }

    #[Route('/api/magasin/{id_magasin}/rayon/{id_rayon}', name: 'leRayon', methods: ['GET'])]
    public function getUnRayon(int $id_rayon, RayonMagasinRepository $rayonMagasinRepository, SerializerInterface $serializer): JsonResponse
    {
        $rayon = $rayonMagasinRepository->find($id_rayon);
        $jsonRayon = $serializer->serialize($rayon, 'json', ['groups' => 'get:rayon_by_magasin']);

        return new JsonResponse($jsonRayon, Response::HTTP_OK, [], true);
    }

}
