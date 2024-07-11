<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\Workout;
use App\Repository\WorkoutRepository;

class WorkoutService
{
    private WorkoutRepository $workoutRepository;

    public function __construct(WorkoutRepository $workoutRepository)
    {
        $this->workoutRepository = $workoutRepository;
    }
    public function saveWorkout(Workout $workout): void
    {
        $this->workoutRepository->saveWorkout($workout);
    }

    public function getAllWorkouts(): array
    {
        return $this->workoutRepository->getAllWorkouts();
    }

    public function getWorkoutsOfUser(User $user): array
    {
        return $this->workoutRepository->findByUserField($user);
    }
    public function getWorkoutById(int $id): ?Workout
    {
        return $this->workoutRepository->findByIdField($id);
    }

    public function deleteWorkout(Workout $workout): void
    {
        $this->workoutRepository->deleteWorkout($workout);
    }

}

