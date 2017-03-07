	
<?php
/**
* 
* @versión: 1.0 
* @modificado: 23 de febrero del 2017 
* @autores: Jhonnatan cubides, Harley santoyo
*/





/**
*Esta clase contiene todas la funciones  
*/

class Lista 
{

			/**
			*esta función sirve para mostrar el formulario el cual contiene *un select que trae los datos de una tabla
			* @param 	texto  		parametro de entrada que contiene $nombre_lista
			*@param 	texto 		parametro de entrada que contiene tabla
			*@param 	texto 		parametro de entrada que contiene campo_llave_primaria
			*@param 	texto 		parametro de entrada que contiene $campos_a_mostrar
			*/
			function traer_lista_informacion( $nombre_lista, $tabla, $campo_llave_primaria, $campo_a_mostrar ) 
			{	//Se hace la conexión con la base de datos
				include( "config.php" ); 
				$salida = "";

				//------------SQL Se traen datos----------------------------------------------------
				//Selecciona todos los campos de una tabla
				$sql = "SELECT * FROM  $tabla "; 
				
				

				$conexion = mysqli_connect( $servidor, $usuario, $clave, $bd );
				$resultado = $conexion->query( $sql );

						
						
						//$salida.="<form  action='ver.php' method='post'>
						            //<div class='form-group' >
						           
						$salida.="<label for='exampleInputEmail1'>Sintomas  </label><BR>";
						$salida.="<select ng-model='id_sintomas' ng-change='cargar_datos_php()' id='datos' multiple size=10 class='form-control' name='$nombre_lista' >";
						$contador=0;
						
				while ($fila = mysqli_fetch_assoc($resultado)) 
					
				{ 
					$contador ++;
					
		    		if ($fila != '..' && $fila !='.' && $fila !=''){
		                //echo" $fila;
		         	$salida.= "<option value='$fila[$campo_llave_primaria]' >" . $contador . " - ". $fila[$campo_a_mostrar]."</option>"; //Se muestra en un select los datos que contien una tabla
		        }
		      
				}
				$salida.="</select>";	//cierra la etiqueta 
				//$salida.="</div>


						       
						        //<button type='submit' class='btn btn-success'>Analizar</button>";
						       
						      //</form>";

				
		 		
			

				//retorna todo lo que contiene la variable $salida 

				return $salida;	
			}

	
			/**
			*esta función sirve para mostrar el formulario el cual contiene *un select que trae los datos de una tabla
			* @param 	text  		parametro de entra que contiene 4 datos
			*@param 	texto 		parametro de salida de datos
			*/


			

}
	


 ?>
