<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: system-ui, sans-serif;
            color: #212529;
            margin: 0;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #ffffff;
            border-right: 1px solid #dee2e6;
            padding: 2rem 1rem;
        }

        .sidebar .nav-link {
            display: block;
            color: #0d6efd;
            font-weight: 500;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            margin-bottom: 0.5rem;
        }

        .sidebar .nav-link:hover {
            background-color: #e9ecef;
        }

        .content {
            margin-left: 240px;
            padding: 2rem;
        }

        .panel {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .panel h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .filtros-container {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .filtros-container select {
            padding: 0.4rem;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 0.9rem;
        }

        .tarea-card {
            border: 1px solid #dee2e6;
            border-left: 5px solid #0d6efd;
            background-color: #ffffff;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
        }

        .tarea-titulo {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .tarea-descripcion {
            font-size: 0.95rem;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .tarea-meta {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .badge {
            background-color: #adb5bd;
            font-size: 0.75rem;
        }

        .acciones {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.75rem;
        }

        .acciones button {
            font-size: 0.85rem;
            padding: 0.3rem 0.6rem;
        }

        .archivar-link {
            display: block;
            margin-top: 0.5rem;
            font-size: 0.85rem;
            text-align: center;
            background-color: #198754;
            color: white;
            padding: 0.3rem;
            border-radius: 4px;
            text-decoration: none;
        }

        .alert ul {
            margin: 0;
            padding-left: 1.2rem;
        }

    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="text-center mb-4">
        <strong>Mi Panel</strong>
    </div>
    <a class="nav-link" href="<?= base_url('tareas/crear') ?>">Crear Tarea</a>
    <a class="nav-link" href="<?= base_url('tareas/historial') ?>">Historial</a>
    <a class="nav-link" href="<?= base_url('tareas/colaborar') ?>">Invitaciones</a>
    <hr>
    <div class="dropdown">
        <button class="btn btn-outline-secondary w-100 dropdown-toggle" type="button" data-bs-toggle="dropdown">
            Cuenta
        </button>
        <ul class="dropdown-menu w-100">
            <li><a class="dropdown-item" href="<?= site_url('usuario/editar') ?>">Editar perfil</a></li>
            <li><a class="dropdown-item" href="<?= site_url('logout') ?>">Cerrar sesión</a></li>
        </ul>
    </div>
</div>

<!-- CONTENIDO PRINCIPAL -->
<div class="content">
    <?php if (!empty($RecordatorioAlerta)): ?>
        <div class="alert alert-warning">
            <ul>
                <?php foreach ($RecordatorioAlerta as $mensaje): ?>
                    <li><?= $mensaje ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="panel">
        <h2>Mis Tareas</h2>
        

        <div id="tareasContainer">
            <?php
            function obtenerColoresTarea($colorNombre) {
                switch (strtolower($colorNombre)) {
                    case 'rojo': return ['#FF6B6B', '#FFECEC'];
                    case 'azul': return ['#1E90FF', '#E6F0FF'];
                    case 'verde': return ['#28A745', '#E9F7EF'];
                    case 'naranja': return ['#FFA600', '#FFF3E0'];
                    case 'celeste': return ['#00C1FF', '#E0F7FF'];
                    case 'gris': return ['#6C757D', '#F0F0F0'];
                    case 'violeta': return ['#8A2BE2', '#F3E8FF'];
                    default: return ['#CCCCCC', '#F9F9F9'];
                }
            }
            ?>
        <?php if (!empty($tareas_propias)): ?>
            <?php foreach ($tareas_propias as $tarea): ?>
                <?php [$borde, $fondo] = obtenerColoresTarea($tarea['color']); ?>
                <div class="tarea-card" style="border-left-color: <?= esc($borde) ?>">
                    <form method="POST" action="<?= site_url('tarea') ?>" style="margin: 0;">
                        <input type="hidden" name="tarea_id" value="<?= esc($tarea['id']) ?>">
                        <button type="submit" style="all: unset; cursor: pointer; display: block; width: 100%;">
                            <div class="tarea-titulo"><?= esc($tarea['titulo']) ?></div>
                            <div class="tarea-descripcion"><?= esc($tarea['descripcion']) ?></div>
                            <div class="tarea-meta"><strong>Estado:</strong> <?= esc($tarea['estado']) ?></div>
                            <div class="tarea-meta"><strong>Prioridad:</strong> <span class="badge"><?= esc($tarea['prioridad']) ?></span></div>
                            <div class="tarea-meta"><strong>Vence:</strong> <?= esc($tarea['fecha_vencimiento']) ?></div>
                            <?php if (!empty($tarea['fecha_recordatorio'])): ?>
                                <div class="tarea-meta"><strong>Recordatorio:</strong> <?= esc($tarea['fecha_recordatorio']) ?></div>
                            <?php endif; ?>
                        </button>
                    </form>
                    <div class="acciones">
                        <form action="<?= site_url('tarea/editar') ?>" method="post">
                            <input type="hidden" name="id_tarea" value="<?= esc($tarea['id']) ?>">
                            <button type="submit" class="btn btn-outline-warning w-100">🖊️ Editar</button>
                        </form>
                        <form action="<?= site_url('tarea/baja') ?>" method="post">
                            <input type="hidden" name="id_tarea" value="<?= esc($tarea['id']) ?>">
                            <button type="submit" class="btn btn-outline-secondary w-100">🗑️ Borrar</button>
                        </form>
                    </div>
                    <?php if ($tarea['estado'] === 'completada' && !$tarea['archivada']): ?>
                        <a href="<?= site_url('tarea/archivar/' . $tarea['id']) ?>" class="archivar-link">📦 Archivar</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No tienes tareas propias activas.</p>
        <?php endif; ?>
        </div>
    </div>

    <div class="panel">
        <h2>Mis Colaboraciones</h2>
        <?php if (!empty($tareas_colaborativas)): ?>
            <?php foreach ($tareas_colaborativas as $tarea): ?>
                <?php [$borde, $fondo] = obtenerColoresTarea($tarea['color']); ?>
                <div class="tarea-card" style="border-left-color: <?= esc($borde) ?>">
                    <form method="POST" action="<?= site_url('tarea/colaborar') ?>" style="margin: 0;">
                        <input type="hidden" name="tarea_id" value="<?= esc($tarea['id']) ?>">
                        <button type="submit" style="all: unset; cursor: pointer; display: block; width: 100%;">
                            <div class="tarea-titulo"><?= esc($tarea['titulo']) ?></div>
                            <div class="tarea-descripcion"><?= esc($tarea['descripcion']) ?></div>
                            <div class="tarea-meta"><strong>Estado:</strong> <?= esc($tarea['estado']) ?></div>
                            <div class="tarea-meta"><strong>Prioridad:</strong> <span class="badge"><?= esc($tarea['prioridad']) ?></span></div>
                            <div class="tarea-meta"><strong>Vence:</strong> <?= esc($tarea['fecha_vencimiento']) ?></div>
                            <?php if (!empty($tarea['fecha_recordatorio'])): ?>
                                <div class="tarea-meta"><strong>Recordatorio:</strong> <?= esc($tarea['fecha_recordatorio']) ?></div>
                            <?php endif; ?>
                        </button>
                    </form>
                    <div class="tarea-meta"><strong>Propietario (ID):</strong> <?= esc($tarea['usuario_id']) ?></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay tareas colaborativas disponibles.</p>
        <?php endif; ?>
    </div>
</div>

<script>
    const normalize = str => str?.toLowerCase().replace(/\s+/g, '_');

</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
