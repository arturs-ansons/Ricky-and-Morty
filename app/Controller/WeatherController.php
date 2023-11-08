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
    public function sh(): ?float
    {
        $city = 'London';

        if (!empty($city)) {
            $temperatureCelsius = $this->apiService->fetchWeather($city);
        } else {
            $temperatureCelsius = null;
        }

        return $temperatureCelsius;
        //$this->twig->addGlobal('temperatureCelsius', $temperatureCelsius);
        //echo $this->twig->render('navbar.twig');
    }



}