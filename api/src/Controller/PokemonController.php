<?php


namespace App\Controller;

use App\Entity\Pokemon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends AbstractController
{
    private $client;
    private $entityManager;

    public function __construct(HttpClientInterface $client, EntityManagerInterface $entityManager)
    {
        $this->client = $client;
        $this->entityManager = $entityManager;
    }

    #[Route('/fetch-pokemons', name: 'fetch_pokemons')]
    public function fetchAndSavePokemons(): JsonResponse
    {
        $response = $this->client->request('GET', 'https://pokeapi.co/api/v2/pokemon?limit=10');
        $pokemonsData = $response->toArray()['results'];

        foreach ($pokemonsData as $pokemonData) {
            $pokemonResponse = $this->client->request('GET', $pokemonData['url']);
            $pokemonDetails = $pokemonResponse->toArray();

            $pokemon = new Pokemon();
            $pokemon->setName($pokemonDetails['name']);
            $pokemon->setType($pokemonDetails['types'][0]['type']['name']);
            $pokemon->setHp($pokemonDetails['stats'][0]['base_stat']);
            $pokemon->setAttack($pokemonDetails['stats'][1]['base_stat']);

            $this->entityManager->persist($pokemon);
        }

        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Pokemons saved successfully!']);
    }
}