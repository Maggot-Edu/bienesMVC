<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index(Router $router) {
        $propiedades = Propiedad::get(3);
        $inicio = true;
        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio'      => $inicio
        ]);
    }
    public static function nosotros(Router $router) {
       $router->render('paginas/nosotros', []);
    }
    public static function propiedades(Router $router) {
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad(Router $router) {

        $id = validarORedireccionar('/propiedades');

        //Buscar propiedad por id
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router) {
        $router->render('paginas/blog');
    }
    public static function entrada(Router $router) {
        $router->render('paginas/entrada');
    }
    public static function contacto(Router $router) {

        $mensaje = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $respuesta = $_POST['contacto'];

            // crear instancia PHPMailer
            $mail = new PHPMailer();

            //configurar SMTP protocolo de envio emails
            $mail->isSMTP();
            $mail->Host         = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth     = true;
            $mail->Username     = '9b2836c18c3e1c';
            $mail->Password     = 'e0df92524025b8';
            $mail->SMTPSecure   = 'tls';
            $mail->Port         = 2525;

            //Configurar el contenido del mail
            $mail->setFrom('admin@bienes.com');
            $mail->addAddress('admin@bienes.com', 'Bienes.com');
            $mail->Subject = 'Tienes una nueva notificacion Bienes';

            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Definir el contenido
            $contenido      = '<html>';
            $contenido     .= '<p>Tienes una notificacion</p><br>';
            $contenido     .= '<p>Nombre:   '. $respuesta['nombre'] .'</p>';
            $contenido     .= '<p>Mensaje:   '. $respuesta['mensaje'] .'</p>';
            $contenido     .= '<p>Presupuesto:   '. $respuesta['precio'] .'</p>';
            // Contactar de formna condicional
            if ($respuesta['contacto'] === 'telefono') {
                $contenido .= '<p>Contactar el:   '. $respuesta['fecha'] . ' a partir de las ' . $respuesta['hora'] . ' via Teléfono ' . $respuesta['telefono'] . '</p>';
            } else {
                $contenido .= '<p>Contactar por Email: ' . $respuesta['email'] . '</p>';
            }
            $contenido     .= '</html>';
            $mail->Body     = $contenido;
            $mail->AltBody  = 'Texto alternativo';

            //Enviar el email
            if($mail->send()) {
                $mensaje = "Mensaje enviado correctamente";
            } else {
                $mensaje = "El mensaje no se pundo enviar";
            }
            
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}