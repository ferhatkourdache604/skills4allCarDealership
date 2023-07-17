<?php

namespace Controller;

use DateTime;
use GuzzleHttp\Client;
use App\Repository\CarRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController {

    private $twig;

    private $repo;

    public function __construct($twig, CarRepository $repo) {
        $this->twig = $twig;
        $this->repo = $repo;
    }

    public function index() : Response
    {
        // Chercher les dernières voitures ajoutées
         $cars = $this->repo->findLatest();


         // Récupérer la température
        $client = new Client(['verify' => false]);

        $response = $client->get('https://api.open-meteo.com/v1/forecast', [
            'query' => [
                'latitude' => '48.7269',
                'longitude' => '2.283',
                'hourly' => 'temperature_2m',
                'forecast_days' => '1',
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        //2023-07-16 21:43:41.729962 UTC (+00:00)

        $currentDateTime = date('H');

        if(str_split($currentDateTime)[0] === '0') 
        {
             $currentIndex = str_split($currentDateTime)[1];
        } else 
        {
            $currentIndex = $currentDateTime;
        }

        
        $temperature = $data['hourly']['temperature_2m'][$currentIndex];

        return $this->render('pages/home.html.twig', [
            'cars' => $cars,
            'temperature' => $temperature
        ]);
    }

}
