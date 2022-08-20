<?php
include_once 'conexion.php';
class UniversidadModel 
{
	
 private $bd;

   

    public function Listar()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM universidad where eliminado=0 order by idUniversidad;" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            //print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }       

    }


        public function ListarUniversidadTI()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM universidad where eliminado=0 and activo=1 order by nombre asc;" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            //print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }       

    }


    public function Consultar(Universidad $universidad)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM universidad WHERE idUniversidad = :idUniversidad;");
        $stmt->bindParam(':idUniversidad', $universidad->__GET('idUniversidad'));
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);      
        $objUniversidad = new Universidad(); 
        $objUniversidad->__SET('idUniversidad',$row->idUniversidad);
        $objUniversidad->__SET('codigo',$row->codigo);
        $objUniversidad->__SET('nombre',$row->nombre);
        $objUniversidad->__SET('direccion',$row->direccion);
        $objUniversidad->__SET('licenciado',$row->licenciado);
        $objUniversidad->__SET('cant_carreras',$row->cant_carreras);
        $objUniversidad->__SET('activo',$row->activo);
   
        return $objUniversidad;
    }



    public function Consultar_persona_dia($fecha_ingreso)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT count(idUniversidad)+1 as nro_persona FROM  universidad WHERE fecha_ingreso=:fecha_ingreso;");
        $stmt->bindParam(':fecha_ingreso', $fecha_ingreso);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);      
        $nro_persona= $row->nro_persona;
       
              
        return $nro_persona;
    }

    public function Actualizar(Universidad $universidad)
    {
      
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE universidad SET  direccion=:direccion,licenciado=:licenciado,cant_carreras=:cant_carreras,apellido_materno=:apellido_materno,fecha_nacimiento=:fecha_nacimiento,sexo=:sexo,celular=:celular,tipo_horario=:tipo_horario,horario_entrada=:horario_entrada,horario_salida=:horario_salida,correo=:correo,fecha_salida=:fecha_salida,activo=:activo,modificado_por=:modificado_por WHERE idUniversidad=:idUniversidad;");

        $stmt->bindParam(':idUniversidad',$universidad->__GET('idUniversidad'));
        $stmt->bindParam(':direccion',$universidad->__GET('direccion'));
        $stmt->bindParam(':licenciado',$universidad->__GET('licenciado'));
        $stmt->bindParam(':cant_carreras',$universidad->__GET('cant_carreras'));
        $stmt->bindParam(':activo',$universidad->__GET('activo'));
        $stmt->bindParam(':modificado_por',$universidad->__GET('modificado_por'));

           
        if (!$stmt->execute()) {
          
           // $errors = $stmt->errorInfo();
            
             return 'error';
           //return $errors[2];  
        }else{
            
            return 'exito';
        }
    }    

    public function Registrar(Universidad $universidad)
    {
       
  
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("INSERT INTO universidad(direccion,licenciado,cant_carreras,apellido_materno,nombre,codigo,celular,fecha_ingreso,fecha_nacimiento,sexo,tipo_horario,horario_entrada,horario_salida,correo,ingresado_por) VALUES(:direccion,:licenciado,:cant_carreras,:apellido_materno,:nombre,:codigo,:celular,:fecha_ingreso,:fecha_nacimiento,:sexo,:tipo_horario,:horario_entrada,:horario_salida,:correo,:ingresado_por)");

      
        $stmt->bindParam(':direccion',$universidad->__GET('direccion'));
        $stmt->bindParam(':licenciado',$universidad->__GET('licenciado'));
        $stmt->bindParam(':cant_carreras',$universidad->__GET('cant_carreras'));
        $stmt->bindParam(':nombre',$universidad->__GET('nombre'));
        $stmt->bindParam(':codigo',$universidad->__GET('codigo'));
        $stmt->bindParam(':ingresado_por',$universidad->__GET('ingresado_por')); 

        if (!$stmt->execute()) {
            //$errors = $stmt->errorInfo();
             //echo($errors[2]);
           //return $errors[2];
           return 'error';          
            //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }

    public function Eliminar(Universidad $universidad)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE universidad SET  modificado_por=:modificado_por,eliminado=:eliminado WHERE idUniversidad = :idUniversidad");

        $stmt->bindParam(':idUniversidad',$universidad->__GET('idUniversidad'));         
        $stmt->bindParam(':modificado_por',$universidad->__GET('modificado_por'));
        $stmt->bindParam(':eliminado',$universidad->__GET('eliminado'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }
 
}