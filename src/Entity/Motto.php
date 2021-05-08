<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\MottoRepository;
use DateTime;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource(
 *     shortName="mottos",
 *     normalizationContext={"groups"={"motto:read"}, "swagger_definition_name"="Read"},
 *     denormalizationContext={"groups"={"motto:write"}, "swagger_definition_name"="Write"}
 * )
 * @UniqueEntity(fields={"Motto"})
 *
 * @ORM\Entity(repositoryClass=MottoRepository::class)
 */
class Motto
{
    /**
     * @Groups({"motto:read"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"motto:read", "motto:write"})
     * The motto itself.
     * @ORM\Column(type="text", nullable=true)
     */
    private $Motto;

    /**
     * @Groups({"motto:read", "motto:write"})
     * The ID of the Discord message in which the motto originated.
     * @ORM\Column(type="integer")
     */
    private $MessageId;

    /**
     * @Groups({"motto:read", "motto:write"})
     * The Discord ID of the author of the message.
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="mottos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Author;

    /**
     * @Groups({"motto:read", "motto:write"})
     * The date & time of the Discord message the motto comes from.
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @Groups({"motto:read", "motto:write"})
     * The Discord ID of the user who nominated the message.
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="nominatedMottos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $NominatedBy;

    /**
     * @Groups({"motto:read", "motto:write"})
     * If the author has approved the motto.
     * @ORM\Column(type="boolean")
     */
    private $ApprovedByAuthor;

    /**
     * Motto constructor.
     */
    public function __construct()
    {
        $this->dateCreated = new DateTime();
        $this->ApprovedByAuthor = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotto(): ?string
    {
        return $this->Motto;
    }

    public function setMotto(?string $Motto): self
    {
        $this->Motto = $Motto;

        return $this;
    }

    public function getMessageId(): ?int
    {
        return $this->MessageId;
    }

    public function setMessageId(int $MessageId): self
    {
        $this->MessageId = $MessageId;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->Author;
    }

    public function setAuthor(?User $Author): self
    {
        $this->Author = $Author;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getNominatedBy(): ?User
    {
        return $this->NominatedBy;
    }

    public function setNominatedBy(?User $NominatedBy): self
    {
        $this->NominatedBy = $NominatedBy;

        return $this;
    }

    public function getApprovedByAuthor(): ?bool
    {
        return $this->ApprovedByAuthor;
    }

    public function setApprovedByAuthor(bool $ApprovedByAuthor): self
    {
        $this->ApprovedByAuthor = $ApprovedByAuthor;

        return $this;
    }
}
