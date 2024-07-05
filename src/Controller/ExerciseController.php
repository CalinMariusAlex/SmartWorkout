<?php

namespace App\Controller;

use App\Entity\Exercise;
use App\Form\ExerciseType;
use App\Service\ExerciseService;
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
    public function showExercises(ExerciseService $exerciseService) : Response
    {
        return $this->render('exercise/show.html.twig', [
            'exercises' => $exerciseService->getExercises(),
        ]);
    }

    #[Route('/exercise/{id}', name: 'edit_exercise', methods: ['GET', 'POST'])]
    public function update(Request $request, ExerciseService $exerciseService, $id)
    {
        $exercise = $exerciseService->getExerciseById($id);

        $form = $this->createForm(ExerciseType::class,$exercise);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $exercise = $form->getData();

            $exercise->setName(mb_ucfirst($exercise->getName()));

            if($exerciseService->checkExerciseExists($exercise)['save'])
            {
                return $this->redirectToRoute('app_exercise_show');
            }
            return $this->redirectToRoute('app_exercise');
        }
        return $this->render('exercise/add.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/exercise/{id}', name: 'delete_exercise', methods: ['DELETE', 'GET'])]
    public function destroy(ExerciseService $exerciseService, $id): Response
    {
        $exercise = $exerciseService->getExerciseById($id);
        $exerciseService->deleteExercise($exercise);
        return $this->redirectToRoute('app_exercise_show');
//        return $this->render('exercise/show.html.twig', [
//            'exercises' => $exerciseService->getExercises(),
//        ]);
    }

    #[Route('/exercise-add', name: 'app_exercise_add')]
    public function addExercise(Request $request, ExerciseService $exerciseService) : Response
    {
        $exercise = new Exercise();
        $form = $this->createForm(ExerciseType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $exercise = $form->getData();
            if($exerciseService->checkExerciseExistsOnlyByName($exercise)['save'])
            {
                return $this->redirectToRoute('app_exercise_show');
            }
            return $this->redirectToRoute('app_exercise');
        }
        return $this->render('exercise/add.html.twig', [
            'form' => $form,
        ]);
    }

}
