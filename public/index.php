<?php

// pour "activer" Composer
require_once __DIR__.'./../vendor/autoload.php';

// un require par Controller utilisé, on ne peut pas y couper

// 1- Models, 2 -Utils , 3 - Controller
require_once __DIR__.'./../app/models/CoreModel.php';
require_once __DIR__.'./../app/utils/DBData.php';
require_once __DIR__.'./../app/controllers/CoreController.php';
require_once __DIR__.'./../app/controllers/MainController.php';
require_once __DIR__.'./../app/controllers/GalleryController.php';
// ...

// 1. on instancie le routeur
$router = new AltoRouter();

// 2. on indique au routeur quelle partie de l'url il ne doit pas toucher
$baseUrl = dirname($_SERVER['SCRIPT_NAME']);

$router->setBasePath($baseUrl);

// 3. on écrit toutes nos routes (j'avoue, c'est long, mais vous ne le ferez qu'une fois)
$router->map('GET', '/', [
    'controller' => 'MainController',
    'method' => 'home'
], 'home');

$router->map('GET', '/about/', [
    'controller' => 'MainController',
    'method' => 'about'
], 'about');

// Galerie 

$router->map('GET', '/gallery/', [
    'controller' => 'GalleryController',
    'method' => 'gallery'
], 'gallery');

$router->map('GET', '/gallery/costume/', [
    'controller' => 'GalleryController',
    'method' => 'costume'
], 'costume');

// page de contact

$router->map('GET', '/contact/', [
    'controller' => 'ContactController',
    'method' => 'contact'
], 'contact');




// 4. on demande au routeur si la route d'accès correspond à une des routes déclarées plus haut
$match = $router->match();
// si c'est le cas, $match sera un tableau qui contient toutes les infos utiles au traitement de l'action correspondante
// si c'est pas le cas, $match vaudra false, tout simplement

// 5. on instancie le dispatcher magique de Ben et Jean, les meilleurs développeurs du monde
$dispatcher = new Dispatcher($match, 'ErrorController::pls');

// 6. et on lui demande poliment de dispatcher, il se charge du reste
$dispatcher->dispatch();

// 7. une bonne bière et un bon saucisson, car on a fini ;-)
