<?php
// Connexion à Redis


/**
 * Etape 1 : Lire les donnees depuis le fichier JSON : mangas.json
 * Etape 2 : Convertir le contenu du fichier JSON en tableau PHP
 * Etape 3 : Parcourir le tableau PHP et inserer les donnees dans Redis
 * Etape 4 : Afficher le contenu de Redis
 */

// Etape 1 : Lire les donnees depuis le fichier JSON : mangas.json
$json = file_get_contents("./data/mangas.json");

// Etape 2 : Convertir le contenu du fichier JSON en tableau PHP
$mangas = json_decode($json, true);

// Etape 3 : Parcourir le tableau PHP et inserer les donnees dans Redis

// you must install redis extension for php to use this class
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

foreach ($mangas as $manga) {
    $redis->set($manga["title"], json_encode($manga));
}

// Etape 4 : Afficher le contenu de Redis avec un acces direct
$naruto = $redis->get("Naruto");


// Récupérer la valeur de la clé
echo "The content of 'Naruto' is $naruto";