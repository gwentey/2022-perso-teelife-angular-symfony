<?php

namespace App\Controller;

use App\Entity\CompositionPanier;
use App\Entity\Panier;
use App\Repository\MagasinRepository;
use App\Repository\PanierRepository;
use App\Repository\PersonnageRepository;
use App\Repository\ProduitRayonRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Expr\AssignOp\Mod;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PanierController.php',
        ]);
    }

    // obtenir le dernier panier ouvert de l'utilisateur dans le magasin
    #[Route('/api/panier/{id_magasin}/{id_personnage}', name: 'getCurrentPanier', methods: ['GET'])]
    public function getPanierCurrentByMagasinAndPersonnage(int $id_magasin, int $id_personnage, PanierRepository $panierRepository, SerializerInterface $serializer): JsonResponse
    {
        $panier = $panierRepository->findBy([
            'id_magasin' => $id_magasin,
            'id_personnage' => $id_personnage,
            'payer' => 0
        ]);
        $jsonPanier = $serializer->serialize($panier, 'json', ['groups' => 'get:panier']);

        return new JsonResponse($jsonPanier, Response::HTTP_OK, [], true);
    }

    // information sur le panier
    #[Route('/api/panier/{id_panier}', name: 'getPanierById', methods: ['GET'])]
    public function getPanierById(int $id_panier, PanierRepository $panierRepository, SerializerInterface $serializer): JsonResponse
    {
        $panier = $panierRepository->find($id_panier);
        $jsonPanier = $serializer->serialize($panier, 'json', ['groups' => 'get:panier']);

        return new JsonResponse($jsonPanier, Response::HTTP_OK, [], true);
    }



    #[Route('/api/panier/', name: 'creePanier', methods: ['POST'])]
    public function creePanier(
        Request $request,
        EntityManagerInterface $em,
        MagasinRepository $magasinRepository,
        PersonnageRepository $personnageRepository,
        SerializerInterface $serializer
    ): JsonResponse {

        $content = $request->toArray();
        $id_magasin = $content['id_magasin'];
        $id_personnage = $content['id_personnage'];
        $payer = $content['payer'];


        $panier = new Panier();
        $panier->setIdMagasin($magasinRepository->find($id_magasin));
        $panier->setIdPersonnage($personnageRepository->find($id_personnage));
        $panier->setPayer($payer);

        $em->persist($panier);
        $em->flush();

        $panierJson = $serializer->serialize($panier, 'json', ['groups' => 'get:panier']);

        return new JsonResponse($panierJson, Response::HTTP_CREATED, [], true);
    }

    #[Route('/api/panier/addproduct/', name: 'addProductOnAPanier', methods: ['POST'])]
    public function ajouterUnArticleAUnPanier(
        Request $request,
        EntityManagerInterface $em,
        PanierRepository $panierRepository,
        ProduitRayonRepository $produitRayonRepository,
        SerializerInterface $serializer
    ): JsonResponse {

        $content = $request->toArray();
        $id_panier = $content['id_panier'];
        $id_produit_rayon = $content['id_produit_rayon'];
        $quantite = $content['quantite'];


        $compositionPanier = new CompositionPanier();
        $compositionPanier->setIdPanier($panierRepository->find($id_panier));
        $compositionPanier->setIdProduitRayon($produitRayonRepository->find($id_produit_rayon));
        $compositionPanier->setQuantite($quantite);
        
        $em->persist($compositionPanier);
        $em->flush();

        $compositionPanierJson = $serializer->serialize($compositionPanier, 'json', ['groups' => 'get:panier']);

        return new JsonResponse($compositionPanierJson, Response::HTTP_CREATED, [], true);
    }


    #[Route('/api/panier/', name: 'payerUnPanier', methods: ['PUT'])]
    public function payerUnPanier(
        Request $request,
        EntityManagerInterface $em,
        PanierRepository $panierRepository,
        SerializerInterface $serializer
    ): JsonResponse {

        $content = $request->toArray();
        $id_panier = $content['id_panier'];

        $panier = $panierRepository->find($id_panier);
        $panier->setPayer(true);

        $em->persist($panier);
        $em->flush();

        $panierJson = $serializer->serialize($panier, 'json', ['groups' => 'get:panier']);

        return new JsonResponse($panierJson, Response::HTTP_CREATED, [], true);
    }

}
