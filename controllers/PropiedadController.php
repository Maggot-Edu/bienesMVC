<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController {
    public static function index(Router $router){

        $propiedades = Propiedad::all();
        $resultado = NULL;
        $vendedores = Vendedor::all();

        $router->render('/propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado'   => $resultado,
            'vendedores'  => $vendedores
        ]);

    }

    public static function crear(Router $router){

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        //mensaje errores
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $propiedad = new Propiedad($_POST['propiedad']);
            /* Subida de archivos*/
            //generar nombre unico
            $nombreImagen = md5(uniqid( rand(), true ) ).".jpg";
            // Realizar  un rizize de la imagen con Intervention
            if ($_FILES['propiedad']['tmp_name']['imagen']){
                $imagen = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }
            // revisar si no hay errores
            $errores = $propiedad->validar();
            if ( empty($errores) ) {
                // Crear carpeta subir imagenes
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }
                //Guardar imagen en el servidor
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                // Guerdar BBDD
                $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad'  => $propiedad,
            'vendedores' => $vendedores,
            'errores'    => $errores
        ]);
    }

    public static function actualizar(Router $router){
        
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $errores = Propiedad::getErrores();
        $vendedores = Vendedor::all();
        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
            $args = new Propiedad($_POST['propiedad']);
    
            $propiedad->sincronizar($args);
            // Validacion
            $errores = $propiedad->validar();
            //Subida archivos
            //generar nombre unico
            $nombreImagen = md5(uniqid( rand(), true ) ).".jpg";
            // Realizar  un rizize de la imagen con Intervention
            if ($_FILES['propiedad']['tmp_name']['imagen']){
                $imagen = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }
            if ( empty($errores) ) {
                if($_FILES['propiedad']['tmp_name']['imagen']){
                    $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                }
                // Insertar en bbdd
                $propiedad->guardar();
            }
        }
        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores'    => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id) {
                $tipo = $_POST['tipo'];
                if (validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}