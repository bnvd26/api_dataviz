<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

class LoginController extends AbstractController
{
    /**
     * @Route("/api/login", name="api_login", methods="POST")
     * @return Response
     * @SWG\Response(
     *     response=200,
     *     description="Login to the API and get the JWT token.",
     *     @Model(type=\App\Entity\User::class),
     * )
     * @SWG\Tag(name="Login")
     */
    public function api_login()
    {
        $user = $this->getUser();

        return new Response([
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
        ]);
    }
}