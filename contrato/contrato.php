<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a CONTRATO (CONTRATO)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="contrato_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="numero_de_contrato" class="form-label">Número de contrato</label>
            <input type="number" class="form-control" id="numero_de_contrato" name="numero_de_contrato" required>
        </div>

        <div class="mb-3">
            <label for="monto_acordado" class="form-label">Monto acordado</label>
            <input type="number" class="form-control" id="monto_acordado" name="monto_acordado" required>
        </div>

        <div class="mb-3">
            <label for="fecha_de_inicio" class="form-label">Fecha de inicio</label>
            <input type="date" class="form-control" id="fecha_de_inicio" name="fecha_de_inicio" required>
        </div>

        <div class="mb-3">
            <label for="fecha_de_finalizacion" class="form-label">Fecha de finalización</label>
            <input type="date" class="form-control" id="fecha_de_finalizacion" name="fecha_de_finalizacion" required>
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>
    
</div>

<?php
// Importar el código del otro archivo
require("contrato_select.php");

// Verificar si llegan datos
if($resultadoContrato and $resultadoContrato->num_rows > 0):
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
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoContrato as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["numero_de_contrato"]; ?></td>
                <td class="text-center">$<?= $fila["monto_acordado"]; ?></td>
                <td class="text-center"><?= $fila["fecha_de_inicio"]; ?></td>
                <td class="text-center"><?= $fila["fecha_de_finalizacion"]; ?></td>

                <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                <td class="text-center">
                    <form action="contrato_delete.php" method="post">
                        <input hidden type="text" name="ncEliminar" value="<?= $fila["numero_de_contrato"]; ?>">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>

            </tr>

            <?php
            // Cerrar los estructuras de control
            endforeach;
            ?>

        </tbody>

    </table>
</div>

<?php
endif;

include "../includes/footer.php";
?>