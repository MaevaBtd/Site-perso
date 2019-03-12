<?php 

class MainController extends CoreController {

    public function home() {
        $this->show('home');
    }

    public function pls() {
        $this->show('404');
        header('HTTP/1.0 404 Not Found');
    } 

    public function about() {
        $this->show('about');
    } 

}