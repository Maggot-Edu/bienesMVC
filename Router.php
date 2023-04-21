<?php

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas()
    {
        session_start();
        $auth = $_SESSION['login'] ?? NULL;

        //Vector rutas protegidas
        $rutas_protegidas = [
            '/admin', 
            '/propiedades/crear', 
            '/propiedades/actualizar', 
            '/propiedades/eliminar', 
            '/vendedores/crear', 
            '/vendedores/actualizar', 
            '/vendedores/eliminar'
        ];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? NULL;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? NULL;
        }

        // Proteger rutas
        if(in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /');
        }

        if($fn) {
            call_user_func($fn, $this);
        } else {
            echo "Página no encontrada";
        }
    }

    // Mostrar vistas
    public function render($views, $datos = [] ){

        foreach($datos as $key => $value) {
            $$key = $value;
        }

        ob_start(); //inicia almacenamiento en memoria
        include __DIR__ . "/views/$views.php";
        $contenido = ob_get_clean(); // borra la iinformacion de memoria limpia buffer
        include __DIR__ . "/views/layout.php";
    }
}