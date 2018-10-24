<?php

require_once '../capaDatos/Conexion.clase.php';

class producto extends Conexion{
    
    
    private $codigo_producto;
    private $nombre;
    private $precio;
    
    function getCodigo_producto() {
        return $this->codigo_producto;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getPrecio() {
        return $this->precio;
    }

    function setCodigo_producto($codigo_producto) {
        $this->codigo_producto = $codigo_producto;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    
public function listar() {
     try {
    $sql = "select * from producto order by 2";
     $sentencia = $this->dblink->prepare($sql);
     $sentencia->execute();
     $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
     return $resultado;

     } catch (Exception $exc) {
       throw $exc;
}
 }
 
 public function obtenerFoto($id) {
        $foto = "../imagenes-producto/".$id;

        if (file_exists( $foto . ".png" )){
            $foto = $foto . ".png";

        }else if (file_exists( $foto . ".PNG" )){
            $foto = $foto . ".PNG";

        }else if (file_exists( $foto . ".jpg" )){
            $foto = $foto . ".jpg";

        }else if (file_exists( $foto . ".JPG" )){
            $foto = $foto . ".JPG";

        }else{
            $foto = "none";
        }
        
        if ($foto == "none"){
            return $foto;
        }else{
            return Funciones::$DIRECCION_WEB_SERVICE . $foto;
        }
        
    }
   
}
