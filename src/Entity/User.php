<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"user:read"}, "swagger_definition_name"="Read"},
 *     denormalizationContext={"groups"={"user:write"}, "swagger_definition_name"="Write"}
 * )
 * @UniqueEntity(fields={"username"})
 *
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface
{
    /**
     * Internal generated user ID
     * @Groups({"user:read"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Discord Username
     * @Groups({"user:read", "user:write"})
     * @ORM\Column(type="string", length=180, nullable=true, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @Groups({"user:read", "user:write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Nickname;

    /**
     * @Groups({"user:read", "user:write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Emoji;

    /**
     * @Groups({"user:read", "user:write"})
     * @ORM\Column(type="integer")
     */
    private $DiscordId;

    /**
     * @Groups({"user:read"})
     * @ORM\Column(type="boolean")
     */
    private $IsSupport;

    /**
     * @Groups({"user:read", "user:write"})
     * @ORM\Column(type="boolean")
     */
    private $UseNickname;

    /**
     * @Groups({"user:read"})
     * @ORM\OneToMany(targetEntity=Motto::class, mappedBy="Author", orphanRemoval=true)
     */
    private $mottos;

    /**
     * @Groups({"user:read"})
     * @ORM\OneToMany(targetEntity=Motto::class, mappedBy="NominatedBy")
     */
    private $nominatedMottos;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->IsSupport = false;
        $this->UseNickname = false;
        $this->mottos = new ArrayCollection();
        $this->nominatedMottos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * This method can be removed in Symfony 6.0 - is not needed for apps that do not check user passwords.
     *
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return null;
    }

    /**
     * This method can be removed in Symfony 6.0 - is not needed for apps that do not check user passwords.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNickname(): ?string
    {
        return $this->Nickname;
    }

    public function setNickname(?string $Nickname): self
    {
        $this->Nickname = $Nickname;

        return $this;
    }

    public function getEmoji(): ?string
    {
        return $this->Emoji;
    }

    public function setEmoji(?string $Emoji): self
    {
        $this->Emoji = $Emoji;

        return $this;
    }

    public function getDiscordId(): ?int
    {
        return $this->DiscordId;
    }

    public function setDiscordId(int $DiscordId): self
    {
        $this->DiscordId = $DiscordId;

        return $this;
    }

    public function getIsSupport(): ?bool
    {
        return $this->IsSupport;
    }

    public function setIsSupport(bool $IsSupport): self
    {
        $this->IsSupport = $IsSupport;

        return $this;
    }

    public function getUseNickname(): ?bool
    {
        return $this->UseNickname;
    }

    public function setUseNickname(bool $UseNickname): self
    {
        $this->UseNickname = $UseNickname;

        return $this;
    }

    /**
     * @return Collection|Motto[]
     */
    public function getMottos(): Collection
    {
        return $this->mottos;
    }

    public function addMotto(Motto $motto): self
    {
        if (!$this->mottos->contains($motto)) {
            $this->mottos[] = $motto;
            $motto->setAuthor($this);
        }

        return $this;
    }

    public function removeMotto(Motto $motto): self
    {
        if ($this->mottos->removeElement($motto)) {
            // set the owning side to null (unless already changed)
            if ($motto->getAuthor() === $this) {
                $motto->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Motto[]
     */
    public function getNominatedMottos(): Collection
    {
        return $this->nominatedMottos;
    }

    public function addNominatedMotto(Motto $nominatedMotto): self
    {
        if (!$this->nominatedMottos->contains($nominatedMotto)) {
            $this->nominatedMottos[] = $nominatedMotto;
            $nominatedMotto->setNominatedBy($this);
        }

        return $this;
    }

    public function removeNominatedMotto(Motto $nominatedMotto): self
    {
        if ($this->nominatedMottos->removeElement($nominatedMotto)) {
            // set the owning side to null (unless already changed)
            if ($nominatedMotto->getNominatedBy() === $this) {
                $nominatedMotto->setNominatedBy(null);
            }
        }

        return $this;
    }
}
