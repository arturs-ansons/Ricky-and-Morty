<?php

namespace MvcApp\Controller;
use Twig\Environment;
use MvcApp\Models\ApiService;

class BaseController
{
    protected Environment $twig;
    protected ApiService $apiService;

    public function __construct(Environment $twig, ApiService $apiService)
    {
        $this->twig = $twig;
        $this->apiService = $apiService;
    }
}
