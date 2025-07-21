<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Búsqueda 1</h1>

<p class="mt-3">
    Dado el código de un contrato, se muestran todos los conciertos supervisados por el solicitante 
    asociado a dicho contrato, siempre y cuando la fecha del concierto esté por fuera del intervalo
    de fechas del contrato.

</p>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <!-- En esta caso, el Action va a esta mismo archivo -->
    <form action="busqueda1.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="numero_de_contrato" class="form-label">Número de contrato</label>
            <input type="number" class="form-control" id="numero_de_contrato" name="numero_de_contrato" required>
        </div>

        <button type="submit" class="btn btn-primary">Buscar</button>

    </form>
    
</div>

<?php
// Dado que el action apunta a este mismo archivo, hay que hacer eata verificación antes
if ($_SERVER['REQUEST_METHOD'] === 'POST'):

    // Crear conexión con la BD
    require('../config/conexion.php');

    $numero_de_contrato = $_POST["numero_de_contrato"];

    // Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
    $query =
    "SELECT c.*
    FROM concierto c
    JOIN solicitante s ON c.id_supervisor = s.numero_de_identificacion
    JOIN contrato ct ON s.numero_contrato = ct.numero_de_contrato
    WHERE ct.numero_de_contrato = $numero_de_contrato AND (
    c.fecha_de_presentacion < ct.fecha_de_inicio OR c.fecha_de_presentacion > ct.fecha_de_finalizacion
    )";

    // Ejecutar la consulta
    $resultadoB1 = mysqli_query($conn, $query) or die(mysqli_error($conn));

    mysqli_close($conn);

    // Verificar si llegan datos
    if($resultadoB1 and $resultadoB1->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código de concierto</th>
                <th scope="col" class="text-center">Fecha de presentación</th>
                <th scope="col" class="text-center">Costo de realización</th>
                <th scope="col" class="text-center">Id. del proponente</th>
                <th scope="col" class="text-center">Id. del supervisor</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoB1 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["codigo_de_concierto"]; ?></td>
                <td class="text-center"><?= $fila["fecha_de_presentacion"]; ?></td>
                <td class="text-center"><?= $fila["costo_de_realizacion"]; ?></td>
                <td class="text-center"><?= $fila["id_proponente"]; ?></td>
                <td class="text-center"><?= $fila["id_supervisor"]; ?></td>
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