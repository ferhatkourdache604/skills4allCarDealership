<?php

namespace Controller;

use DateTime;
use App\Entity\Car;
use App\Form\CarCreateType;
use App\Form\CarType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdminCarController extends AbstractController
{

    private $repo;

    private $em;

    public function __construct(CarRepository $repo, EntityManagerInterface $em)
    {
        $this->repo=$repo;
        $this->em = $em;
    }

    public function index(PaginatorInterface $paginator, Request $request) : Response
    {
        // chercher toutes les voitures dans la base de données (vendues ou pas) dans la var $cars
        $cars = $paginator->paginate(
            $this->repo->findAll(),
            $request->query->getInt('page',1),
            20
        );
        
        // retourner la liste des voitures au front (vue)
        return $this->render('admin/car/index.html.twig', compact('cars'));
    }

    public function delete($id, Request $request)
    {

        $car = $this->repo->find($id);

        if($this->isCsrfTokenValid('delete' . $id, $request->request->get('_token'))) {
            $this->em->remove($car);
            $this->em->flush();
        }

        return $this->redirectToRoute('admin');
    }

    public function create(Request $request) : Response
    {
        // créer nouvelle voiture Car dans la var $car
        $car = new Car();

        // créer le formulaire CarCreateType avec la voiture $car vide 
        $form = $this->createForm(CarCreateType::class, $car);
        $form->handleRequest($request);

        // quand on clque sur Create
        if($form->isSubmitted() && $form->isValid()) {
            // On met à jour la date de màj
            $car->setUpdatedAt(new DateTime());
            // On stocke dans la base de données
            $this->em->persist($car);
            // On actualise la BDD
            $this->em->flush();

            // On revient sur la page principale de l'admin
            return $this->redirectToRoute('admin');
        }

        // envoyer la nouvelle voiture vide $car et le formlaire $form au front 
        return $this->render('admin/car/create.html.twig', [
            'car' => $car,
            'form' => $form->createView()
        ]);
    }

    public function edit($id, Request $request) : Response
    {
        // Chercher la voiture avec l'id 
        $car = $this->repo->find($id); 

        // créer le formulaire et le stocker dans $form
        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('admin');
        }


        // envoyer le formulaire $form et la voiture avec ses détails $car
        return $this->render('admin/car/edit.html.twig', [
        'car' => $car,
        'form' => $form->createView()
        ]);
    }
}