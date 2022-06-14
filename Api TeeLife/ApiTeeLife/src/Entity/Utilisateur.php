<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['get:info_personnage_full', 'get:utilisateur_full'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    #[Groups(['get:info_personnage_full', 'get:utilisateur_full'])]
    private $pseudo;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['get:utilisateur_full'])]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['get:utilisateur_full'])]
    private $password;

    #[ORM\OneToMany(mappedBy: 'id_utilisateur', targetEntity: Personnage::class, cascade: ['persist', 'remove'])]
    #[Groups(['get:utilisateur_full'])]
    private $personnages;

    public function __construct()
    {
        $this->personnages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection<int, Personnage>
     */
    public function getPersonnages(): Collection
    {
        return $this->personnages;
    }

    public function addPersonnage(Personnage $personnage): self
    {
        if (!$this->personnages->contains($personnage)) {
            $this->personnages[] = $personnage;
            $personnage->setIdUtilisateur($this);
        }

        return $this;
    }

    public function removePersonnage(Personnage $personnage): self
    {
        if ($this->personnages->removeElement($personnage)) {
            // set the owning side to null (unless already changed)
            if ($personnage->getIdUtilisateur() === $this) {
                $personnage->setIdUtilisateur(null);
            }
        }

        return $this;
    }
}
