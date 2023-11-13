<?php 

class ControladorCursos{

    

    public function index(){

        $cursos = ModeloCurso::index("cursos");

        $json = array(
    
            "detalle" => $cursos,
    
        );
    
        echo json_encode($json,true);

        return;

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