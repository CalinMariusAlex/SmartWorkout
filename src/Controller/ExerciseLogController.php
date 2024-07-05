<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ExerciseLogController extends AbstractController
{
    #[Route('/exercise/log', name: 'app_exercise_log')]
    public function index(): Response
    {
        return $this->render('exercise_log/index.html.twig', [
            'controller_name' => 'ExerciseLogController',
        ]);
    }
}
