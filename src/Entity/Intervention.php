<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(itemOperations={"delete","put"={"denormalization_context"={"groups"={"write"}}}, "get"},collectionOperations={"post"={"denormalization_context"={"groups"={"write"}}}, "get"}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\InterventionRepository")
 */
class Intervention
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"write"})
     * @ORM\Column(type="string", length=255)
     */
    private $jeton;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateenvoi;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="interventions")
     * @ORM\JoinColumn(nullable=false)
     * @ORM\Column(nullable=true)
     */
    private $user;

    /**
     * @Groups({"write"})
     * @ORM\OneToOne(targetEntity="App\Entity\Qcm",cascade={"persist", "remove"})
     */
    private $qcm;

    public function __construct()
    {
        $this->dateenvoi = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJeton(): ?string
    {
        return $this->jeton;
    }

    public function setJeton(string $jeton): self
    {
        $this->jeton = $jeton;

        return $this;
    }

    public function getDateenvoi(): ?\DateTimeInterface
    {
        return $this->dateenvoi;
    }

    public function setDateenvoi(\DateTimeInterface $dateenvoi): self
    {
        $this->dateenvoi = $dateenvoi;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getQcm(): ?Qcm
    {
        return $this->qcm;
    }

    public function setQcm(Qcm $qcm): self
    {
        $this->qcm = $qcm;
        return $this;
    }
}
