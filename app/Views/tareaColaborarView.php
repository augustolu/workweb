<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Detalles de la Tarea</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f2f5f8;
            color: #333;
            padding: 2rem;
            margin: 0;
        }

        h1, h2, h3, h4 {
            color: #333;
            margin-left: 80px;

        }

        .card {
            background-color: #ffffff;
            border-left: 6px solid #4A90E2;
            border-radius: 12px;
            margin-left: 80px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }

        .subtarea-card {
            border-left: 5px solid #888;
            border-radius: 10px;
            padding: 15px;
            margin: 1rem 0;
            margin-left: 80px;
            background-color: #fdfdfd;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            font-size: 0.85rem;
            font-weight: 500;
            background-color: #dee2e6;
            border-radius: 6px;
            color: #444;
        }

        .form-check {
            margin-right: 15px;
        }

        .form-check-input {
            margin-right: 5px;
        }

        .list-group-item {
            background-color: #fff;
            padding: 0.5rem 1rem;
            border: none;
            border-bottom: 1px solid #eaeaea;
        }

        ul {
            padding-left: 1.2rem;
        }

        button, .btn {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-primary {
            background-color: #007BFF;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        /* Estilos para los modales */
        #modalAgregarResponsable, #modalInvitarCorreo {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
        }

        #modalAgregarResponsable > div,
        #modalInvitarCorreo > div {
            background-color: #fff;
            max-width: 400px;
            margin: 10% auto;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        input[type="email"], select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-top: 0.5rem;
        }
        .btn-volver {
        --color: #007BFF;
        font-family: inherit;
        display: inline-block;
        width: 10em;
        height: 2.8em;
        line-height: 2.7em;
        margin: 20px;
        position: relative;
        cursor: pointer;
        overflow: hidden;
        border: 2px solid var(--color);
        transition: color 0.5s ease;
        z-index: 1;
        font-size: 17px;
        border-radius: 8px;
        font-weight: 600;
        color: var(--color);
        background-color: transparent;
        box-shadow: 0 4px 14px rgba(0, 123, 255, 0.15);
        text-align: center;
        text-decoration: none;
        }

        .btn-volver::before {
        content: "";
        position: absolute;
        z-index: -1;
        background: var(--color);
        height: 200px;
        width: 200px;
        border-radius: 50%;
        top: 100%;
        left: 100%;
        transition: all 0.6s ease;
        }

        .btn-volver:hover {
        color: #fff;
        }

        .btn-volver:hover::before {
        top: -40px;
        left: -40px;
        }

        .btn-volver:active::before {
        background: #0056b3;
        transition: background 0s;
        }



    </style>
</head>
<body>
<a href="javascript:history.back()" class="btn-volver">Volver atrás</a>

    <h1>Detalles de la Tarea</h1>

    <?php
function obtenerColoresTarea($colorNombre)
{
    switch (strtolower($colorNombre)) {
        case 'rojo':
            return ['#FF6B6B', '#FFECEC'];
        case 'azul':
            return ['#1E90FF', '#E6F0FF'];
        case 'verde':
            return ['#28A745', '#E9F7EF'];
        case 'naranja':
            return ['#FFA600', '#FFF3E0'];
        case 'celeste':
            return ['#00C1FF', '#E0F7FF'];
        case 'gris':
            return ['#6C757D', '#F0F0F0'];
        case 'violeta':
            return ['#8A2BE2', '#F3E8FF'];
        default:
            return ['#CCCCCC', '#F9F9F9'];
    }
}
?>

    <?php if (!empty($tarea)): ?>
        <div class="card" style="border-left-color: <?= esc($tarea['color']) ?>; background-color: <?= esc($tarea['color']) ?>22;">
            <h2><?= esc($tarea['titulo']) ?></h2>
            <p><?= esc($tarea['descripcion']) ?></p>
            <p><strong>Estado:</strong> <?= esc($tarea['estado']) ?></p>
            <p><strong>Prioridad:</strong> <span class="badge"><?= esc($tarea['prioridad']) ?></span></p>
            <p><strong>Fecha de vencimiento:</strong> <?= esc($tarea['fecha_vencimiento']) ?></p>
            <?php if ($tarea['fecha_recordatorio']): ?>
                <p><strong>Recordatorio:</strong> <?= esc($tarea['fecha_recordatorio']) ?></p>
            <?php endif; ?>
            <?php if (!empty($colaboradores_disponibles)): ?>
    <div style="margin-top: 1rem; background-color: #f0f0f0; padding: 1rem; border-radius: 6px;">
        <h4>Colaboradores disponibles (<?= count($colaboradores_disponibles) ?>)</h4>
        <ul>
            <?php foreach ($colaboradores_disponibles as $colab): ?>
                <li><?= esc($colab['nombre']) ?> - <?= esc($colab['correo']) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

        </div>
        
    <?php else: ?>
        <p>No se encontró la tarea.</p>
    <?php endif; ?>

    <h2>Subtareas</h2>

