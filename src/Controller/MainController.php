<?php

namespace App\Controller;

use Symfony\Component\Form\FormFactoryInterface;
use App\Entity\Ingredient;
use App\Form\AddIngredientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/addIngredient', name:'app_addIngredientType')]
    public function addIngredient(Request $request, EntityManagerInterface $entityManager): Response
    {
 
        $form = $this->formFactory->create(AddIngredientType::class);

    
        if ($form->isSubmitted() && $form->isValid()) {
            // Traitement des données soumises...
        }
    
        return $this->render('form/formAddIngredient.html.twig', [
            'form' => $form
        ]);
    }
}
