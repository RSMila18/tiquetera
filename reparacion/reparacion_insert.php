<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$codigo = $_POST["codigo_de_concierto"];
$fecha = $_POST["fecha_de_presentacion"];
$costo_de_realizacion = $_POST["costo_de_realizacion"];
// Verificar si el campo de id_supervisor está vacío y asignar NULL si es necesario
$id_proponete = $_POST["id_proponente"];
if (isset($_POST["id_supervisor"]) && $_POST["id_supervisor"] !== "") {
    $id_supervisor = $_POST["id_supervisor"];
} else {
    $id_supervisor = "NULL";
}

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `concierto`(`codigo_de_concierto`,`fecha_de_presentacion`, `costo_de_realizacion`, `id_proponente`, `id_supervisor`) VALUES ($codigo, '$fecha_de_presentacion', $costo_de_realizacion, $id_proponete, $id_supervisor)";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: reparacion.php");
else:
	echo "Ha ocurrido un error al crear el concierto";
endif;

mysqli_close($conn);