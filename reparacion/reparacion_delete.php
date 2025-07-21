<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar la CP de la entidad
$codigoEliminar = $_POST["codigoEliminar"];

// Query SQL a la BD
$query = "DELETE FROM concierto WHERE codigo_de_concierto = $codigoEliminar";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

if($result): 
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
    header ("Location: reparacion.php");
else:
    echo "Ha ocurrido un error al eliminar este concierto";
endif;
 
mysqli_close($conn);