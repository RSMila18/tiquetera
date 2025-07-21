<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Búsqueda 2</h1>

<p class="mt-3">
    Dado el código de un concierto, se muestran todos los datos del contrato asociado al solicitante
    que propuso dicho concierto.

</p>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <!-- En esta caso, el Action va a esta mismo archivo -->
    <form action="busqueda2.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigo_de_concierto" class="form-label">Código de concierto</label>
            <input type="number" class="form-control" id="codigo_de_concierto" name="codigo_de_concierto" required>
        </div>

        <button type="submit" class="btn btn-primary">Buscar</button>

    </form>
    
</div>

<?php
// Dado que el action apunta a este mismo archivo, hay que hacer eata verificación antes
if ($_SERVER['REQUEST_METHOD'] === 'POST'):

    // Crear conexión con la BD
    require('../config/conexion.php');

    $codigo_de_concierto = $_POST["codigo_de_concierto"];

    // Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
    $query = 
    "SELECT ct.*
    FROM contrato ct
    JOIN solicitante s ON ct.numero_de_contrato = s.numero_contrato
    JOIN concierto c ON s.numero_de_identificacion = c.id_proponente
    WHERE c.codigo_de_concierto = $codigo_de_concierto";

    // Ejecutar la consulta
    $resultadoB2 = mysqli_query($conn, $query) or die(mysqli_error($conn));

    mysqli_close($conn);

    // Verificar si llegan datos
    if($resultadoB2 and $resultadoB2->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Número de contrato</th>
                <th scope="col" class="text-center">Monto acordado</th>
                <th scope="col" class="text-center">Fecha de inicio</th>
                <th scope="col" class="text-center">Fecha de finalización</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoB2 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["numero_de_contrato"]; ?></td>
                <td class="text-center"><?= $fila["monto_acordado"]; ?></td>
                <td class="text-center"><?= $fila["fecha_de_inicio"]; ?></td>
                <td class="text-center"><?= $fila["fecha_de_finalizacion"]; ?></td>
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
    No se encontraron resultados para esta busqueda.
</div>

<?php
    endif;
endif;

include "../includes/footer.php";
?>