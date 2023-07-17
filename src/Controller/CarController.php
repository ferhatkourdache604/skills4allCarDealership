<?php

namespace Controller;

use App\Entity\Car;
use Entity\SearchCriteria;
use App\Form\SearchCriteriaType;
use App\Repository\CarRepository; 
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{
    private $twig;

    private $repo;

    private $em;

    public function __construct($twig, CarRepository $repo, EntityManagerInterface $em) {
        $this->twig = $twig;
        $this->repo = $repo;
        $this->em = $em;
    }  

    public function index(PaginatorInterface $paginator, Request $request) : Response 
    {

        // chercher les voitures de la base de données
        $search = new SearchCriteria();

        // création du formulaire de recherche et le stocker dans la variable $form
        $form = $this->createForm(SearchCriteriaType::class, $search);
        $form->handleRequest($request);

        // pagination des voitures
        $cars = $paginator->paginate(
            $this->repo->findAllNotSold($search),
            $request->query->getInt('page', 1),
            20
        );

        // retourne la liste des voitures paginée
        return $this->render('car/index.html.twig', [
            'current_menu' => 'cars',
            'availableCars' => $cars,
            'form' => $form->createView()
        ]
        );
    }

    public function show($slug, $id) : Response
    {
        $car = $this->repo->find($id);

        $carSlug = $car->getSlug();
        
        if($carSlug !== $slug) {
            return $this->redirectToRoute('car', [
                'id' => $car->getId(),
                'slug' => $carSlug
            ], 301); 
        }

        return $this->render('car/show.html.twig' , [
            'car' => $car,
            'current_menu' => 'cars'
        ]);
    }

}