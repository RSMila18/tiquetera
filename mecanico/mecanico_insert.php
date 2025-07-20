<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$numero_de_identificacion = $_POST["numero_de_identificacion"];
$nombre = $_POST["nombre"];
$tipo_de_persona = $_POST["tipo_de_persona"];
if (isset($_POST["numero_de_contrato"]) && $_POST["numero_de_contrato"] !== "") {
	$numero_de_contrato= $_POST["numero_de_contrato"];
} else {
    $numero_de_contrato = "NULL";
}

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `solicitante`(`numero_de_identificacion`,`nombre`, `tipo_de_persona`, `numero_de_contrato`) VALUES ($numero_de_identificacion, '$nombre', '$tipo_de_persona', $numero_de_contrato)";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: mecanico.php");
else:
	echo "Ha ocurrido un error al crear la persona";
endif;

mysqli_close($conn);