<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$codigo = $_POST["codigo_de_concierto"];
$fecha = $_POST["fecha"];
$costo_de_realizacion = $_POST["costo_de_realizacion"];

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `concierto`(`codigo_de_concierto`,`fecha`, `costo_de_realizacion`) VALUES ('$codigo', '$fecha', '$costo_de_realizacion')";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: reparacion.php");
else:
	echo "Ha ocurrido un error al crear la persona";
endif;

mysqli_close($conn);