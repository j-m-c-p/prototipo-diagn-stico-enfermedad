/**
 * Retorna un vector con palabras cuyo uso para esta pr�ctica es representar t�rminos prohibidos.
 * Claro que esto para la pr�ctica, los datos deber�an provenir de una base de datos.
 * @returns         array           retorna un vector de palabras prohibidas.
 */
function retornar_palabras_prohibidas()
{
    var arreglo = [];
    
    arreglo.push( "groseria" );
    arreglo.push( "huevo" );
    arreglo.push( "maraca" );
    
    return arreglo;
}

/**
 * Esta funci�n se encarga simplemente de retornar algo adicional a una cadena que le ingresen.
 * Fu� concebida para comprobar que llamar una funci�n de este javascript se puede usar en el original o segmento del archivo html.
 * @param       string          Es una cadena ingresada, sin �nimo de operar sobre ella.
 * @returns     string          Cadena un resultado o texto adicional.
 */
function retornar_algo( cad )
{
    return cad + " End line.";
}

/**
 * Esta funci�n se encarga de validar un campo, o informar de las condiciones de un campo.
 * @param       string          cadena del usuario.
 * @param       array           vector que me permite desde el html enviar diferentes cosas.
 * @returns     string          informe con condiciones de la informaci�n
 */
function validar_campo( cad, vector, v_palabras_prohibidas )
{
    var resultado = "";
    var i = 0;
        
    resultado += "Longitud de la cadena: " + cad.length + " ";
    resultado += "Si la cadena requiere validar una longitud, este ser�a un buen c�digo a usar. ";
    
    if( cad.length < vector[ 0 ] ) resultado += "La cadena no supera la longitud suministrada.  ";
    if( cad.length > vector[ 1 ] ) resultado += "La cadena supera la longitud suministrada.  ";
    
    for( i = 0; i < v_palabras_prohibidas.length; i ++ )
    {
        if( cad.indexOf( v_palabras_prohibidas[ i ] + "" ) >= 0 )
        resultado += "Hemos encontrado una palabra prohibida. [" + v_palabras_prohibidas[ i ] + "] ";
    }
    
    return resultado; 
}
