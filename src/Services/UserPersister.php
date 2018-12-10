<?php
/**
 * Created by PhpStorm.
 * User: latitude
 * Date: 10/12/18
 * Time: 00:17
 */

namespace App\Services;


use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Intervention;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

final class UserPersister implements DataPersisterInterface
{

    private $em;
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage, EntityManagerInterface $entityManager)
    {
        $this->tokenStorage = $tokenStorage;
        $this->em = $entityManager;
    }

    public function supports($data): bool
    {
        return $data instanceof Intervention;
    }

    public function remove($data)
    {
        $this->em->remove($data);
        $this->em->flush();
    }

    public function persist($data)
    {
        if (!$data->getId() && $this->tokenStorage->getToken()->getUser() instanceof User)
        {
            $data->setUser($this->tokenStorage->getToken()->getUser());
            $this->em->persist($data);
        }
        $this->em->flush();
    }
}