<?php

namespace App\Controller;

use App\Entity\MuscleGroup;
use App\Form\MuscleGroupType;
use App\Repository\MuscleGroupRepository;
use App\Service\MuscleGroupService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MuscleGroupController extends AbstractController
{
    #[Route('/muscle-group', name: 'app_muscle_group')]
    public function index(): Response
    {
        return $this->render('muscle_group/index.html.twig', [
            'controller_name' => 'MuscleGroupController',
        ]);
    }

    #[Route('/muscle-group-error', name: 'app_muscle_group_error')]
    public function error(): Response
    {
        return $this->render('muscle_group/error.html.twig', [
            'controller_name' => 'MuscleGroupController',
        ]);
    }

    #[Route('/muscle-group-add', name: 'app_muscle_group_add')]
    public function add(Request $request, MuscleGroupService $groupService) : Response
    {
        $muscleGroup = new MuscleGroup();
        $form = $this->createForm(MuscleGroupType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $muscleGroup = $form->getData();

            if($groupService->saveMuscleGroup($muscleGroup)['error']) {
                return $this->redirectToRoute('app_muscle_group_error');
            }


            return $this->redirectToRoute('app_muscle_group');
        }

        return $this->render('muscle_group/add.html.twig', [
            'form' => $form,
        ]);
    }

}
