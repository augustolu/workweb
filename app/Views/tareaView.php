<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (requerido para los modales) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

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
            padding: 20px;
            margin-bottom: 20px;
            margin-left: 80px;
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
        <h4>Colaboradores disponibles para asignar a subtareas (<?= count($colaboradores_disponibles) ?>)</h4>
        <ul>
            <?php foreach ($colaboradores_disponibles as $colab): ?>
                <li><?= esc($colab['nombre']) ?> - <?= esc($colab['correo']) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php else: ?>
    <p><em>No hay colaboradores disponibles para asignar.</em></p>
<?php endif; ?>
<button onclick="mostrarModalInvitar()" style="margin-top: 1rem; background-color: #28a745; color: white; padding: 0.5rem 1rem; border: none; border-radius: 5px;">
    Invitar por correo
</button>
<button onclick="mostrarModalSubtarea()" style="margin-top: 1rem; margin-left: 10px; background-color: #007bff; color: white; padding: 0.5rem 1rem; border: none; border-radius: 5px;">
    Crear subtarea
</button>



        </div>
    <?php else: ?>
        <p>No se encontró la tarea.</p>
    <?php endif; ?>
    <h2>Subtareas</h2>

<?php if (!empty($subtareas)): ?>
    <?php foreach ($subtareas as $sub): ?>
        <?php [$borde, $fondo] = obtenerColoresTarea($sub['color']); ?>
        
        <div class="subtarea-card" style="border-left: 4px solid <?= $borde ?>; background-color: <?= $fondo ?>; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem;">
            <h4><?= esc($sub['titulo']) ?></h4>
            <p><?= esc($sub['descripcion']) ?></p>
            <p><strong>Estado:</strong> <?= esc($sub['estado']) ?></p>
            <p><strong>Prioridad:</strong> <span class="badge bg-secondary"><?= esc($sub['prioridad']) ?></span></p>
            <p><strong>Fecha de vencimiento:</strong> <?= esc($sub['fecha_vencimiento']) ?></p>
            <?php if ($sub['fecha_recordatorio']): ?>
                <p><strong>Recordatorio:</strong> <?= esc($sub['fecha_recordatorio']) ?></p>
            <?php endif; ?>

                <!-- Responsables -->
                <?php if (!empty($sub['responsables'])): ?>
                    <p><strong>Responsables:</strong></p>
                    <ul class="list-group mb-2">
                        <?php foreach ($sub['responsables'] as $usuario): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><?= esc($usuario['nombre']) ?> (<?= esc($usuario['correo']) ?>)</span>
                                <form action="<?= base_url('subtarea/quitarResponsable') ?>" method="post" style="margin: 0;">
                                    <input type="hidden" name="subtarea_id" value="<?= esc($sub['id']) ?>">
                                    <input type="hidden" name="usuario_id" value="<?= esc($usuario['id']) ?>">
                                    <input type="hidden" name="tarea_id" value="<?= esc($tarea['id']) ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Quitar a <?= esc($usuario['nombre']) ?> de esta subtarea?')">Quitar</button>
                                </form>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p><em>Sin responsables asignados.</em></p>
                <?php endif; ?>

            <!-- Botones -->
            <div class="d-flex justify-content-between mt-3">

                <!-- Agregar Responsable -->
                <div>
                    <?php if (!empty($colaboradores_disponibles)): ?>
                        <button type="button" class="btn btn-sm btn-success" onclick="abrirModal(<?= esc($sub['id']) ?>)">Agregar responsable</button>
                    <?php endif; ?>
                </div>

                <!-- Editar y Eliminar -->
                <div class="d-flex gap-2">
                    <!-- Botón Editar -->
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editarSubtareaModal<?= $sub['id'] ?>">
                        Editar
                    </button>

                    <!-- Botón Eliminar -->
                    <form action="<?= base_url('subtarea/eliminar/' . $sub['id']) ?>" method="post" style="margin: 0;">
                        <?= csrf_field() ?>
                        <input type="hidden" name="tarea_id" value="<?= esc($tarea['id']) ?>">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que querés eliminar esta subtarea?')">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal de Edición -->
      <div class="modal fade" id="editarSubtareaModal<?= $sub['id'] ?>" tabindex="-1" aria-labelledby="editarSubtareaLabel<?= $sub['id'] ?>" aria-hidden="true">
            <div class="modal-dialog">
                <form action="<?= base_url('subtarea/editar/' . $sub['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarSubtareaLabel<?= $sub['id'] ?>">Editar Subtarea</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Campos del formulario -->
                            <div class="mb-3">
                                <label class="form-label">Título</label>
                                <input type="text" class="form-control" name="titulo" value="<?= esc($sub['titulo']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Descripción</label>
                                <textarea class="form-control" name="descripcion" required><?= esc($sub['descripcion']) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Estado</label>
                                <select name="estado" class="form-select" required>
                                    <option value="creada" <?= $sub['estado'] === 'creada' ? 'selected' : '' ?>>Creada</option>
                                    <option value="en_proceso" <?= $sub['estado'] === 'en_proceso' ? 'selected' : '' ?>>En proceso</option>
                                    <option value="completada" <?= $sub['estado'] === 'completada' ? 'selected' : '' ?>>Completada</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Prioridad</label>
                                <select name="prioridad" class="form-select" required>
                                    <option value="baja" <?= $sub['prioridad'] === 'baja' ? 'selected' : '' ?>>Baja</option>
                                    <option value="media" <?= $sub['prioridad'] === 'media' ? 'selected' : '' ?>>Media</option>
                                    <option value="alta" <?= $sub['prioridad'] === 'alta' ? 'selected' : '' ?>>Alta</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Fecha de vencimiento</label>
                                <input type="date" class="form-control" name="fecha_vencimiento" value="<?= esc($sub['fecha_vencimiento']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Fecha de recordatorio</label>
                                <input type="date" class="form-control" name="fecha_recordatorio" value="<?= esc($sub['fecha_recordatorio']) ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Color</label>
                                <select name="color" class="form-select">
                                    <?php $colores = ['rojo', 'azul', 'verde', 'naranja', 'celeste', 'gris', 'violeta']; ?>
                                    <?php foreach ($colores as $color): ?>
                                        <option value="<?= $color ?>" <?= $sub['color'] === $color ? 'selected' : '' ?>><?= ucfirst($color) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </div>
                </form>
            </div>
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
<!-- Modal para crear una nueva subtarea -->
<div id="modalCrearSubtarea" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color: rgba(0,0,0,0.5); z-index:1000;">
    <div style="background:white; max-width:500px; margin:10% auto; padding:20px; border-radius:10px; position:relative;">
        <h3>Crear nueva subtarea</h3>
        <form id="formCrearSubtarea" action="<?= base_url('subtarea/crear') ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="tarea_id" value="<?= esc($tarea['id']) ?>">

            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" required style="width: 100%; margin-bottom: 1rem; padding: 0.5rem;">

            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" rows="3" style="width: 100%; margin-bottom: 1rem; padding: 0.5rem;"></textarea>

            <label>Estado:</label><br>
            <label><input type="radio" name="estado" value="en_proceso" required> En proceso</label><br>
            <label><input type="radio" name="estado" value="completada" required> Completada</label><br>
            
            <label for="prioridad">Prioridad:</label>
            <select name="prioridad" id="prioridad" required style="width: 100%; margin-bottom: 1rem; padding: 0.5rem;">
                <option value="alta">Alta</option>
                <option value="media">Media</option>
                <option value="baja">Baja</option>
            </select>
            <label for="fecha_vencimiento">Fecha de vencimiento:</label>
                <input
                    type="date"
                    id="fecha_vencimiento"
                    name="fecha_vencimiento"
                    required
                    min="<?= date('Y-m-d') ?>"
                    style="padding: 0.5rem;"
                >

                <label for="fecha_recordatorio">Fecha de recordatorio:</label>
                <input
                    type="date"
                    id="fecha_recordatorio"
                    name="fecha_recordatorio"
                    min="<?= date('Y-m-d') ?>"
                    style="padding: 0.5rem;"
                >


            <!-- Color -->
            <label for="color">Color:</label>
            <select name="color" id="color" required style="width: 100%; margin-bottom: 1rem; padding: 0.5rem;">
                <option value="rojo">Rojo</option>
                <option value="azul">Azul</option>
                <option value="verde">Verde</option>
                <option value="naranja">Naranja</option>
                <option value="celeste">Celeste</option>
                <option value="gris">Gris</option>
                <option value="violeta">Violeta</option>
            </select>
            <div style="margin-top:1.5rem;">
                <button type="submit" class="btn btn-success">Crear subtarea</button>
                <button type="button" class="btn btn-secondary" onclick="cerrarModalSubtarea()">Cancelar</button>
            </div>
        </form>
    </div>
