<?php

namespace App\Controller;

use App\Entity\Exercise;
use App\Form\ExerciseType;
use App\Repository\ExerciseRepository;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ExerciseController extends AbstractController
{
    #[Route('/exercise', name: 'app_exercise')]
    public function index(): Response
    {
        return $this->render('exercise/index.html.twig', [
            'controller_name' => 'ExerciseController',
        ]);
    }

    #[Route('/exercise-show', name: 'app_exercise_show')]
    public function showExercises(ExerciseRepository $exerciseRepository) : Response
    {
        return $this->render('exercise/show.html.twig', [
            'exercises' => $exerciseRepository->getExercises(),
        ]);
    }

    #[Route('/exercise-add', name: 'app_exercise_add')]
    public function addExercise(Request $request, ExerciseRepository $exerciseRepository) : Response
    {
        $exercise = new Exercise();
        $form = $this->createForm(ExerciseType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $exercise = $form->getData();
            $exerciseRepository->saveExercise($exercise);
            return $this->redirectToRoute('app_exercise');
        }
        return $this->render('exercise/add.html.twig', [
            'form' => $form,
        ]);
    }

}
