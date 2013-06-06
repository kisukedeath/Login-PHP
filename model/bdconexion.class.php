<?php

class bdconexion {
    
    //Database conection
    private $conexion;
    //Conection attributes
    private $database;
    private $host;
    private $user;
    private $pass;
    
    // Success messages
    private $conection_success;
    private $conection_fail;
    private $insert_success;
    private $insert_fail;
    private $update_success;
    private $update_fail;
    private $delete_success;
    private $delete_fail;
    
    //Constructor
    function bdconexion(){

        $server = 'OVEJO-PC\SQL2012';//serverName\instanceName
        $this->database= 'test';
        $this->host= $server;
        $this->user= 'kisuke';
        $this->pass= 'shakugan';      
        
        $this->conection_success = 'Se estableci&oacute; correctamente la conexi&oacute;n.';
        $this->conection_fail = 'Hubo una falla en la conexi&oacute;n.';
        $this->insert_success = 'Se insertaron los datos satisfactoriamente.';
        $this->insert_fail = 'Hubo una falla en la inserción de los datos.';
        $this->update_success = 'Se actualizaron los datos satisfactoriamente.';
        $this->update_fail = 'Hubo una falla en la actualizaci&oacute;n de los datos.';
        $this->delete_success = 'Se eliminaron los datos satisfactoriamente.';
        $this->delete_fail = 'Hubo una falla en la eliminaci&oacute;n de los datos.';
             
    }

    public function conectar(){
        $success = true;
        //crear conexion a la base de datos 
        $connectionInfo = array( "Database"=>$this->database, "UID"=>$this->user, "PWD"=>$this->pass);

        if(!($con = sqlsrv_connect( $this->host, $connectionInfo))){
            $success= false;
            die( print_r( sqlsrv_errors(), true));
        }
 
        if($success){        
            $this->conexion = $con;      
        }
       
        return $success;  
    }

    /*
    $serverName = "OVEJO-PC\SQL2012"; //serverName\instanceName
    $connectionInfo = array( "Database"=>"test", "UID"=>"kisuke", "PWD"=>"shakugan");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if( $conn ) {
         echo "Conexión establecida.<br />";
    }else{
         echo "Conexión no se pudo establecer.<br />";
         die( print_r( sqlsrv_errors(), true));
    }
    */
    
    public function insertar($query){
        if($this->conectar()){         
            if(sqlsrv_query( $this->conexion,$query)){       
                echo "true";
            }else
                echo "false";
        }else        
        die("Falló la conexión a la Base de Datos: ");
    }


    public function actualizar($query) {
            if($this->conectar()) {
                if(sqlsrv_query($this->conexion,$query)) {
                    echo $this->update_success;
                }
                else {
                    echo $this->update_fail;
                }
            }
            else {
                echo $this->conection_fail;
            }
        }


    public function comprobar($query,$password) {
            if($this->conectar()) {
                $result = sqlsrv_query($this->conexion,$query,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                if(!empty($result)) {
                    $total = sqlsrv_num_rows($result);
                    if ($total === false){
                       echo "Error in retrieveing row count."."<br>"; 
                       print_r(sqlsrv_errors()); 
                    }
                    if($total > 0) {
                        $print = "";
                        if($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                            if($row['password'] == $password){
                                $u = $row['usuario'];
                                return $u;
                            }else{
                                echo 'password incorrecto <br> <a href="../index.php">volver</a>';
                            }
                        }
                    }else{
                    echo 'Usuario no existe en la base de datos <br> <a href="../index.php">volver</a>';
                    }  
                }
            }
            else {
                echo $this->conection_fail;
            }
      }
    

     public function listar($query) {
            if($this->conectar()) {
                $result = sqlsrv_query($this->conexion,$query,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                if(!empty($result)) {
                    $total = sqlsrv_num_rows($result);
                    if ($total === false){
                       echo "Error in retrieveing row count."."<br>"; 
                       print_r(sqlsrv_errors()); 
                    }  
                    if($total > 0) {
                        $print = "";
                        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                            foreach($row as &$fila) {
                                $print .= $fila.",";
                            }
                        }
                        $print = substr ($print, 0, -1);
                        return $print;
                    }
                }
            }
            else {
                echo $this->conection_fail;
            }
      }
        
        public function listar2($query) {
            if($this->conectar()) {
                $result = sqlsrv_query($this->conexion,$query,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                if(!empty($result)) {
                    $total = sqlsrv_num_rows($result);
                    if ($total === false){
                       echo "Error in retrieveing row count."."<br>"; 
                       print_r(sqlsrv_errors()); 
                    }  
                    if($total > 0) {
                        $print = "";
                        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                            foreach($row as &$fila) {
                                $print .= $fila."<,>";
                            }
                        }
                        $print = substr ($print, 0, -3);
                        return $print;
                    }
                }
            }
            else {
                echo $this->conection_fail;
            }
      }


     public function mensaje_insertar($success, $message) {
            if($success == true) {
                $this->insert_success = $message;
            }
            else {
                $this->insert_fail = $message;
            }
        }
        
        public function mensaje_actualizar($success, $message) {
            if($success == true) {
                $this->update_success = $message;
            }
            else {
                $this->update_fail = $message;
            }
        }
        
        public function mensaje_eliminar($success, $message) {
            if($success == true) {
                $this->delete_success = $message;
            }
            else {
                $this->delete_fail = $message;
            }
        }
    
    
}

?>
