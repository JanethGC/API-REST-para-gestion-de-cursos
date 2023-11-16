<?php

class ControladorClientes{

    public function create($datos){


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

        $id_cliente = str_replace('$','c',crypt($datos["nombre"].$datos["apellido"].$datos["email"], '$2a$07$afartwetsdAD52356FEDGsfhsd$'));

        $llave_secreta =str_replace('$','c',crypt($datos["email"].$datos["apellido"].$datos["nombre"], '$2a$07$afartwetsdAD52356FEDGsfhsd$'));


        $datos = array(

            "nombre" => $datos["nombre"],
            "apellido" => $datos["apellido"],
            "email" => $datos["email"],
            "id_cliente" => $id_cliente,
            "llave_secreta" => $llave_secreta,
            "created_at" => date('Y-m-d h:i:s'),
            "updated_at" => date('Y-m-d h:i:s'),


        );

        $create = ModeloCliente :: create("clientes", $datos);

        if( $create == "ok"){

            $json = array(

                "status" => 404,
                "detalle" => "Sus credenciales se generaron con exito",
                "id_cliente" => $id_cliente,
                "llave_secreta" => $llave_secreta

            );

            echo json_encode($json,true);

            return;

        }

        

        

    }

}



?>