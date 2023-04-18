<?php

namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController {
    public static function crear( Router $router ) {

        $errores = Vendedor::getErrores();

        $vendedor = new Vendedor;

        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) { 
            // Crear una nueva estancia
            $vendedor = new Vendedor($_POST['vendedor']);
            // Validar campos vacios
            $errores = $vendedor->validar();
            // No hay errores
            if(empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedor

        ]);
    } 

    public static function actualizar( Router $router ) {
        
        $errores = Vendedor::getErrores();

        $id = validarORedireccionar('/admin');

        //Obtener datos de vendedor a actualizar
        $vendedor = Vendedor::find($id);

        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) { 
            // Asignar los valores
            $args = $_POST['vendedor'];
            //Sincronizar objeto en memoria con elo que ha escrito el usuario
            $vendedor->sincronizar($args);
            // validacion
        
            $errores = $vendedor->validar();
            if(!$errores) {
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/actualizar', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    } 

    public static function eliminar(  ) {
        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
            // Valida tipo a eliminar
            $tipo = $_POST['tipo'];

            // Validar id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                //validar el tipo a eliminar
                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
            
        }
    } 
}