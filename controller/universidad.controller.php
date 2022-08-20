<?php
require_once 'model/universidad.model.php';
require_once 'entity/universidad.entity.php';
require_once 'includes.controller.php';

class UniversidadController extends IncludesController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new UniversidadModel();
    }
    /**==========================Vistas=======================================*/
    public function Index(){        
        require_once 'view/header.php';
        require_once 'view/administracion/universidad/index.php';
        require_once 'view/footer.php';       
    }

    public function v_Actualizar(){        
        require_once 'view/header.php';
        require_once 'view/administracion/universidad/actualizar.php';
        require_once 'view/footer.php';       
    }

    public function v_Registrar(){        
        require_once 'view/header.php';
        require_once 'view/administracion/universidad/registrar.php';
        require_once 'view/footer.php';       
    }


    /**=======================================================================*/   
    public function Listar()
    {
        $universidades = $this->model->Listar();
        return $universidades;
    }


    public function ListarPersonalTI()
    {
        $universidades = $this->model->ListarPersonalTI();
        return $universidades;
    }


    public function Consultar($idUniversidad)
    {
        $universidad = new Universidad();
        $universidad->__SET('idUniversidad',$idUniversidad);

        $consulta = $this->model->Consultar($universidad);
        return $consulta;
    }

    public function Actualizar(){
        $universidad = new Universidad();
        $universidad->__SET('idUniversidad',$_REQUEST['idUniversidad']);
        $universidad->__SET('codigo',$_REQUEST['codigo']);
        $universidad->__SET('nombre',$_REQUEST['nombre']);
        $universidad->__SET('direccion',$_REQUEST['direccion']);
        $universidad->__SET('licenciado',$_REQUEST['licenciado']);
        $universidad->__SET('cantidad_carreras',$_REQUEST['cantidad_carreras']);
        $universidad->__SET('activo',$_REQUEST['activo']);                  
        $universidad->__SET('modificado_por',$_SESSION['Usuario_Actual']);      
        $actualizar_universidad = $this->model->Actualizar($universidad);         
        if($actualizar_universidad=='error'){
            header('Location: index.php?c=Universidad&a=v_Actualizar&idUniversidad='. $universidad->__GET('idUniversidad'));
            echo 'No se Ha Podido Actualizar';
        }else{
            echo 'Actualizado Correctamente';
            header('Location: index.php?c=Universidad');
         }
    }
    


    public function Registrar(){
        
        $universidad = new Universidad();
        $nrouniversidad = $this->model->Consultar_persona_dia($_REQUEST['fecha_ingreso']);
        $date=date_create($_REQUEST['fecha_ingreso']);
        $cod_fecha=date_format($date,'ymd');
        if(strlen($nrouniversidad)==1){
            $cod_dia="0".$nrouniversidad;
        }else{
            $cod_dia=$nrouniversidad;
        }

        $codigo=$cod_fecha.$cod_dia;
        $universidad->__SET('codigo',$_REQUEST['codigo']);
        $universidad->__SET('nombre',$_REQUEST['nombre']);
        $universidad->__SET('direccion',$_REQUEST['direccion']);
        $universidad->__SET('licenciado',$_REQUEST['licenciado']);
        $universidad->__SET('dni',$_REQUEST['dni']);
        $universidad->__SET('codigo',$codigo);
        $universidad->__SET('celular',$_REQUEST['celular']);
        $universidad->__SET('fecha_ingreso',$_REQUEST['fecha_ingreso']);
        $universidad->__SET('cantidad_carreras',$_REQUEST['cantidad_carreras']);
        $universidad->__SET('sexo',$_REQUEST['sexo']);
        $universidad->__SET('tipo_horario',$_REQUEST['tipo_horario']);
        $universidad->__SET('horario_entrada',$_REQUEST['horario_entrada']);
        $universidad->__SET('horario_salida',$_REQUEST['horario_salida']);
        $universidad->__SET('correo',$_REQUEST['correo']);
        //$universidad->__SET('foto',$_REQUEST['foto']);

        $universidad->__SET('ingresado_por',$_SESSION['Usuario_Actual']);    
        /*Validar Documento / Si no existe Registrar / Mostrar un mensaje que indique que el dni ya fue registrado*/
        $registrar_persona = $this->model->Registrar($universidad);  
         //echo $registrar_persona;
        if($registrar_persona=='error'){
            header('Location: index.php?c=Universidad&a=v_Registrar');
            echo 'No se Ha Podido Registrar';
         }else{
            echo 'Registrado Correctamente';
            header('Location: index.php?c=Universidad');
         }
    }

    public function Eliminar(){
        $universidad = new Universidad();
        $universidad->__SET('idUniversidad',$_REQUEST['idUniversidad']);      
        $universidad->__SET('modificado_por',$_SESSION['Usuario_Actual']);
        $universidad->__SET('eliminado',1); 
        $eliminar_persona = $this->model->Eliminar($universidad);  
         
        if($eliminar_persona=='error'){
            echo 'No se Ha Podido Eliminar la Universidad';
            header('Location: index.php?c=Universidad');            
        }else{
            echo 'Origen Eliminado Correctamente';
            header('Location: index.php?c=Universidad');
        }
    }


    public function redirect($url)
    {
        header("Location: $url");
    }   

}