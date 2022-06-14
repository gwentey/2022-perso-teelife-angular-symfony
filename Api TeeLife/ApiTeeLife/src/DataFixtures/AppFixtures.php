<?php

namespace App\DataFixtures;

use App\Entity\Personnage;
use App\Entity\User;
use App\Entity\Utilisateur;
use App\Entity\Ville;
use App\Entity\Entreprise;
use App\Entity\Magasin;
use App\Entity\Produit;
use App\Entity\ProduitRayon;
use App\Entity\RayonMagasin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Constraints\Length;

class AppFixtures extends Fixture
{

    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }


    public function load(ObjectManager $manager): void
    {

        $lesUtilisateurs = array();
        $lesVilles = array();
        $lesProduits = array();
        $lesRayons = array();



        $lesVillesNoms = ['Stanley', 'Hyppolite', 'Mia', 'Athéna'];
        $tableauDePrix = [0.50, 2.85, 14.90, 12, 10, 2, 7, 4, 9, 2.7, 3.9, 1.20, 3];



        // Création d'un user "normal" (pour interroger l'api )
        $user = new User();
        $user->setEmail("user@api.com");
        $user->setRoles(["ROLE_USER"]);
        $user->setPassword($this->userPasswordHasher->hashPassword($user, "password"));
        $manager->persist($user);

        // Création d'un user admin (pour interroger l'api )
        $userAdmin = new User();
        $userAdmin->setEmail("admin@api.com");
        $userAdmin->setRoles(["ROLE_ADMIN"]);
        $userAdmin->setPassword($this->userPasswordHasher->hashPassword($userAdmin, "password"));
        $manager->persist($userAdmin);

        // création des villes avec les noms
        foreach ($lesVillesNoms as $nom) {
            $ville = new Ville();
            $ville->setNom($nom);

            $manager->persist($ville);
            array_push($lesVilles, $ville);
        }

        $lesProduitsImages = ['../assets/img/produit-epicerie-pain.png', '../assets/img/produit-epicerie-pizza.png',
         'https://cdn3.iconfinder.com/data/icons/salad/512/vegetable-healthy-vitamins-food-512.png', 
         'https://cdn4.iconfinder.com/data/icons/fruits-79/48/23-grape-512.png', 
         'https://cdn4.iconfinder.com/data/icons/fruits-79/48/19-green_apple-512.png', 
         'https://cdn3.iconfinder.com/data/icons/food-and-drink-color/64/food_meat_beef_roast_rib_eye_steak_cooking-256.png', 
         'https://cdn4.iconfinder.com/data/icons/vegetables-58/48/05-broccoflower-512.png',
         'https://cdn4.iconfinder.com/data/icons/fruits-79/48/15-banana-512.png', 
        'https://cdn4.iconfinder.com/data/icons/fruits-79/48/02-Strawberry-512.png',
    'https://cdn4.iconfinder.com/data/icons/fruits-79/48/21-kiwi-512.png',
    "https://cdn4.iconfinder.com/data/icons/fruits-79/48/01-watermelon-512.png",
    "https://cdn3.iconfinder.com/data/icons/food-3-11/128/food_Milk-Bottle-Dairy-Breakfast-512.png",
    "https://cdn0.iconfinder.com/data/icons/food-177/64/fish-meat-sea-food-512.png",
    "https://cdn4.iconfinder.com/data/icons/vegetables-58/48/14-onion-512.png",
    "https://cdn4.iconfinder.com/data/icons/vegetables-58/48/15-potato-512.png",
    "https://cdn2.iconfinder.com/data/icons/furniture-for-home-and-backyard/100/pergola_backyard_construction_color_furniture_home_dinning-512.png",
    "https://cdn4.iconfinder.com/data/icons/apple-products-2026/512/MacBook-512.png",
    "https://cdn0.iconfinder.com/data/icons/apple-products-2026/512/iPhone_11_kopie0-512.png",
    "https://cdn2.iconfinder.com/data/icons/apple-products-set/128/Apple_AirPods-2-512.png",
    "https://cdn3.iconfinder.com/data/icons/spring-2-1/30/Rose-512.png",
    "https://cdn4.iconfinder.com/data/icons/activity-1-1/32/23-512.png",
    "https://cdn2.iconfinder.com/data/icons/interior-homedecor-vol-1/512/tv_cabinet_television_interior-512.png",
    "https://cdn2.iconfinder.com/data/icons/sea-rest-cartoon-2/512/d341_8-512.png",
    "https://cdn4.iconfinder.com/data/icons/check-out-vol-1-colored/48/JD-32-512.png"

];
        $lesNomsProduits = ['Pain', 'Pizza', 'Panier de fruit', 'Raisin', 'Pomme', "Steack", "Chou-fleur", "Banane",
    "Fraise", "Kiwi", "Pastèque", "Lait", "Poisson", "Oignon", "Pomme de terre", "Pergola Bio", "MacBook Pro",
"Iphone", "Airpods", "Rose", "Ballon", "Télévision 4K", "Transate", "Cadenas"];
        // création de produit
        for ($i = 0; $i < count($lesProduitsImages); $i++) {

            $produit = new Produit();
            $produit->setAddictif(0);
            $produit->setImage($lesProduitsImages[$i]);
            $produit->setNom($lesNomsProduits[$i]);

            $manager->persist($produit);
            array_push($lesProduits, $produit);
        }


        // création des utilisateurs
        for ($i = 0; $i < 5; $i++) {
            $utilisateur = new Utilisateur();
            $utilisateur->setEmail("email@email.fr");
            $utilisateur->setPassword("xxxx");
            $utilisateur->setPseudo("Pseudo" . $i);

            $manager->persist($utilisateur);
            array_push($lesUtilisateurs, $utilisateur);
        }

        // création des personnages
        for ($i = 0; $i < 5; $i++) {

            $personnage = new Personnage();
            $personnage->setIdUtilisateur($lesUtilisateurs[$i]);
            $personnage->setIdVille($lesVilles[array_rand($lesVilles)]);
            $personnage->setNom("Nom" . $i);
            $personnage->setPrenom("Prenom" . $i);

            $manager->persist($personnage);
        }

        // création de l'etat, son entreprise et son magasin
        $utilisateur = new Utilisateur();
        $utilisateur->setEmail("president@president.fr");
        $utilisateur->setPassword("president");
        $utilisateur->setPseudo("president");
        $manager->persist($utilisateur);

        $personnage = new Personnage();
        $personnage->setIdUtilisateur($utilisateur);
        $personnage->setIdVille($lesVilles[array_rand($lesVilles)]);
        $personnage->setNom("Gouv");
        $personnage->setPrenom("President");
        $manager->persist($personnage);

        $entreprise = new Entreprise();
        $entreprise->setIdCreateur($personnage);
        $entreprise->setIdVille($lesVilles[array_rand($lesVilles)]);
        $entreprise->setNom("Magasin de la ville");
        $manager->persist($entreprise);

        $magasin = new Magasin();
        $magasin->setIdEntreprise($entreprise);
        $magasin->setImageAffichage("../assets/img/MALL%20CENTRAL.png");
        $magasin->setImageCouverture("../assets/img/couverture%20shop%20808,25148,25%20.png");
        $magasin->setNom("MALL CENTRAL");
        $magasin->setPresentation("Bienvenue dans au Mall Central. Magasin officiel du gouvernement. Régi par le maire et l'assemblée de votre ville.");
        $magasin->setPresentationCourte("Magasin officiel du gouvernement de votre ville");
        $manager->persist($magasin);

        // création des 6 rayons
        $nomRayon = ['Promotion', 'Liquide', 'Hygiène', 'Epicerie', 'Textile', 'Bazar'];
        $imageRayon = [
            '../assets/img/nom-rayon-promo.png', '../assets/img/nom-rayon-liquide.png',
            '../assets/img/nom-rayon-hygiene.png', '../assets/img/nom-rayon-epicerie.png',
            '../assets/img/nom-rayon-textile.png', '../assets/img/nom-rayon-bazar.png',
        ];

        for ($i = 0; $i < 6; $i++) {
            $rayon = new RayonMagasin();
            $rayon->setIdMagasin($magasin);
            $rayon->setImage($imageRayon[$i]);
            $rayon->setNom($nomRayon[$i]);

            $manager->persist($rayon);
            array_push($lesRayons, $rayon);
        }

        // ajout de produit dans le rayon promotion

        for ($i = 0; $i < count($lesProduits); $i++) {
            $produitRayon = new ProduitRayon();
            $produitRayon->setIdProduit($lesProduits[$i]);
            $produitRayon->setIdRayon($lesRayons[array_rand($lesRayons)]);
            $produitRayon->setPrix($tableauDePrix[array_rand($tableauDePrix)]);
            $produitRayon->setQuantite(rand(3, 20));

            $manager->persist($produitRayon);
        }

        $manager->flush();
    }
}
