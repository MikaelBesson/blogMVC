<?php
require_once ('views/View.php');

class Router {
    private $_ctrl;
    private $_view;

    public function routeReq(){
        try {
            //chargement auto des classes
            spl_autoload_register(function ($class){
                require_once('models/'.$class.'View.php');
            });
            $url = '';
            // le controller est inclus selon l'action de l'utilisateur
            if(isset($_GET['url'])){
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));

                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = "Controller".$controller;
                $controllerFile = "controllers/".$controllerClass."View.php";

                if(file_exists($controllerFile)){
                    require_once ($controllerFile);
                    $this->_ctrl = new $controllerClass($url);
                }
                else
                    throw new Exception('page introuvable');
            }
            else {
                require_once('controllers/ControllerAccueil.php');
                $this->_ctrl = new ControllerAccueil($url);
            }
        }
        //gestion des erreurs
        catch (Exception $exception){
            $errorMsg = $exception->getMessage();
            $this->_view = new view('error');
            $this->_view->generate(array('errorMsg' => $errorMsg));

        }
    }
}