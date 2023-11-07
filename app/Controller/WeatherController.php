<?php

namespace MvcApp\Controller;

class WeatherController extends BaseController
{
    /**
     * @throws \Twig\Error\SyntaxError
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\LoaderError
     */
    public function sh(): void {
            $city = $_POST['city'] ?? null;


        if (is_string($city) && !empty($city)) {
            $temperatureCelsius = $this->apiService->fetchWeather($city);
        } else {
            $temperatureCelsius = null;
        }

        $this->twig->addGlobal('temperatureCelsius', $temperatureCelsius);
        echo $this->twig->render('navbar.twig');
    }



}