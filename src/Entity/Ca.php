<?php

namespace App\Entity;

use App\Repository\CaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CaRepository::class)]
class Ca
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_client = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_ca = null;

    #[ORM\Column]
    private ?int $montant_ca = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdClient(): ?int
    {
        return $this->id_client;
    }

    public function setIdClient(int $id_client): static
    {
        $this->id_client = $id_client;

        return $this;
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
}
