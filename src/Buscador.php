<?php

namespace Alura\BuscadorDeCursos;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
    /**
     * @var ClientInterface
     */
    private $httpClient;
    /**
     * @var Crawler
     */
    private $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function search(string $url): array
    {
        $courses = [];
        try {
            $response = $this->httpClient->request('GET', $url);
            $html = $response->getBody();
            $this->crawler->addHtmlContent($html);

            $coursesElements = $this->crawler->filter('span.card-curso__nome');

            foreach ($coursesElements as $element) {
                $courses[] = $element->textContent;
            }
        } catch (GuzzleException $e) {
            echo $e->getMessage() . PHP_EOL;
        }

        return $courses;
    }
}
