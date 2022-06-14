<?php

namespace App\Entity;

use App\Repository\PersonnageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PersonnageRepository::class)]
class Personnage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['get:info_personnage_full', 'get:utilisateur_full', 'get:panier'])]
    private $id;

    #[ORM\ManyToOne(targetEntity: Utilisateur::class, inversedBy: 'personnages')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['get:info_personnage_full'])]
    private $id_utilisateur;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['get:info_personnage_full', 'get:utilisateur_full'])]
    #[Assert\NotBlank(message: "Le nom est obligatoire")]
    #[Assert\Length(min: 1, max: 255, minMessage: "Le nom doit faire au moins {{ limit }} caractères", maxMessage: "Le nom ne peut pas faire plus de {{ limit }} caractères")]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['get:info_personnage_full', 'get:utilisateur_full'])]
    private $prenom;

    #[ORM\OneToOne(mappedBy: 'id_personnage', targetEntity: SituationPersonnage::class, cascade: ['persist', 'remove'])]
    #[Groups(['get:info_personnage_full'])]
    private $situationPersonnage;

    #[ORM\OneToOne(mappedBy: 'id_personnage', targetEntity: InteractionsPersonnage::class, cascade: ['persist', 'remove'])]
    #[Groups(['get:info_personnage_full'])]
    private $interactionsPersonnage;

    #[ORM\OneToMany(mappedBy: 'id_personnage', targetEntity: DiplomesPersonnage::class, cascade: ['persist', 'remove'])]
    #[Groups(['get:info_personnage_full'])]
    private $diplomesPersonnages;

    #[ORM\OneToOne(mappedBy: 'id_personnage', targetEntity: SantePersonnage::class, cascade: ['persist', 'remove'])]
    #[Groups(['get:info_personnage_full'])]
    private $santePersonnage;

    #[ORM\ManyToOne(targetEntity: Ville::class, inversedBy: 'personnages')]
    #[Groups(['get:info_personnage_full'])]
    private $id_ville;

    #[ORM\OneToMany(mappedBy: 'id_createur', targetEntity: Entreprise::class, cascade: ['persist', 'remove'])]
    #[Groups(['get:info_personnage_full'])]
    private $entreprises;

    #[ORM\OneToMany(mappedBy: 'id_personnage', targetEntity: CompteBancaire::class, cascade: ['persist', 'remove'])]
    #[Groups(['get:info_personnage_full'])]
    private $compteBancaires;

    #[ORM\OneToMany(mappedBy: 'id_personnage', targetEntity: AddictionsPersonnage::class, cascade: ['persist', 'remove'])]
    #[Groups(['get:info_personnage_full'])]
    private $addictionsPersonnages;

    #[ORM\OneToMany(mappedBy: 'id_personnage', targetEntity: Panier::class)]
    private $paniers;



    public function __construct()
    {
        $this->diplomesPersonnages = new ArrayCollection();
        $this->entreprises = new ArrayCollection();
        $this->compteBancaires = new ArrayCollection();
        $this->addictionsPersonnages = new ArrayCollection();
        $this->compositionPaniers = new ArrayCollection();
        $this->paniers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUtilisateur(): ?Utilisateur
    {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur(?Utilisateur $id_utilisateur): self
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getSituationPersonnage(): ?SituationPersonnage
    {
        return $this->situationPersonnage;
    }

    public function setSituationPersonnage(SituationPersonnage $situationPersonnage): self
    {
        // set the owning side of the relation if necessary
        if ($situationPersonnage->getIdPersonnage() !== $this) {
            $situationPersonnage->setIdPersonnage($this);
        }

        $this->situationPersonnage = $situationPersonnage;

        return $this;
    }

    public function getInteractionsPersonnage(): ?InteractionsPersonnage
    {
        return $this->interactionsPersonnage;
    }

    public function setInteractionsPersonnage(InteractionsPersonnage $interactionsPersonnage): self
    {
        // set the owning side of the relation if necessary
        if ($interactionsPersonnage->getIdPersonnage() !== $this) {
            $interactionsPersonnage->setIdPersonnage($this);
        }

        $this->interactionsPersonnage = $interactionsPersonnage;

        return $this;
    }

    /**
     * @return Collection<int, DiplomesPersonnage>
     */
    public function getDiplomesPersonnages(): Collection
    {
        return $this->diplomesPersonnages;
    }

    public function addDiplomesPersonnage(DiplomesPersonnage $diplomesPersonnage): self
    {
        if (!$this->diplomesPersonnages->contains($diplomesPersonnage)) {
            $this->diplomesPersonnages[] = $diplomesPersonnage;
            $diplomesPersonnage->setIdPersonnage($this);
        }

        return $this;
    }

    public function removeDiplomesPersonnage(DiplomesPersonnage $diplomesPersonnage): self
    {
        if ($this->diplomesPersonnages->removeElement($diplomesPersonnage)) {
            // set the owning side to null (unless already changed)
            if ($diplomesPersonnage->getIdPersonnage() === $this) {
                $diplomesPersonnage->setIdPersonnage(null);
            }
        }

        return $this;
    }

    public function getSantePersonnage(): ?SantePersonnage
    {
        return $this->santePersonnage;
    }

    public function setSantePersonnage(SantePersonnage $santePersonnage): self
    {
        // set the owning side of the relation if necessary
        if ($santePersonnage->getIdPersonnage() !== $this) {
            $santePersonnage->setIdPersonnage($this);
        }

        $this->santePersonnage = $santePersonnage;

        return $this;
    }

    public function getIdVille(): ?Ville
    {
        return $this->id_ville;
    }

    public function setIdVille(?Ville $id_ville): self
    {
        $this->id_ville = $id_ville;

        return $this;
    }

    /**
     * @return Collection<int, Entreprise>
     */
    public function getEntreprises(): Collection
    {
        return $this->entreprises;
    }

    public function addEntreprise(Entreprise $entreprise): self
    {
        if (!$this->entreprises->contains($entreprise)) {
            $this->entreprises[] = $entreprise;
            $entreprise->setIdCreateur($this);
        }

        return $this;
    }

    public function removeEntreprise(Entreprise $entreprise): self
    {
        if ($this->entreprises->removeElement($entreprise)) {
            // set the owning side to null (unless already changed)
            if ($entreprise->getIdCreateur() === $this) {
                $entreprise->setIdCreateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompteBancaire>
     */
    public function getCompteBancaires(): Collection
    {
        return $this->compteBancaires;
    }

    public function addCompteBancaire(CompteBancaire $compteBancaire): self
    {
        if (!$this->compteBancaires->contains($compteBancaire)) {
            $this->compteBancaires[] = $compteBancaire;
            $compteBancaire->setIdPersonnage($this);
        }

        return $this;
    }

    public function removeCompteBancaire(CompteBancaire $compteBancaire): self
    {
        if ($this->compteBancaires->removeElement($compteBancaire)) {
            // set the owning side to null (unless already changed)
            if ($compteBancaire->getIdPersonnage() === $this) {
                $compteBancaire->setIdPersonnage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AddictionsPersonnage>
     */
    public function getAddictionsPersonnages(): Collection
    {
        return $this->addictionsPersonnages;
    }

    public function addAddictionsPersonnage(AddictionsPersonnage $addictionsPersonnage): self
    {
        if (!$this->addictionsPersonnages->contains($addictionsPersonnage)) {
            $this->addictionsPersonnages[] = $addictionsPersonnage;
            $addictionsPersonnage->setIdPersonnage($this);
        }

        return $this;
    }

    public function removeAddictionsPersonnage(AddictionsPersonnage $addictionsPersonnage): self
    {
        if ($this->addictionsPersonnages->removeElement($addictionsPersonnage)) {
            // set the owning side to null (unless already changed)
            if ($addictionsPersonnage->getIdPersonnage() === $this) {
                $addictionsPersonnage->setIdPersonnage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Panier>
     */
    public function getPaniers(): Collection
    {
        return $this->paniers;
    }

    public function addPanier(Panier $panier): self
    {
        if (!$this->paniers->contains($panier)) {
            $this->paniers[] = $panier;
            $panier->setIdPersonnage($this);
        }

        return $this;
    }

    public function removePanier(Panier $panier): self
    {
        if ($this->paniers->removeElement($panier)) {
            // set the owning side to null (unless already changed)
            if ($panier->getIdPersonnage() === $this) {
                $panier->setIdPersonnage(null);
            }
        }

        return $this;
    }

    
}
