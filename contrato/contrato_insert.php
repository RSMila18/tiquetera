<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$numero_de_contrato = $_POST["numero_de_contrato"];
$monto_acordado = $_POST["monto_acordado"];
$fecha_de_inicio = $_POST["fecha_de_inicio"];
$fecha_de_finalizacion = $_POST["fecha_de_finalizacion"];

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `contrato`(`numero_de_contrato`,`monto_acordado`, `fecha_de_inicio`, `fecha_de_finalizacion`) VALUES ($numero_de_contrato, $monto_acordado, '$fecha_de_inicio', '$fecha_de_finalizacion')";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: contrato.php");
else:
	echo "Ha ocurrido un error al crear el contrato";
endif;

mysqli_close($conn);