</div>
<?php foreach ($subtareas as $sub): ?>
<!-- Modal de edición de subtarea -->
<div class="modal fade" id="editarSubtareaModal<?= $sub['id'] ?>" tabindex="-1" aria-labelledby="editarSubtareaLabel<?= $sub['id'] ?>" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('subtarea/editar/' . $sub['id']) ?>" method="post">
        <?= csrf_field() ?>
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editarSubtareaLabel<?= $sub['id'] ?>">Editar Subtarea</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="titulo<?= $sub['id'] ?>" class="form-label">Título</label>
              <input type="text" class="form-control" name="titulo" id="titulo<?= $sub['id'] ?>" value="<?= esc($sub['titulo']) ?>" required>
            </div>
            <div class="mb-3">
              <label for="descripcion<?= $sub['id'] ?>" class="form-label">Descripción</label>
              <textarea class="form-control" name="descripcion" id="descripcion<?= $sub['id'] ?>" required><?= esc($sub['descripcion']) ?></textarea>
            </div>
            <div class="mb-3">
              <label for="estado<?= $sub['id'] ?>" class="form-label">Estado</label>
              <select name="estado" class="form-select" id="estado<?= $sub['id'] ?>" required>
                <option value="pendiente" <?= $sub['estado'] === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                <option value="en progreso" <?= $sub['estado'] === 'en progreso' ? 'selected' : '' ?>>En progreso</option>
                <option value="completada" <?= $sub['estado'] === 'completada' ? 'selected' : '' ?>>Completada</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="prioridad<?= $sub['id'] ?>" class="form-label">Prioridad</label>
              <select name="prioridad" class="form-select" id="prioridad<?= $sub['id'] ?>" required>
                <option value="baja" <?= $sub['prioridad'] === 'baja' ? 'selected' : '' ?>>Baja</option>
                <option value="media" <?= $sub['prioridad'] === 'media' ? 'selected' : '' ?>>Media</option>
                <option value="alta" <?= $sub['prioridad'] === 'alta' ? 'selected' : '' ?>>Alta</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="fecha_vencimiento<?= $sub['id'] ?>" class="form-label">Fecha de vencimiento</label>
              <input type="date" class="form-control" name="fecha_vencimiento" id="fecha_vencimiento<?= $sub['id'] ?>" value="<?= esc($sub['fecha_vencimiento']) ?>" required>
            </div>
            <div class="mb-3">
              <label for="fecha_recordatorio<?= $sub['id'] ?>" class="form-label">Fecha de recordatorio</label>
              <input type="date" class="form-control" name="fecha_recordatorio" id="fecha_recordatorio<?= $sub['id'] ?>" value="<?= esc($sub['fecha_recordatorio']) ?>">
            </div>
            <div class="mb-3">
              <label for="color<?= $sub['id'] ?>" class="form-label">Color</label>
              <select name="color" class="form-select" id="color<?= $sub['id'] ?>">
                <?php $colores = ['rojo', 'azul', 'verde', 'naranja', 'celeste', 'gris', 'violeta']; ?>
                <?php foreach ($colores as $color): ?>
                  <option value="<?= $color ?>" <?= $sub['color'] === $color ? 'selected' : '' ?>><?= ucfirst($color) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
          </div>
        </div>
    </form>
  </div>
</div>
<?php endforeach; ?>

<!-- JavaScript para manejar el modal y envío por AJAX -->


<script>
    function volverAtras() {
        window.history.back();
    }
</script>

</script>


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
function mostrarModalSubtarea() {
    document.getElementById('modalCrearSubtarea').style.display = 'block';
}

function cerrarModalSubtarea() {
    document.getElementById('modalCrearSubtarea').style.display = 'none';
}

</script>
</body>
</html>
