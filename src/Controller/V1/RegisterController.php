<?php
declare(strict_types=1);

namespace App\Controller\V1;

use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;
use OpenApi\Attributes as OA;

class RegisterController extends BaseController
{
    
    #[Route("/register",methods:['POST'])]
    #[
        OA\RequestBody(
            required:true,
            content: new OA\JsonContent(
                type: Object::class,
                example: [
                    "username"=>"admin@admin.com",
                    "password"=>"12345678"
                ]
            )
        )
    ]
    public function register(ManagerRegistry $doctrine,Request $request,UserPasswordHasherInterface $passwordHasher){
        $em = $doctrine->getManager();
        $data = json_decode($request->getContent());

        $user = new User();
        $hashedPwd = $passwordHasher->hashPassword($user,$data->password);
        $user->setPassword($hashedPwd);
        $user->setEmail($data->username);
        $em->persist($user);
        $em->flush();
        return $this->success($user,"registered successfully");
    }

    #[Route("/login_check",name:"login_check",methods:['POST'])]
    #[
        OA\RequestBody(
            required:true,
            content: new OA\JsonContent(
                type: Object::class,
                example: [
                    "username"=>"admin@admin.com",
                    "password"=>"12345678"
                ]
            )
        )
    ]
    public function checkAction(){return $this->json("here");}
    
}
