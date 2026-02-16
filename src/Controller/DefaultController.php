<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\GiftsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
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
    public function default(UserRepository $userRepository, GiftsService $gifts): Response {
        $users = $userRepository->findAll();
        $gifList = $gifts->getGifts();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'ShinobisController',
            'users' => $users,
            'random_gift' => $gifList
        ]);
    }

    #[Route('/blog/{id}/{name}/{year}', name: 'blog', requirements: ['id' => '\d+', 'name' => 'shinobi|barchid'], defaults: ['year' => '2019'], methods: ['GET'])]
    public function blog(): Response {
        $cookie = new Cookie(
            'user',
            'blablabla',
            time() + 3600,
        );
        $response = new Response('Welcome to my blog');
//        $response->headers->setCookie($cookie);
        $response->headers->clearCookie('user');
        $response->send();
        return $response;
    }
}
