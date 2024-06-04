<?php

namespace App\Entity;

use App\Repository\CaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CaRepository::class)]
class Ca
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["getProfil"])]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(["getProfil"])]
    private ?\DateTimeInterface $date_ca = null;

    #[ORM\Column]
    #[Groups(["getProfil"])]
    private ?int $montant_ca = null;

    #[ORM\ManyToOne(inversedBy: 'id_ca')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $id_user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCa(): ?\DateTimeInterface
    {
        return $this->date_ca;
    }

    public function setDateCa(\DateTimeInterface $date_ca): static
    {
        $this->date_ca = $date_ca;

        return $this;
    }

    public function getMontantCa(): ?int
    {
        return $this->montant_ca;
    }

    public function setMontantCa(int $montant_ca): static
    {
        $this->montant_ca = $montant_ca;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }
}
