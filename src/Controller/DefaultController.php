<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UserRepository;

final class DefaultController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        return new Response('Hello World');
    }

    #[Route('/home/{id}', name: 'redirect')]
    public function index2($id): Response
    {
        return $this->redirectToRoute("user", ["id" => $id]);
    }

    #[Route('/user', name: 'user')]
    public function index3(#[MapQueryParameter] int $id): Response
    {
        return $this->json([
            "id" => $id,
        ]);
    }

    #[Route('/default', name: 'default')]
    public function default(UserRepository $userRepository): Response {
        $users = $userRepository->findAll();
        return $this->render('default/index.html.twig', [
            'controller_name' => 'ShinobisController',
            'users' => $users,
        ]);
    }
}
