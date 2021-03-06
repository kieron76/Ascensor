<?php

/**
 * @class Router
 * interpret the url and route to the appropriate controller
 */
class Router {
    
    /**
     * @method run controller
     *
     * find the conroller based on the uri and execute the method also fond in the uri
     * if not found then call index 
     */
    public static function getController() {
        $uri;
        $controller;
        $class;
        $uc_controller;


        $uri = explode("/", $_SERVER["REQUEST_URI"]);

        switch (count($uri)) {
            case 0;
            case 1:
            case 2:
                require("classes/Controllers/IndexController.php");
                $controller = new IndexController();
                $controller->index();
                break;
            case 3:
                if (!empty($uri[2])) {
                    $uc_controller = ucwords($uri[2]);
                    if (file_exists("classes/Controllers/{$uc_controller}Controller.php")) {
                        require("classes/Controllers/{$uc_controller}Controller.php");
                        $class = $uc_controller."Controller";
                        $controller = new $class();
                        $controller->index();
                    } else {
                        throw new HTTP404Exception;
                    }
                } else {
                    require("classes/Controllers/IndexController.php");
                    $controller = new IndexController();
                    $controller->index();
                }
                break;
            case 4;
                if (!empty($uri[3])) {
                    $uc_controller = ucwords($uri[2]);
                    if (file_exists("classes/Controllers/{$uc_controller}Controller.php")) {
                        require("classes/Controllers/{$uc_controller}Controller.php");
                        $class = $uc_controller."Controller";
                        $controller = new $class();
                        $controller->$uri[3]();
                    } else {
                        throw new HTTP404Exception;
                    }
                }
                break;
            
        }
                    
    }

}

