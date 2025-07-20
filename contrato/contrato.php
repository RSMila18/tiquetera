<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a CONTRATO (CONTRATO)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="contrato_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="numero_de_contrato" class="form-label">Numero de contrato</label>
            <input type="number" class="form-control" id="numero_de_contrato" name="numero_de_contrato" required>
        </div>

        <div class="mb-3">
            <label for="monto_acordado" class="form-label">Monto acordado</label>
            <input type="number" class="form-control" id="monto_acordado" name="monto_acordado" required>
        </div>

        <div class="mb-3">
            <label for="fecha_de_firma" class="form-label">Fecha de firma</label>
            <input type="date" class="form-control" id="fecha_de_firma" name="fecha_de_firma" required>
        </div>

        <div class="mb-3">
            <label for="fecha_de_presentacion" class="form-label">Fecha de presentacion</label>
            <input type="date" class="form-control" id="fecha_de_presentacion" name="fecha_de_presentacion" required>
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
                <th scope="col" class="text-center">Numero de contrato</th>
                <th scope="col" class="text-center">Monto acordado</th>
                <th scope="col" class="text-center">Fecha de firma</th>
                <th scope="col" class="text-center">Fecha de presentacion</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoEmpresa as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["numero_de_contrato"]; ?></td>
                <td class="text-center"><?= $fila["monto_acordado"]; ?></td>
                <td class="text-center">$<?= $fila["fecha_de_firma"]; ?></td>
                <td class="text-center">C.C. <?= $fila["fecha_de_presentacion"]; ?></td>
                
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