<?php  

    $arrayRutas=explode("/",$_SERVER['REQUEST_URI']);

    // echo "<pre>";print_r($arrayRutas);echo "<pre>";


    if(count(array_filter($arrayRutas)) == 2){

        $json = array(

            "detalle" => "no encontrado"
    
        );
    
        echo json_encode($json,true);

        return;

    }
    
    if(count(array_filter($arrayRutas)) == 3){

        if(array_filter($arrayRutas)[3] == "cursos"){

            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST" ){

                $datos = array(
                    "titulo" => $_POST["titulo"],
                    "descripcion" => $_POST["descripcion"],
                    "instructor" => $_POST["instructor"],
                    "imagen" => $_POST["imagen"],
                    "precio" => $_POST["precio"]
                   

                );

                $cursos = new ControladorCursos();
                $cursos -> create($datos);


            }

            else if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET" ){

                $cursos = new ControladorCursos();
                $cursos -> index();


            }

           
        }

        if(array_filter($arrayRutas)[3] == "registro"){

            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){

                $datos = array (

                    "nombre" => $_POST["nombre"],
                    "apellido" => $_POST["apellido"],
                    "email" => $_POST["email"]

                );
                
                $clientes = new ControladorClientes();
                $clientes -> create($datos);

            }
        }

    }else{

        if(array_filter($arrayRutas)[3] == "cursos" && is_numeric(array_filter($arrayRutas)[4] )){

            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET"){

                $cursos = new ControladorCursos();
                $cursos -> show(array_filter($arrayRutas)[4]);



            }

            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "PUT"){

                $editarCurso = new ControladorCursos();
                $editarCurso -> update(array_filter($arrayRutas)[4]);

            }

            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "DELETE"){

                $borrarCurso = new ControladorCursos();
                $borrarCurso -> delete(array_filter($arrayRutas)[4]);

            }
        }


    }

?>