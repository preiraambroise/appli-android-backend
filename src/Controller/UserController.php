<?php
namespace App\Controller;

use App\Entity\User;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserController extends AbstractController
{
    /**
     *
     * @Route(
     *     name="api_users_post",
     *     path="/api/users",
     *     methods={"POST"},
     *     defaults={
     *         "_api_resource_class"=User::class,
     *         "_api_collection_operation_name"="post"
     *     }
     * )
     */
    public function postAction(User $data, UserPasswordEncoderInterface $encoder): User
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Droit insufisant pour accéder à la ressource');
        return $this->encodePassword($data, $encoder);
    }

    /**
     *
     * @Route(
     *
     *     name="api_users_put",
     *     path="/api/users/{id}",
     *     requirements={"id"="\d+"},
     *     methods={"PUT"},
     *     defaults={
     *         "_api_resource_class"=User::class,
     *         "_api_item_operation_name"="put"
     *     }
     * )
     */
    public function putAction(User $data, UserPasswordEncoderInterface $encoder): User
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Droit insufisant pour accéder à la ressource');
        return $this->encodePassword($data, $encoder);
    }

    protected function encodePassword(User $data, UserPasswordEncoderInterface $encoder): User
    {
        $encoded = $encoder->encodePassword($data, $data->getPassword());
        $data->setPassword($encoded);

        return $data;
    }

    /**
     * @Route(
     *     name="api_users_getcurrent",
     *     path="api/users/current",
     *     methods={"GET"}
     * )
     */
    public function getcurrentUser()
    {
        $id = $this->getUser()->getId();
        return $this->redirectToRoute('api_users_get_item', array(
            "id" => $id
        ));
    }
}