<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController
{
    /**
     * @Route("api/user/{email}",name="api_get_user")
     */
    public function getUserAction($email, UserRepository $repo){
        $user = $repo->findOneBy(["email" => $email]);
        $data = array();

        $data[] = [
            "id" => $user->getId(),
            "username" => $user->getName(),
            "email" => $user->getEmail(),
            "roles" => ["ROLE_USER"]
        ];

        return new JsonResponse($data);
    }

    /**
     * @Route("api/user-products/{id}", name="get_user_products")
     */
    public function getUserProducts($id, UserRepository $repo){
        $user = $repo->findOneBy(["id" => $id]);
        $products = $user->getProducts();
        $data = array();

        foreach ($products as $product) {
            $data[] = [
                "id" => $product->getId(),
                "title" => $product->getTitle(),
                "description" => $product->getDescription(),
                "price" => $product->getPrice(),
                "quantity" => $product->getQuantity(),
            ];
        }

        return new JsonResponse($data);
    }
}
