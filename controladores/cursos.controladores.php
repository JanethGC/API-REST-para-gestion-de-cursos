<?php 

class ControladorCursos{

    

    public function index($pagina){
        
        $clientes = ModeloCliente::index("clientes");

        if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']) ){

            foreach ($clientes as $key => $value) {
                
                if(base64_encode($_SERVER['PHP_AUTH_USER'].":".$_SERVER['PHP_AUTH_PW'])== 
                   base64_encode($value["id_cliente"].":".$value["llave_secreta"]) ){

                    if($pagina != null){

                        $cantidad = 10;

                        $desde = ( $pagina - 1) * $cantidad;

                        $cursos = ModeloCurso::index("cursos","clientes",$cantidad,$desde);

                        
                    }else{

                        $cursos = ModeloCurso::index("cursos","clientes",null,null);


                    }



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

    public function create($datos){

        $clientes = ModeloCliente :: index("clientes");

        if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){

            foreach ($clientes as $key => $valueClientes) {
                
                if( base64_encode($valueClientes["id_cliente"].":". $valueClientes["llave_secreta"]) == 
                    base64_encode($_SERVER['PHP_AUTH_USER'].":".$_SERVER['PHP_AUTH_PW']) ){


                    foreach ($datos as $key => $valueDatos) {

                        
                        if(isset($valueDatos) && !preg_match('/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $valueDatos )){

                            $json = array(

								"status"=>404,
								"detalle"=>"Error en el campo ".$key

							);
                            echo json_encode($json, true);

							return;
                
                        }

                

                    }

                    $cursos = ModeloCurso::index("cursos", null, null, null);

                    foreach ($cursos as $key => $value) {

                        if($value->titulo == $datos["titulo"]){
            
                                        $json = array(
            
                                            "status"=>404,
                                            "detalle"=>"El título ya existe en la base de datos"
            
                                        );
            
                                        echo json_encode($json, true);	
            
                                        return;
            
                                    }
            
            
                        if($value->descripcion == $datos["descripcion"]){
            
                                        $json = array(
            
                                            "status"=>404,
                                            "detalle"=>"La descripción ya existe en la base de datos"
            
                                        );
            
                                        echo json_encode($json, true);	
            
                                        return;
            
                                        
                                    }
            
            
                    }



                    $datos = array( "titulo"=>$datos["titulo"],
                                    "descripcion"=>$datos["descripcion"],
                                    "instructor"=>$datos["instructor"],
                                    "imagen"=>$datos["imagen"],
                                    "precio"=>$datos["precio"],
                                    "id_creador"=>$valueClientes["id"],
                                    "created_at"=>date('Y-m-d h:i:s'),
                                    "updated_at"=>date('Y-m-d h:i:s'));



                    $create = ModeloCurso::create("cursos", $datos);

                    if($create == "ok"){

				    	$json = array(
			        	"status"=>200,
				    		"detalle"=>"Registro exitoso, su curso ha sido guardado"

				    	); 
				    	
				    	echo json_encode($json, true); 

				    	return;    	

			   	 	}


                    
                }
            }

            


        }

       

    }

    public function show( $id ){

        $clientes = ModeloCliente::index("clientes");

        if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']) ){

            foreach ($clientes as $key => $value) {
                
                if(base64_encode($_SERVER['PHP_AUTH_USER'].":".$_SERVER['PHP_AUTH_PW'])== 
                   base64_encode($value["id_cliente"].":".$value["llave_secreta"]) ){

                    $curso = ModeloCurso::show("cursos","clientes",$id);

                    if(!empty($curso)){

                        $json = array(
                            "detalle" => $curso ,
    
                        );
    
                        echo json_encode($json,true);

                    }else{

                        $json = array(
                            "status" => 200,
                            "detalle" => "No se encontro ningun curso" ,
    
                        );
    
                        echo json_encode($json,true);

                    }
                    
                }
            
            }

        }

    }

    public function update( $id, $datos){

        $clientes = ModeloCliente::index("clientes");

        if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']) ){

            foreach ($clientes as $key => $valueCliente) {
                
                if(base64_encode($_SERVER['PHP_AUTH_USER'].":".$_SERVER['PHP_AUTH_PW'])== 
                   base64_encode($valueCliente["id_cliente"].":".$valueCliente["llave_secreta"]) ){

                    foreach ($datos as $key => $valueDatos) {

                        
                        if(isset($valueDatos) && !preg_match('/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $valueDatos )){

                            $json = array(

								"status"=>404,
								"detalle"=>"Error en el campo ".$key

							);

							echo json_encode($json, true);

							return;
                
                        }

                

                    }

                    $curso = ModeloCurso::show("cursos", $id);

                    foreach ($curso as $key => $valueCurso) {
          
                        if($valueCurso->id_creador == $valueCliente["id"]){
          
                            $datos = array( "id"=>$id,
                                            "titulo"=>$datos["titulo"],
                                            "descripcion"=>$datos["descripcion"],
                                            "instructor"=>$datos["instructor"],
                                            "imagen"=>$datos["imagen"],
                                            "precio"=>$datos["precio"],
                                            "updated_at"=>date('Y-m-d h:i:s'));
          
                            $update = ModeloCurso::update("cursos", $datos);
          
                            if($update == "ok"){
          
                                $json = array(
                                            "status"=>200,
                                            "detalle"=>"Registro exitoso, su curso ha sido actualizado"
          
                                        ); 
                                          
                                echo json_encode($json, true); 
          
                                return;  
          
                            }
          
                        }else{
                                
                            $json = array(
      
                                        "status"=>404,
                                        "detalle"=>"No está autorizado para modificar este curso"
                                      
                                    );
      
                            echo json_encode($json, true);
      
                            return;
      
                        }
                 
                    }
                   
                }          

            }         

        }
        
    }

    public function delete( $id){

        $clientes = ModeloCliente::index("clientes");

        if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']) ){

            foreach ($clientes as $key => $valueCliente) {
                
                if(base64_encode($_SERVER['PHP_AUTH_USER'].":".$_SERVER['PHP_AUTH_PW'])== 
                   base64_encode($valueCliente["id_cliente"].":".$valueCliente["llave_secreta"]) ){


                    $curso = ModeloCurso::show("cursos", $id);

                    foreach ($curso as $key => $valueCurso) {
          
                        if($valueCurso->id_creador == $valueCliente["id"]){
          
                            $delete = ModeloCurso::delete("cursos", $id);
          
                            if($delete == "ok"){
          
                                $json = array(
                                            "status"=>200,
                                            "detalle"=>"Registro exitoso, su curso ha sido eliminado"
          
                                        ); 
                                          
                                echo json_encode($json, true); 
          
                                return;  
          
                            }
          
                        }else{
                                
                            $json = array(
      
                                        "status"=>404,
                                        "detalle"=>"No está autorizado para eliminar este curso"
                                      
                                    );
      
                            echo json_encode($json, true);
      
                            return;
      
                        }
                 
                    }
                   
                }          

            }         

        }

    }


}

?>