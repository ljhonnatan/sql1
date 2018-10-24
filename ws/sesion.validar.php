<?php

require_once '../logica/Sesion.clase.php';
require_once '../util/funciones/Funciones.clase.php';

if (! isset($_POST["email"]) || ! isset($_POST["clave"])){
    Funciones::imprimeJSON(500, "Falta completar los datos requeridos", "");
    exit();
}

$email = $_POST["email"];
$clave = $_POST["clave"];


try {
    $objSesion = new Sesion();
    $objSesion->setEmail($email);
    $objSesion->setClave($clave);
    $resultado = $objSesion->validarSesion();
    
    
    $foto = $objSesion->obtenerFoto( $resultado["dni"] );
    
    $resultado["foto"] = $foto;
    
    if ($resultado["estado"] == 200){
        unset( $resultado["estado"] );
        
        /*Generar un token de seguridad*/
        require_once 'token.generar.php';
        $token = generarToken(null, 60*60);
        $resultado["token"] = $token;
        /*Generar un token de seguridad*/
        
        Funciones::imprimeJSON(200, "Bienvenido a la aplicación móvil", $resultado);
    }else{
        Funciones::imprimeJSON(500, $resultado["dni"], "nombre");
    }
    
    
} catch (Exception $exc) {
    
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}