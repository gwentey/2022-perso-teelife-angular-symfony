<?php


namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UtilisateurController extends AbstractController
{
    #[Route('/api/utilisateur', name: 'utilisateur', methods: ['GET'])]
    public function getAllUtilisateur(UtilisateurRepository $utilisateurRepository, SerializerInterface $serializer): JsonResponse
    {
        $utilisateur = $utilisateurRepository->findAll();
        $jsonUtilisateur = $serializer->serialize($utilisateur, 'json', ['groups' => 'get:utilisateur_full']);

        return new JsonResponse($jsonUtilisateur, Response::HTTP_OK, [], true);
    }

    #[Route('/api/utilisateur/{id}', name: 'unUtilisateur', methods: ['GET'])]
    public function getOnUtilisateur(Utilisateur $utilisateur, SerializerInterface $serializer): JsonResponse
    {

        $jsonUtilisateur = $serializer->serialize($utilisateur, 'json', ['groups' => 'get:utilisateur_full']);
        return new JsonResponse($jsonUtilisateur, Response::HTTP_OK, [], true);
    }

    #[Route('/api/utilisateur/pseudo/{pseudo}', name: 'unUtilisateurParPseudo', methods: ['GET'])]
    public function getOneUtilisateurParPseudo(string $pseudo, utilisateurRepository $utilisateurRepository, SerializerInterface $serializer): JsonResponse
    {

        $utilisateur = $utilisateurRepository->findOneBy(['pseudo' => $pseudo]);

        $jsonUtilisateur = $serializer->serialize($utilisateur, 'json', ['groups' => 'get:utilisateur_full']);
        return new JsonResponse($jsonUtilisateur, Response::HTTP_OK, [], true);
    }

    #[Route('/api/utilisateur/{id}', name: 'deleteUtilisateur', methods: ['DELETE'])]
    public function deleteUtilisateur(Utilisateur $utilisateur, EntityManagerInterface $em): JsonResponse
    {
        $em->remove($utilisateur);
        $em->flush();
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    #[Route('/api/utilisateur', name: 'ajouterUtilisateur', methods: ['POST'])]
    public function creeUtilisateur(
        Request $request,
        SerializerInterface $serializer,
        EntityManagerInterface $em,
        UrlGeneratorInterface $urlGeneratorInterface,
        ValidatorInterface $validator
    ): JsonResponse {
        $utilisateur = $serializer->deserialize($request->getContent(), Utilisateur::class, 'json');

        // On vérifie les erreurs
        $errors = $validator->validate($utilisateur);

        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }

        $em->persist($utilisateur);
        $em->flush();

        $jsonUtilisateur = $serializer->serialize($utilisateur, 'json', ['groups' => 'get:utilisateur_full']);

        $location = $urlGeneratorInterface->generate('unUtilisateur', ['id' => $utilisateur->getId()], UrlGeneratorInterface::ABSOLUTE_PATH);

        return new JsonResponse($jsonUtilisateur, Response::HTTP_CREATED, ["Location" => $location], true);
    }

    #[Route('/api/utilisateur/{id}', name: 'updateUtilisateur', methods: ['PUT'])]
    public function updatePersonnage(
        Request $request,
        SerializerInterface $serializer,
        EntityManagerInterface $em,
        Utilisateur $currentUtilisateur
    ): JsonResponse {
        $utilisateur = $serializer->deserialize($request->getContent(), Utilisateur::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $currentUtilisateur]);

        $em->persist($utilisateur);
        $em->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
