<?php

require 'vendor/autoload.php';

use Alura\BuscadorDeCursos\Buscador;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client(['base_uri' => 'http://www.alura.com.br', 'verify' => false]);
$crawler = new Crawler();

$buscador = new Buscador($client, $crawler);
$courses = $buscador->search('/cursos-online-programacao/php');

foreach ($courses as $course) {
    echo $course . PHP_EOL;
}
