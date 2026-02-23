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

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            margin-bottom: 1rem;
        }

        .panel-header h2 {
            margin-bottom: 0;
        }

        .btn-toggle-panel {
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #6c757d;
            transition: all 0.2s;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            padding: 0;
            padding-bottom: 4px; /* Nudge the minus sign up */
        }

        .btn-toggle-panel:hover {
            background-color: #f8f9fa;
            border-color: #adb5bd;
            color: #212529;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-filter {
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            border: 1px solid #dee2e6;
            background: #fff;
            color: #6c757d;
        }

        .btn-filter:hover {
            background-color: #f8f9fa;
            color: #212529;
        }

        .panel-content {
            overflow: hidden;
            transition: max-height 0.4s ease-out, opacity 0.3s ease-in;
            max-height: 2000px; /* Suficiente para el contenido */
            opacity: 1;
        }

        .page-transition {
            opacity: 0;
            transition: opacity 0.3s ease-in-out, transform 0.3s ease;
        }

        .page-transition-enter {
            opacity: 1;
            transform: scale(1);
        }

        .page-transition-exit {
            opacity: 0;
            transform: scale(0.98);
        }

    </style>
</head>
<body class="page-transition">

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
        <div class="panel-header" onclick="event.target.tagName !== 'BUTTON' && event.target.tagName !== 'A' && togglePanel('tareasContent')">
            <h2>Mis Tareas</h2>
            <div class="header-actions">
                <div class="dropdown">
                    <button class="btn-filter dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Filtro
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" onclick="sortTasks('newest', 'tareasContainer')">Más nuevas</a></li>
                        <li><a class="dropdown-item" href="#" onclick="sortTasks('oldest', 'tareasContainer')">Más antiguas</a></li>
                        <li><a class="dropdown-item" href="#" onclick="sortTasks('expiry', 'tareasContainer')">Próximo a vencimiento</a></li>
                    </ul>
                </div>
                <button class="btn-toggle-panel" id="tareasContent-btn" onclick="event.stopPropagation(); togglePanel('tareasContent')">−</button>
            </div>
        </div>
        
        <div id="tareasContent" class="panel-content">

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
                <div class="tarea-card" 
                     data-id="<?= esc($tarea['id']) ?>" 
                     data-expiry="<?= esc($tarea['fecha_vencimiento']) ?>"
                     style="border-left-color: <?= esc($borde) ?>">
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
                            <button type="submit" class="btn btn-outline-warning w-100">Editar</button>
                        </form>
                        <form action="<?= site_url('tarea/baja') ?>" method="post">
                            <input type="hidden" name="id_tarea" value="<?= esc($tarea['id']) ?>">
                            <button type="submit" class="btn btn-outline-secondary w-100">Borrar</button>
                        </form>
                    </div>
                    <?php if ($tarea['estado'] === 'completada' && !$tarea['archivada']): ?>
                        <a href="<?= site_url('tarea/archivar/' . $tarea['id']) ?>" class="archivar-link">Archivar</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No tienes tareas propias activas.</p>
        <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header" onclick="event.target.tagName !== 'BUTTON' && event.target.tagName !== 'A' && togglePanel('colabContent')">
            <h2>Mis Colaboraciones</h2>
            <div class="header-actions">
                <div class="dropdown">
                    <button class="btn-filter dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Filtro
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" onclick="sortTasks('newest', 'colabContainer')">Más nuevas</a></li>
                        <li><a class="dropdown-item" href="#" onclick="sortTasks('oldest', 'colabContainer')">Más antiguas</a></li>
                        <li><a class="dropdown-item" href="#" onclick="sortTasks('expiry', 'colabContainer')">Próximo a vencimiento</a></li>
                    </ul>
                </div>
                <button class="btn-toggle-panel" id="colabContent-btn" onclick="event.stopPropagation(); togglePanel('colabContent')">−</button>
            </div>
        </div>
        <div id="colabContent" class="panel-content">
            <div id="colabContainer">
        <?php if (!empty($tareas_colaborativas)): ?>
            <?php foreach ($tareas_colaborativas as $tarea): ?>
                <?php [$borde, $fondo] = obtenerColoresTarea($tarea['color']); ?>
                <div class="tarea-card" 
                     data-id="<?= esc($tarea['id']) ?>" 
                     data-expiry="<?= esc($tarea['fecha_vencimiento']) ?>"
                     style="border-left-color: <?= esc($borde) ?>">
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
            </div> <!-- colabContainer -->
        </div> <!-- colabContent -->
    </div> <!-- panel -->
</div> <!-- content -->

<script>
    function togglePanel(panelId) {
        const panel = document.getElementById(panelId);
        const btn = document.getElementById(panelId + '-btn');
        
        if (panel.classList.contains('collapsed')) {
            panel.classList.remove('collapsed');
            btn.textContent = '−'; 
            btn.style.paddingBottom = '4px';
        } else {
            panel.classList.add('collapsed');
            btn.textContent = '+';
            btn.style.paddingBottom = '0px';
        }
    }

    function sortTasks(criteria, containerId) {
        const container = document.getElementById(containerId);
        if (!container) return;
        
        const tasks = Array.from(container.getElementsByClassName('tarea-card'));
        if (tasks.length === 0) return;

        tasks.sort((a, b) => {
            if (criteria === 'newest') {
                return parseInt(b.getAttribute('data-id')) - parseInt(a.getAttribute('data-id'));
            } else if (criteria === 'oldest') {
                return parseInt(a.getAttribute('data-id')) - parseInt(b.getAttribute('data-id'));
            } else if (criteria === 'expiry') {
                const dateA = new Date(a.getAttribute('data-expiry') || '9999-12-31');
                const dateB = new Date(b.getAttribute('data-expiry') || '9999-12-31');
                return dateA - dateB;
            }
            return 0;
        });

        tasks.forEach(task => container.appendChild(task));
    }

    window.onload = () => {
        sortTasks('newest', 'tareasContainer');
        sortTasks('newest', 'colabContainer');
    };
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('js/page-transitions.js') ?>"></script>
</body>
</html>
