<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(itemOperations={"get","put"},collectionOperations={"post","get"})
 * @ORM\Entity(repositoryClass="App\Repository\QcmRepository")
 */
class Qcm
{
    /**
     * @Groups({"write"})
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"write"})
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @Groups({"write"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Planning")
     * @ORM\JoinColumn(nullable=false)
     */
    private $planning;

    /**
     * @Groups({"write"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Resultat")
     * @ORM\JoinColumn(nullable=false)
     */
    private $resultat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getPlanning(): ?Planning
    {
        return $this->planning;
    }

    public function setPlanning(?Planning $planning): self
    {
        $this->planning = $planning;

        return $this;
    }

    public function getResultat(): ?Resultat
    {
        return $this->resultat;
    }

    public function setResultat(?Resultat $resultat): self
    {
        $this->resultat = $resultat;

        return $this;
    }
}
