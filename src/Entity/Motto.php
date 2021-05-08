<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MottoRepository;
use DateTime;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     shortName="mottos"
 * )
 *
 * @ORM\Entity(repositoryClass=MottoRepository::class)
 */
class Motto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Motto;

    /**
     * @ORM\Column(type="integer")
     */
    private $MessageId;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="mottos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Author;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="nominatedMottos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $NominatedBy;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ApprovedByAuthor;

    /**
     * Motto constructor.
     * @param $dateCreated
     * @param $ApprovedByAuthor
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
