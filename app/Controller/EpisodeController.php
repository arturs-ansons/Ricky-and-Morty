<?php

namespace MvcApp\Controller;


class EpisodeController extends BaseController
{
    /**
     * @throws \Twig\Error\SyntaxError
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\LoaderError
     */
    public function index(): void
    {
        $episodes = $this->apiService->fetchAllEpisodes();
            echo $this->twig->render('index.twig', ['episodes' => $episodes]);

    }
    /**
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig\Error\RuntimeError
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Twig\Error\LoaderError
     */
    public function show(): void
    {
        $searchQuery = $_GET['search'] ?? null;

            $episode = $this->apiService->fetchEpisode($searchQuery);
            //var_dump($episode);
                echo $this->twig->render('episode.twig', ['episode' => $episode]);
            }
        }