<?php if (!empty($subtareas)): ?>
    <?php foreach ($subtareas as $sub): ?>
        <?php [$borde, $fondo] = obtenerColoresTarea($sub['color']); ?>
        <div class="subtarea-card" style="border-left: 4px solid <?= $borde ?>; background-color: <?= $fondo ?>; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem;">
            <h4 style="margin-bottom: 0.5rem;"><?= esc($sub['titulo']) ?></h4>
            <p><?= esc($sub['descripcion']) ?></p>
            <p><strong>Estado:</strong> <?= esc($sub['estado']) ?></p>
            <p><strong>Prioridad:</strong> <span class="badge bg-secondary"><?= esc($sub['prioridad']) ?></span></p>
            <p><strong>Fecha de vencimiento:</strong> <?= esc($sub['fecha_vencimiento']) ?></p>

            <?php if ($sub['fecha_recordatorio']): ?>
                <p><strong>Recordatorio:</strong> <?= esc($sub['fecha_recordatorio']) ?></p>
            <?php endif; ?>

            <?php if (!empty($sub['responsables'])): ?>
                <p><strong>Responsables:</strong></p>
                <ul class="list-group mb-2">
                    <?php foreach ($sub['responsables'] as $usuario): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><?= esc($usuario['nombre']) ?> (<?= esc($usuario['correo']) ?>)</span>

                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p><em>Sin responsables asignados.</em></p>
            <?php endif; ?>


            <?php
    $esResponsable = false;
    foreach ($sub['responsables'] as $usuario) {
        if ($usuario['correo'] === $correo_usuario_logueado) {
            $esResponsable = true;
            break;
            }
            }
            ?>

            <?php if ($esResponsable): ?>
            <p><strong>Acciones de responsable:</strong></p>
           <form action="<?= site_url('/subtareas/cambiarEstado') ?>" method="post" class="d-flex gap-2" onChange="this.submit();">
    <?= csrf_field() ?>
    <input type="hidden" name="subtarea_id" value="<?= esc($sub['id']) ?>">
    <input type="hidden" name="tarea_id" value="<?= esc($idTarea ?? '') ?>">

    

    <div class="form-check">
        <input class="form-check-input" type="radio" name="estado" id="estado_<?= $sub['id'] ?>_en_proceso" value="en_proceso"
            <?= $sub['estado'] === 'en_proceso' ? 'checked' : '' ?>>
        <label class="form-check-label" for="estado_<?= $sub['id'] ?>_en_proceso">En Proceso</label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="estado" id="estado_<?= $sub['id'] ?>_completada" value="completada"
            <?= $sub['estado'] === 'completada' ? 'checked' : '' ?>>
        <label class="form-check-label" for="estado_<?= $sub['id'] ?>_completada">Completada</label>
    </div>
</form>
<?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No hay subtareas registradas para esta tarea.</p>
<?php endif; ?>



<div id="modalAgregarResponsable" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color: rgba(0,0,0,0.5); z-index:1000;">
    <div style="background:white; max-width:400px; margin:10% auto; padding:20px; border-radius:10px; position:relative;">
        <h3>Agregar responsable</h3>
        <form action="<?= base_url('subtarea/agregarResponsable') ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="subtarea_id" id="modalSubtareaId">
            <input type="hidden" name="tarea_id" value="<?= esc($tarea['id']) ?>">
            <label for="usuario_id">Seleccionar colaborador:</label>
            <select name="usuario_id" id="usuario_id" required>
                <?php foreach ($colaboradores_disponibles as $colab): ?>
                    <option value="<?= esc($colab['id']) ?>"><?= esc($colab['nombre']) ?> (<?= esc($colab['correo']) ?>)</option>
                <?php endforeach; ?>
            </select>

            <div style="margin-top:1rem;">
                <button type="submit" class="btn btn-primary">Asignar</button>
                <button type="button" class="btn btn-secondary" onclick="cerrarModal()">Cancelar</button>
            </div>
        </form>
    </div>
</div>


<div id="modalInvitarCorreo" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color: rgba(0,0,0,0.5); z-index:1000;">
    <div style="background:white; max-width:400px; margin:10% auto; padding:20px; border-radius:10px; position:relative;">
        <h3>Invitar colaborador por correo</h3>
        <form action="<?= base_url('tarea/enviarCorreo') ?>" method="post">
            <?= csrf_field() ?>
            <label for="correo">Correo Gmail del colaborador:</label>
            <input type="email" name="correo" id="correo" placeholder="ejemplo@gmail.com" required style="width: 100%; margin-top: 0.5rem; padding: 0.5rem;">
            <input type="hidden" name="tarea_id" value="<?= esc($tarea['id']) ?>">

            <div style="margin-top:1rem;">
                <button type="submit" class="btn btn-primary">Enviar invitación</button>
                <button type="button" class="btn btn-secondary" onclick="cerrarModalInvitar()">Cancelar</button>
            </div>
        </form>
    </div>
</div>









<script>
function abrirModal(subtareaId) {
    document.getElementById('modalSubtareaId').value = subtareaId;
    document.getElementById('modalAgregarResponsable').style.display = 'block';
}

function cerrarModal() {
    document.getElementById('modalAgregarResponsable').style.display = 'none';
}

function mostrarModalInvitar() {
    document.getElementById('modalInvitarCorreo').style.display = 'block';
}

function cerrarModalInvitar() {
    document.getElementById('modalInvitarCorreo').style.display = 'none';
}
</script>

</body>
</html>
