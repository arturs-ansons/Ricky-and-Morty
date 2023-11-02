<?php
namespace MvcApp\Models;
use Carbon\Carbon;
use GuzzleHttp\Client;

class ApiService
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fetchAllEpisodes(): array
    {
        $response = $this->client->get('https://rickandmortyapi.com/api/character');

        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            $episodes = $data['results'];

            foreach ($episodes as &$episode) {
                $episode['image_url'] = $episode['image'];
            }
            return $episodes;
        }
        return [];
    }
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fetchEpisode($searchQuery): array
    {
        if ($searchQuery) {
            $response = $this->client->get('https://rickandmortyapi.com/api/episode/?episode=' . urlencode($searchQuery));

            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody(), true);
                $episode = $data['results'][0];

                $characterURLs = $episode['characters'];
                $episode['characterImg'] = $this->fetchCharacterImage($characterURLs);

                if (isset($episode['air_date'])) {
                    $episode['air_date'] = Carbon::parse($episode['air_date'])->format('Y-m-d');
                }

                return $episode;
            }
        }
        return [];
    }
    /**
     * Fetch character images.
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function fetchCharacterImage(array $characterURLs): array
    {
        $characterImages = [];

        foreach ($characterURLs as $characterURL) {
            $response = $this->client->get($characterURL);

            if ($response->getStatusCode() == 200) {
                $characterData = json_decode($response->getBody(), true);
                $characterImages[] = $characterData['image'];
            }
        }
        return $characterImages;
    }
}

