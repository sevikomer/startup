<?php

namespace App\Entity;

use App\Repository\ProfilRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: ProfilRepository::class)]
class Profil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("getProfil")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups("getProfil")]
    private ?string $nom_salon = null;

    #[ORM\Column(length: 255)]
    #[Groups("getProfil")]
    private ?string $adresse_salon = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups("getProfil")]
    private ?\DateTimeInterface $date_ouverture = null;

    #[ORM\Column]
    #[Groups("getProfil")]
    private ?int $nombre_employes = null;

    #[ORM\Column(length: 255)]
    #[Groups("getProfil")]
    private ?string $nom_gerant = null;

    #[ORM\Column(length: 255)]
    #[Groups("getProfil")]
    private ?string $prenom_gerant = null;

    #[ORM\OneToOne(inversedBy: 'id_profil', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $id_user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getNomSalon(): ?string
    {
        return $this->nom_salon;
    }

    public function setNomSalon(string $nom_salon): static
    {
        $this->nom_salon = $nom_salon;

        return $this;
    }

    public function getAdresseSalon(): ?string
    {
        return $this->adresse_salon;
    }

    public function setAdresseSalon(string $adresse_salon): static
    {
        $this->adresse_salon = $adresse_salon;

        return $this;
    }

    public function getDateOuverture(): ?\DateTimeInterface
    {
        return $this->date_ouverture;
    }

    public function setDateOuverture(\DateTimeInterface $date_ouverture): static
    {
        $this->date_ouverture = $date_ouverture;

        return $this;
    }

    public function getNombreEmployes(): ?int
    {
        return $this->nombre_employes;
    }

    public function setNombreEmployes(int $nombre_employes): static
    {
        $this->nombre_employes = $nombre_employes;

        return $this;
    }

    public function getNomGerant(): ?string
    {
        return $this->nom_gerant;
    }

    public function setNomGerant(string $nom_gerant): static
    {
        $this->nom_gerant = $nom_gerant;

        return $this;
    }

    public function getPrenomGerant(): ?string
    {
        return $this->prenom_gerant;
    }

    public function setPrenomGerant(string $prenom_gerant): static
    {
        $this->prenom_gerant = $prenom_gerant;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(User $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }
}
