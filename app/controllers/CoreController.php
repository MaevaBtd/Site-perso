<?php

require_once __DIR__.'/../utils/DBData.php';

abstract class CoreController {
    // une instance de DBData, protected donc dispo pour tous les contrôleurs héritant de CoreController
    protected $dbd;

    // puisque je vais avoir quasi-systématiquement besoin de DBData, je vais l'instancier au construct
    public function __construct() {
        $this->dbd = new DBData();
    }

    protected function redirect($url){
        $public = dirname($_SERVER['SCRIPT_NAME']);
        header('Location: '.$public.$url);
    }

    // la méthode existait dans tous les contrôleurs...
    // pour la modifier, c'était galère...
    // la solution : "factoriser" la méthode en la plaçant dans l'ancêtre
    protected function show($viewName, $viewVars=[]) {
        // extract crée des variables à partir des clés d'un tableau et leur attribue les valeurs du tableau
        extract($viewVars);

        $public = dirname($_SERVER['SCRIPT_NAME']);
        
        // $viewVars est disponible dans chaque fichier de vue
        // et il correspond au tableau qu'on a passé en 2e argument lors de l'appel à show()
        require __DIR__.'/../views/header.tpl.php';
        require __DIR__.'/../views/'.$viewName.'.tpl.php';
        require __DIR__.'/../views/footer.tpl.php';
    }
}