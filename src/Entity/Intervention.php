<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
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
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Qcm",cascade={"persist", "remove"})
     */
    private $qcm;

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
    }
}
