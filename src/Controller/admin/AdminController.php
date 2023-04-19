<?php
// src/Controller/AdminController.php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function dashboard(): Response
    {
        $host = $_SERVER['HTTP_HOST'];
        // return $this->render('admin/dashboard.html.twig');
        return $this->render('admin/dashboard.html.twig', [
            'host' => $host
        ]);
    }
}
