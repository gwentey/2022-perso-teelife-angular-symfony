<?php

namespace App\Controller;

use App\Entity\Personnage;
use App\Entity\SituationPersonnage;
use App\Repository\PersonnageRepository;
use App\Repository\UtilisateurRepository;
use App\Repository\VilleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PersonnageController extends AbstractController
{
    
    #[Route('/api/personnage', name: 'personnage', methods: ['GET'])]
    public function getAllPersonnage(PersonnageRepository $personnageRepository, SerializerInterface $serializer): JsonResponse
    {
        $personnage = $personnageRepository->findAll();

        $jsonPersonnage = $serializer->serialize($personnage, 'json', ['groups' => 'get:info_personnage_full']);

        return new JsonResponse($jsonPersonnage, Response::HTTP_OK, [], true);
    }

    #[Route('/api/personnage/{id}', name: 'unPersonnage', methods: ['GET'])]
    public function getOnePersonnage(Personnage $personnage, SerializerInterface $serializer): JsonResponse
    {
        $jsonPersonnage = $serializer->serialize($personnage, 'json', ['groups' => 'get:info_personnage_full']);
        return new JsonResponse($jsonPersonnage, Response::HTTP_OK, [], true);

        /*      Alternative :    
        $personnage = $personnageRepository->find($id);
        if($personnage) {
            $jsonPersonnage = $serializer->serialize($personnage, 'json', ['groups' => 'get:info_personnage_full']);
            return new JsonResponse($jsonPersonnage, Response::HTTP_OK, [], true);

        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
         */
    }

    #[Route('/api/personnage/{id}', name: 'deletePersonnage', methods: ['DELETE'])]
    public function deletePersonnage(Personnage $personnage, EntityManagerInterface $em): JsonResponse
    {

        $em->remove($personnage);
        $em->flush();
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }



    #[Route('/api/personnage', name: 'ajouterPersonnage', methods: ['POST'])]
    public function creePersonnage(
        Request $request,
        SerializerInterface $serializer,
        EntityManagerInterface $em,
        UtilisateurRepository $utilisateurRepository,
        VilleRepository $villeRepository,
        UrlGeneratorInterface $urlGeneratorInterface,
        ValidatorInterface $validator
    ): JsonResponse {
        $personnage = $serializer->deserialize($request->getContent(), Personnage::class, 'json');

        // On vérifie les erreurs
        $errors = $validator->validate($personnage);

        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }

        $content = $request->toArray();
        $idUtilisateur = $content['id_utilisateur'] ?? -1;
        $idVille = $content['id_ville'] ?? -1;


        $personnage->setIdUtilisateur($utilisateurRepository->find($idUtilisateur));
        $personnage->setIdVille($villeRepository->find($idVille));

        $em->persist($personnage);
        $em->flush();

        $jsonPersonnage = $serializer->serialize($personnage, 'json', ['groups' => 'get:info_personnage_full']);

        $location = $urlGeneratorInterface->generate('unPersonnage', ['id' => $personnage->getId()], UrlGeneratorInterface::ABSOLUTE_PATH);

        return new JsonResponse($jsonPersonnage, Response::HTTP_CREATED, ["Location" => $location], true);
    }

    #[Route('/api/personnage/{id}', name: 'updatePersonnage', methods: ['PUT'])]
    public function updatePersonnage(
        Request $request,
        SerializerInterface $serializer,
        EntityManagerInterface $em,
        UtilisateurRepository $utilisateurRepository,
        VilleRepository $villeRepository,
        Personnage $currentPersonnage
    ): JsonResponse {
        $personnage = $serializer->deserialize($request->getContent(), Personnage::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $currentPersonnage]);


        $content = $request->toArray();
        $idUtilisateur = $content['id_utilisateur'] ?? -1;
        $idVille = $content['id_ville'] ?? -1;


        $personnage->setIdUtilisateur($utilisateurRepository->find($idUtilisateur));
        $personnage->setIdVille($villeRepository->find($idVille));

        $em->persist($personnage);
        $em->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    #[Route('/api/personnage/situation/', name: 'situationPersonnageChangement', methods: ['PUT'])]
    public function updateSituationPersonnage(
        Request $request,
        EntityManagerInterface $em,
        PersonnageRepository $personnageRepository,
    ): JsonResponse {

        $content = $request->toArray();
        $idPersonnage = $content['id_personnage'] ?? -1;
        $argentLiquide = $content['argent_liquide'] ?? -1;

        $personnage = $personnageRepository->find($idPersonnage);
        
        $situationPersonnage = $personnage->getSituationPersonnage();
        $situationPersonnage->setArgentLiquide($argentLiquide);

        $em->persist($situationPersonnage);
        $em->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

}
