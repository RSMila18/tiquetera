<?php
include "../includes/header.php";

require("../mecanico/mecanico_select.php");

$resultadoProponente = $resultadoMecanico;
$resultadoSupervisor = $resultadoMecanico;
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a REPARACIÓN (CONCIERTO)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="reparacion_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigo_de_concierto" class="form-label">Código de concierto</label>
            <input type="number" class="form-control" id="codigo_de_concierto" name="codigo_de_concierto" required>
        </div>

        <div class="mb-3">
            <label for="fecha_de_presentacion" class="form-label">Fecha de presentación</label>
            <input type="date" class="form-control" id="fecha_de_presentacion" name="fecha_de_presentacion" required>
        </div>

        <div class="mb-3">
            <label for="costo_de_realizacion" class="form-label">Costo de realización</label>
            <input type="number" class="form-control" id="costo_de_realizacion" name="costo_de_realizacion" required>
        </div>

    
        <!-- Consultar la lista de solicitantes para el proponente y desplegarlos -->
        <div class="mb-3">
            <label for="id_proponente" class="form-label">Identificación del proponente</label>
            <select name="id_proponente" id="id_proponente" class="form-select" required>

                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php                
                // Verificar si llegan datos
                if($resultadoProponente):
                    
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoProponente as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["numero_de_identificacion"];?>"><?= $fila["numero_de_identificacion"]; ?> - <?= $fila["nombre"]; ?></option>

                <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>
        
        <!-- Consultar la lista de solicitantes para el supervisor y desplegarlos -->
        <div class="mb-3">
            <label for="id_supervisor" class="form-label">Identificación del supervisor</label>
            <select name="id_supervisor" id="id_supervisor" class="form-select">

                <!-- Option por defecto -->
                <option value=""></option>

                <?php                
                // Verificar si llegan datos
                if($resultadoSupervisor):

                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoSupervisor as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["numero_de_identificacion"];?>"><?= $fila["numero_de_identificacion"]; ?> - <?= $fila["nombre"]; ?></option>

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
require("reparacion_select.php");
            
// Verificar si llegan datos
if($resultadoReparacion and $resultadoReparacion->num_rows > 0):
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
                <th scope="col" class="text-center">Identificación del proponente</th>
                <th scope="col" class="text-center">Identificación del supervisor</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoReparacion as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["codigo_de_concierto"]; ?></td>
                <td class="text-center"><?= $fila["fecha_de_presentacion"]; ?></td>
                <td class="text-center">$<?= $fila["costo_de_realizacion"]; ?></td>
                <td class="text-center"><?= $fila["id_proponente"]; ?></td>
                <td class="text-center"><?= $fila["id_supervisor"]; ?></td>

                <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                <td class="text-center">
                    <form action="reparacion_delete.php" method="post">
                        <input hidden type="text" name="codigoEliminar" value="<?= $fila["codigo_de_concierto"]; ?>">
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