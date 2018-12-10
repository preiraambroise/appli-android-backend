<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\User;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Services\SecurityUserContext;

/**
 * @ApiResource(
 *     attributes={"access_control"="is_granted('ROLE_USER')"},
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 *     itemOperations={
 *          "delete"={"access_control"="is_granted('ROLE_ADMIN')"},
 *          "put"={"denormalization_context"={"groups"={"write"}}, "access_control"="is_granted('ROLE_ADMIN')"},
 *          "get"={"normalization_context"={"groups"={"read"}}}
 *     },
 *     collectionOperations={
 *          "post"={"denormalization_context"={"groups"={"write"}}},
 *           "get"={"normalization_context"={"groups"={"read"}}}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\InterventionRepository")
 */
class Intervention
{
    /**
     * @Groups({"write", "read"})
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"write", "read"})
     * @ORM\Column(type="string", length=255)
     */
    private $jeton;

    /**
     * @Groups({"read"})
     * @ORM\Column(type="datetime")
     */
    private $dateenvoi;

    /**
     * @ApiFilter(SearchFilter::class, properties={"qcm.planning": "exact", "qcm.resultat": "exact"})
     * @Groups({"write","read"})
     * @ORM\OneToOne(targetEntity="App\Entity\Qcm",cascade={"persist", "remove"})
     */
    private $qcm;

    /**
     * @ApiFilter(SearchFilter::class, properties={"user": "exact"})
     * @Groups({"read"})
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;


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
