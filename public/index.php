<?php

// Set up Twig and other dependencies
require_once __DIR__ . '/../vendor/autoload.php';
use MvcApp\Routing;
use MvcApp\Controller\WeatherController;
use Twig\Environment;
use MvcApp\Models\ApiService;
use Twig\Loader\FilesystemLoader;
use Carbon\Carbon;

Routing::dispatch();

$loader = new FilesystemLoader('../app/Views');
$twig = new Environment($loader);
$apiService = new ApiService();

$weatherController = new WeatherController($twig, $apiService);
$weather = $weatherController->sh();

$currentTimeInLondon = Carbon::now('Europe/London');
$formattedTimeInLondon = $currentTimeInLondon->format('H:i:s');

$twig->addGlobal('temperatureCelsius', $weather);
$twig->addGlobal('currentTimeInLondon', $formattedTimeInLondon);

echo $twig->render('navbar.twig');
