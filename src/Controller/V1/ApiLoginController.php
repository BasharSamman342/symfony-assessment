<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class ApiLoginController extends BaseController
{
     #[Route('/login', name: 'api_login', methods: ['POST'])]
    public function index(#[CurrentUser]  $user): JsonResponse
    {
        if (null === $user) {
             return $this->json([
                 'message' => 'missing credentials',
             ], Response::HTTP_UNAUTHORIZED);
         }

         $token = "token"; // somehow create an API token for $user
        return $this->success([
            'token' => $token,
            'user'  => $user->getUserIdentifier(),
        ],"login successfully");
    }
}
