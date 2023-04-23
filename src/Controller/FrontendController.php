<?php
// src/Controller/FrontendController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontendController extends AbstractController
{
public function index(): Response
{
    return $this->render('index.html.twig', [
        'year' => date('Y')
    ]);
}
}
