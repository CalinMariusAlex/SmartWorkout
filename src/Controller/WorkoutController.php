<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Workout;
use App\Form\WorkoutType;
use App\Service\WorkoutService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WorkoutController extends AbstractController
{

    #[Route('/workout', name: 'app_workout')]
    public function index(): Response
    {
        return $this->render('workout/index.html.twig', [
            'controller_name' => 'WorkoutController',
        ]);
    }

    #[Route('/workout/store', name: 'app_workout_store')]
    public function store(Request $request, WorkoutService $workoutService): Response
    {
        $workout = new Workout();
        $form = $this->createForm(WorkoutType::class, $workout);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var Workout $workout */
            $workout = $form->getData();

            /** @var User $user */
            $user = $this->getUser();
            if($user)
            {
                $workout->setPerson($user);
            }
            $workoutService->saveWorkout($workout);
            return $this->redirectToRoute('app_workout');
        }

        return $this->render('workout/workoutStore.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/workouts', name: 'app_workouts')]
    public function showAllWorkouts(Request $request, WorkoutService $workoutService) : Response
    {
        $workouts =  $workoutService->getAllWorkouts();

        return $this->render('workout/workouts.html.twig', [
            'workouts' => $workouts,
        ]);
    }

    #[Route('/workoutsUser', name: 'app_workouts_user')]
    public function showWorkoutsOfUser(Request $request, WorkoutService $workoutService)
    {
        /** @var User $user */
        $user = $this->getUser();

        $workouts = $workoutService->getWorkoutsOfUser($user);

        return $this->render('workout/workouts.html.twig', [
            'workouts' => $workouts,
        ]);

    }

}
