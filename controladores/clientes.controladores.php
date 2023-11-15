<?php

class ControladorClientes{

    public function create($datos){

        echo "<pre>"; print_r($datos); echo "<pre>" ;

        if(isset($datos["nombre"]) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/', $datos["nombre"])){

            $json = array(
    
            "detalle" => "Nombre no valido"
    
            );
    
            echo json_encode($json,true);

            return;

        }

        if(isset($datos["apellido"]) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/', $datos["apellido"])){

            $json = array(
    
            "detalle" => "Apellido no valido"
    
            );
    
            echo json_encode($json,true);

            return;

        }

        if(isset($datos["email"]) && !preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $datos["email"])){

            $json=array(

                    "detalle"=>"error en el campo email "

            );

            echo json_encode($json,true);

            return;


        }

        $clientes = ModeloCliente :: index("clientes");

        foreach ($clientes as $key => $value) {
            
            if($value["email"] == $datos["email"] ){

                $json=array(

                    "detalle"=>" Correo repetido "

                );

                echo json_encode($json,true);

                return;


            }

        }




        

    }

}



?>