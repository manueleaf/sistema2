 <!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Modulo Administracion
	</h1>
	<ol class="breadcrumb">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>           
	    <li class="active">Universidades</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			<h3 class='box-title'><i class="fa fa-briefcase"></i> Lista de universidads</h3> 
	      			<a class="btn btn-sm btn-primary pull-right" href="?c=universidad&a=v_Registrar"> Nueva universidad</a>
	    		</div>
	    		<div class="box-body box-body_table">
	    		 <?php  $universidades = $this->Listar();  ?>
                  	<table id="TablaEntidad" class="table table-bordered table-hover dataTable no-footer" width="100%">
	                    <thead>
	                      	<tr>                      
		                    	<th>ID</th>                    
			                    <th style="vertical-align: middle;">Codigo</th>
			                    <th style="vertical-align: middle;">Nombre</th>
			                    <th style="vertical-align: middle;">Direccion</th>
			                    <th style="vertical-align: middle;">Licenciado</th>
			                  
			                    <th style="vertical-align: middle;">Cantidad de carreras</th>
			                    <th style="vertical-align: middle;">Estado</th>
			                    <th style="vertical-align: middle;">Acciones</th>
	                     	</tr>
	                    </thead>
	                    <tbody>
	                    	<?php foreach ($universidades as $universidad): ?>
	                    	<tr>
	                    		<td><?php echo $universidad['idUniversidad']; ?></td>
	                    		<td><?php echo $universidad['codigo']; ?></td>
	                    		<td><?php echo $universidad['nombre']; ?></td>
	                    		<td><?php echo $universidad['direccion']; ?></td>
	                    		<td><?php echo $universidad['licenciado']; ?></td>
	                    		<td><?php echo $universidad['cantidad_carreras']; ?></td>
	                    		<?php if ($universidad['activo']==1): ?>
                                <td class=""><span class="label label-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Activo</span></td>
                                <?php else: ?>
                                <td class=""><span class="label label-danger"><i class="fa fa-square-o" aria-hidden="true"></i> Inactivo</span></td>
                                <?php endif ?>
                            	<td class="a_center">                            		
                            		<a href="?c=universidad&a=v_Actualizar&iduniversidad=<?php echo $universidad['iduniversidad']; ?>" class="btn btn-primary btn-xs " data-toggle="tooltip" data-placement="top" title="Actualizar">
                                   		<i class="fa fa-pencil"></i>   
                               		</a>
                               		<a class="btn btn-danger btn-xs Eliminaruniversidad" data-id="<?php echo $universidad['iduniversidad']; ?>" data-universidad="<?php echo $universidad['apellido_paterno'].' '.$universidad['apellido_materno'].' '.$universidad['primer_nombre'].' '.$universidad['segundo_nombre']; ?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                   		<i class="fa fa-trash"></i>   
                               		</a>

                               	</td>
	                    	</tr>
	                    	<?php endforeach; ?>
	                    </tbody>
                	</table>                    
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<!-- /. Ventana Modal Foto de Perfil-->

<!-- /.Ventana Modal Foto de Perfil -->
<script>
	
	$(document).ready(function() {
		$(".Eliminaruniversidad").click(function(event) {
			iduniversidad=$(this).attr('data-id');
			bootbox.dialog({
            message: "¿Estas seguro de eliminar a <b>"+$(this).attr('data-universidad')+"</b>?",
            title: "Eliminar universidad",
            buttons: {
                main: {
                    label: "Eliminar",
                    className: "btn-primary",
                    callback: function() {
                        //console.log('Eliminado al usuario');
                        window.location.href = "?c=universidad&a=Eliminar&iduniversidad="+iduniversidad;
                    }
                },
                danger: {
                    label: "Cancelar",
                    className: "btn-danger",
                    callback: function() {
                        bootbox.hideAll();
                    }
                }
            }
        });
		});
	});


</script>

