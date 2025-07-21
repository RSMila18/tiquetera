<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Consulta 1</h1>

<p class="mt-3">
    Se muestran los datos de los tres conciertos de mayor costo de realización que no tienen 
    supervisor asignado. Para cada uno de estos conciertos, se muestran los datos del 
    proponente del concierto.
</p>

<?php
// Crear conexión con la BD
require('../config/conexion.php');

// Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
$query = 
"SELECT 
c.codigo_de_concierto, c.costo_de_realizacion,
s.numero_de_identificacion, s.nombre, s.tipo_de_persona
FROM concierto c
JOIN solicitante s ON c.id_proponente = s.numero_de_identificacion
WHERE c.id_supervisor IS NULL
ORDER BY c.costo_de_realizacion DESC
LIMIT 3";

// Ejecutar la consulta
$resultadoC1 = mysqli_query($conn, $query) or die(mysqli_error($conn));

mysqli_close($conn);
?>

<?php
// Verificar si llegan datos
if($resultadoC1 and $resultadoC1->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th class="text-center">Codigo del concierto</th>
                <th class="text-center">Costo de realización</th>
                <th class="text-center">Id. del solicitante</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Tipo de persona</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoC1 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["codigo_de_concierto"]; ?></td>
                <td class="text-center"><?= $fila["costo_de_realizacion"]; ?></td>
                <td class="text-center"><?= $fila["numero_de_identificacion"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["tipo_de_persona"]; ?></td>
            </tr>

            <?php
            // Cerrar los estructuras de control
            endforeach;
            ?>

        </tbody>

    </table>
</div>

<!-- Mensaje de error si no hay resultados -->
<?php
else:
?>

<div class="alert alert-danger text-center mt-5">
    No se encontraron resultados para esta consulta
</div>

<?php
endif;

include "../includes/footer.php";
?>