<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 *     itemOperations={
 *          "get"={"access_control"="is_granted('ROLE_ADMIN')"},
 *          "put"={"access_control"="is_granted('ROLE_ADMIN')"},
 *          "delete"={"access_control"="is_granted('ROLE_ADMIN')"}
 *      },
 *      collectionOperations={
            "post"={"access_control"="is_granted('ROLE_ADMIN')"},
 *          "get"={"access_control"="is_granted('ROLE_USER')"},
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ResultatRepository")
 */
class Resultat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
}
