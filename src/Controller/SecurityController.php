<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('admin');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $host = $_SERVER['HTTP_HOST'];

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'host' => $host,
            'error' => $error
        ]);
    }


    #[Route(path: '/', name: 'app_home')]
    public function home(): Response
    {
        return $this->render('index.html.twig');
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
