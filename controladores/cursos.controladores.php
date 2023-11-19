<?php 

class ControladorCursos{

    

    public function index(){
        
        $clientes = ModeloCliente::index("clientes");

        if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']) ){

            foreach ($clientes as $key => $value) {
                
                if($_SERVER['PHP_AUTH_USER'].":".$_SERVER['PHP_AUTH_PW'] == $value["id_cliente"].":".$value["llave_secreta"] ){

                    $cursos = ModeloCurso::index("cursos");


                    $json = array(
                
                        "detalle" => $cursos,
                
                    );
                
                    echo json_encode($json,true);
            
                    return;
                }
            

            }
            

        }else{
            $json = array(
                
                "detalle" => "Ingrese id_cliente y llave_secreta",
        
            );
        
            echo json_encode($json,true);
    
            return;

        }

       

    }

    public function create(){

        $json = array(
    
            "detalle" => "Estas en la vista de crear cursos"
    
        );
    
        echo json_encode($json,true);

        return;

    }

    public function show( $id ){

        $json = array(
    
            "detalle" => "Este es el curso con el id... ".$id
    
        );
    
        echo json_encode($json,true);

        return;

    }

    public function update( $id){

        $json = array(
    
            "detalle" => "Curso actualizado con exito de id... -> ". $id
    
        );
    
        echo json_encode($json,true);

        return;

    }

    public function delete( $id){

        $json = array(
    
            "detalle" => "Curso borrado con exito de id... -> ". $id
    
        );
    
        echo json_encode($json,true);

        return;

    }


}

?>