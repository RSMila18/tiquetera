<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a MECANICO (SOLICITANTE)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="mecanico_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="numero_de_identificacion" class="form-label">Número de identificación</label>
            <input type="number" class="form-control" id="numero_de_identificacion" name="numero_de_identificacion" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="tipo_de_persona" class="form-label">Tipo de persona</label>
            <input type="text" class="form-control" id="tipo_de_persona" name="tipo_de_persona" required>
        </div>

        <!-- Consultar la lista de contratos y desplegarlos -->
        <div class="mb-3">
            <label for="contrato" class="form-label">Contratos</label>
            <select name="contrato" id="contrato" class="form-select">
                
                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../contrato/contrato_select.php");
                
                // Verificar si llegan datos
                if($resultadoContrato):
                    
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoContrato as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["numero_de_contrato"]; ?>"> <?= $fila["numero_de_contrato"]; ?></option>

                <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>
    
</div>

<?php
// Importar el código del otro archivo
require("mecanico_select.php");

// Verificar si llegan datos
if($resultadoMecanico and $resultadoMecanico->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Número de identificación</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Tipo de persona</th>
                <th scope="col" class="text-center">Número de contrato</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoMecanico as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["numero_de_identificacion"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["tipo_de_persona"]; ?></td>
                <td class="text-center"><?= $fila["numero_de_contrato"]; ?></td>

                <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                <td class="text-center">
                    <form action="mecanico_delete.php" method="post">
                        <input hidden type="text" name="idEliminar" value="<?= $fila["numero_de_identificacion"]; ?>">
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