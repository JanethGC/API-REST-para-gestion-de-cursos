<?php

class ControladorClientes{

    public function create(){

        $json = array(
    
            "detalle" => "Estas en la vista registro de clientes"
    
        );
    
        echo json_encode($json,true);

        return;

    }

}



?>