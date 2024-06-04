<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("getProfil")]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    #[Groups("getProfil")]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    #[Groups("getProfil")]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Groups("getProfil")]
    private ?string $password = null;

    #[ORM\OneToOne(mappedBy: 'id_user', cascade: ['persist', 'remove'])]
    private ?Profil $id_profil = null;

    /**
     * @var Collection<int, Ca>
     */
    #[ORM\OneToMany(targetEntity: Ca::class, mappedBy: 'id_user', orphanRemoval: true)]
    #[Groups(["getProfil"])]
    private Collection $id_ca;

    public function __construct()
    {
        $this->id_ca = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->getUserIdentifier();
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getIdProfil(): ?Profil
    {
        return $this->id_profil;
    }

    public function setIdProfil(Profil $id_profil): static
    {
        // set the owning side of the relation if necessary
        if ($id_profil->getIdUser() !== $this) {
            $id_profil->setIdUser($this);
        }

        $this->id_profil = $id_profil;

        return $this;
    }

    /**
     * @return Collection<int, Ca>
     */
    public function getIdCa(): Collection
    {
        return $this->id_ca;
    }

    public function addIdCa(Ca $idCa): static
    {
        if (!$this->id_ca->contains($idCa)) {
            $this->id_ca->add($idCa);
            $idCa->setIdUser($this);
        }

        return $this;
    }

    public function removeIdCa(Ca $idCa): static
    {
        if ($this->id_ca->removeElement($idCa)) {
            // set the owning side to null (unless already changed)
            if ($idCa->getIdUser() === $this) {
                $idCa->setIdUser(null);
            }
        }

        return $this;
    }
}
