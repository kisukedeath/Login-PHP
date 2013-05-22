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
        $this->database= '';
        $this->host= 'localhost';
        $this->user= '';
        $this->pass= '';      
        
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
       
        //crear conexion a la base de datos (mysql_connect{"localhost","root","");
        if(!($con=  mysql_connect($this->host,  $this->user, $this->pass))){
            $success= false;
       
        }
        //seleccionar base de datos a utilizar
        if(!(mysql_select_db($this->database,$con))){        
            $success=false;
       
        }
        
        if($success){        
            $this->conexion = $con;      
        }
       
        
        return $success;  
    }
    
    public function insertar($query){
        if($this->conectar()){      
         //  echo $query;    
            if(mysql_query($query, $this->conexion)){       
                echo "true";
            }else
                echo "false";
        }else        
        die("Falló la conexión a la Base de Datos: " .mysql_error());
    }


    public function actualizar($query) {
            if($this->conectar()) {
        //        echo $query;    
                if(mysql_query($query, $this->conexion)) {
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

       
     public function listar($query) {

            if($this->conectar()) {
                $result = mysql_query($query, $this->conexion);
                
                if(!empty($result)) {
                    $total = mysql_num_rows($result);
                    
                    if($total > 0) {
                        $print = "";
                        while($row = mysql_fetch_assoc($result)) {
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
                $result = mysql_query($query, $this->conexion);
                
                if(!empty($result)) {
                    $total = mysql_num_rows($result);
                    
                    if($total > 0) {
                        $print = "";
                        while($row = mysql_fetch_assoc($result)) {
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
