<!DOCTYPE html>
<html ng-app="acumuladorApp"><!--Hay que observar que aquí se inicia el ng-app-->
<head>
    <title>Ej de AngularJS</title>
    <script src="js/angular.min.js"></script>
</head>
<body>
    
    <div ng-controller="acumuladorAppCtrl"><!--Super importante el controlador aquí-->
        
        <!-- Aquí se afecta desde el inicio el valor del texto -->
        <!-- <input type="text" ng-model="datos=0" ng-change="cargar_datos()"> -->
        <!-- <input type="text" ng-model="datos.texto1" ng-change="cargar_datos()"> 
        <br> -->
        <?php echo $obj_o->traer_lista_informacion( "sintomas[] ", "tb_signos_y_sintomas","id_signos", "signos_y_sintomas"); ?>

        <!--<input type="text" ng-model="datos.texto2" ng-change="cargar_datos_php()" placeholder="Ingrese el id de un signo" class="form-control"> 
        <br>-->

        <!-- El controlador afecta todo lo del div contenedor ng-controller, pero eso no significa que los
        estilos convencionales no funcionen normalmente. Este estilo debería estar en un *.css -->
        <br>
        <label>Diagn&oacute;stico:</label>
        <br>
            <!--{{informacion}}-->
            
        <div ng-repeat="x in campos">
        

        
            <table class="table">
                <tr> 
               
                    <th>Enfermedad:</th>
                    <th>Sintomas Encontrados:</th>
                    <th>Sintomas en total</th>
                </tr> 
             
                <tr>
                    <td>{{ x.Enfermedad }}</td>  
                    <td>{{ x.conteo_sintomas }}</td>   
                    <td>{{ x.conteo_total }}</td> 
                </tr>   
                
              

            </table> 
            {{ x.a }}

        </div> 
       
       
        
        <br>
        
        <!-- Si lo digitado en el text input es un nombre de archivo jpg, se cargará la imagen. -->
        <!--<img src="{{imagen}}">-->
        
        <br>
        
        <!-- Esto es importante para que se escriban los resultados como un ciclo dependiendo de la info php MySQL -->


    </div>
    
    <!-- Aquí se incluye el otro archivo js par probar que el código se puede colocar en otro archivo  -->
    <script src="js/ayudante.js"></script>
    
    <script>
        
        var acumuladorApp = angular.module( 'acumuladorApp', [] );
        
        acumuladorApp.controller( "acumuladorAppCtrl",
            
            //[ "$scope",  //Originalmente solo se minificaba el scope.
            [ "$scope", "$http", //Esto es para minificar, pero interfiere con lo de php, hay que minificar las otras variables.
             
                function( $scope, $http )
                {
                    //Lo que aparece allá puede ser editado desde el exterior, como un cargue inicial.
                    $scope.informacion = "Aquí se inicializa información.";
                    $scope.imagen  = "imagenes/1.jpg";
                    $scope.letra = 20;
                    
                    /**
                     * El evento del texto es afectado por esta función, que en resumen actua al cambio instantaneo.
                     */
                    $scope.cargar_datos = function()
                    {
                        var cad = $scope.datos.texto1;
                        var cad2 = $scope.datos.texto2;
                        var vector;
                        
                        if( cad2.length <= 0 ) cad2 = "Texto 2 vacío ";
                        
                        if( cad != "" ) //Para realizar operaciones se revisa que la cadena digitada no sea vacía.
                        {                                                        
                            //Si la cadena digitada representa una imagen, la imagen se cargará.
                            if( cad.indexOf( ".jpg" ) >= 0 ){ $scope.imagen = "imagenes/" + cad; }
                            else{ $scope.imagen  = "imagenes/1.jpg"; } 
                            
                            //Afectamos el tamaño de letra.
                            if( cad.length > 10 ) $scope.letra = cad.length; 
                            
                            //Esta función proviene de otro archivo js. El vector se encarga de definir parámetros.
                            cad = validar_campo( cad, [ 4, 25 ], retornar_palabras_prohibidas() );
                            
                            //Esto sería equivalente al return.
                            $scope.informacion =  cad2 + cad;
                        }
                    };
                    
                    /**
                     * Esta función se activa al usar el texto 2.
                     */
                    $scope.cargar_datos_php = function()
                    {
                            var lista= document.getElementById('datos');
                            console.log(lista.length );
                            var sintomas="";


                            for (var i = 0 ; i < lista.length ; i++) 
                            {
                                if (lista.item(i).selected ) {
                                    if (sintomas == ""){ 
                                        sintomas +=lista.item(i).value;
                                    }else{
                                        sintomas +="," +lista.item(i).value;
                                    }
                                }
                            }
                        var cad2 = sintomas;
                        console.log(cad2);
                        
                        if( cad2.length > 0 )
                        {
                            console.log("Cadena" + cad2);
                            //Aquí se hace el llamado a un php con conexión a MySQL.
                            $http.get( 'llamado-php.php?cadena=' + cad2 ).success
                            (
                                function( response ) 
                                { 
                                    console.log( response );
                                    $scope.campos = response.records;            
                                }
                            );   
                        }                    
                    }
                }
            ] //Si se minifica, se deben minificar todas las llamadas inyecciones, de lo contrario mejor no minifique nada.
        );

        
        
    </script>


</body>
</html>
