<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Tareas</title>
    <!-- Importar tipografía moderna de Apple/Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    
    <style>
        :root {
            --bg-color: #f5f5f7;
            --card-bg: #ffffff;
            --text-primary: #1d1d1f;
            --text-secondary: #86868b;
            --apple-blue: #0071e3;
            --apple-blue-hover: #0077ED;
            --border-color: #d2d2d7;
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            padding-bottom: 4rem; /* Mayor respiro al final */
            color: var(--text-primary);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Rediseño del botón "Volver atrás" al estilo Apple Nav */
        .btn-volver-container {
            max-width: 720px;
            margin: 2rem auto 0 auto;
            padding: 0 1rem;
            display: flex;
        }

        .btn-volver {
            display: inline-flex;
            align-items: center;
            font-size: 1rem;
            font-weight: 500;
            color: var(--apple-blue);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: background-color 0.2s ease;
        }

        .btn-volver:hover {
            text-decoration: none;
            color: var(--apple-blue-hover);
            background-color: rgba(0, 113, 227, 0.1); /* Efecto hover sutil tipo iOS */
        }

        .btn-volver::before {
            content: "‹"; /* Flecha chevron nativa */
            font-size: 1.5rem;
            margin-right: 0.3rem;
            line-height: 1;
            transform: translateY(-1px);
        }

        .titulo-historial {
            text-align: center;
            margin-top: 1rem;
            color: var(--text-primary);
            font-weight: 700;
            font-size: 2rem;
            letter-spacing: -0.02em;
        }

        .boton-toggle {
            display: block;
            margin: 2rem auto; /* Doble respiro visual */
            background-color: var(--text-primary);
            color: white;
            border: none;
            padding: 0.8rem 1.8rem;
            border-radius: 999px; /* Botón pastilla */
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.1s ease, background-color 0.3s ease;
            font-size: 1rem;
        }

        .boton-toggle:hover {
            background-color: #000000;
        }
        
        .boton-toggle:active {
            transform: scale(0.98);
        }

        .tareas-container {
            max-width: 720px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 1.5rem; /* Separación amplia entre tarjetas */
            padding: 0 1rem;
        }

        .tarea-card {
            background-color: var(--card-bg);
            border: none;
            border-left: 6px solid var(--apple-blue); /* Detalles más gruesos y limpios */
            border-radius: 16px; /* Bordes pronunciados estilo Apple */
            padding: 1.5rem 2rem; /* Mucho padding interno */
            box-shadow: 0 4px 24px rgba(0,0,0,0.06); /* Sombra difuminada amplia */
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 0.4s ease, transform 0.3s ease, border-color 0.3s ease;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .tarea-card.archivada {
            border-left-color: var(--border-color);
            opacity: 0.85; /* Un poco más visibles que antes */
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        }

        .tarea-card.show {
            opacity: 1;
            transform: translateY(0);
        }
        
        .tarea-card.archivada.show {
            opacity: 0.85;
        }

        .tarea-titulo {
            font-weight: 700;
            font-size: 1.3rem;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            line-height: 1.25;
            user-select: text;
            letter-spacing: -0.01em;
        }

        .tarea-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.95rem;
            color: var(--text-secondary);
            font-weight: 500;
            user-select: text;
        }

        .tarea-info > div {
            flex: 1;
        }

        .etiqueta-prioridad {
            display: inline-block;
            padding: 0.25rem 0.8rem;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #fff;
            text-transform: capitalize; /* Más moderno que uppercase */
            user-select: none;
            width: fit-content;
        }

        /* Prioridades estilo Apple (colores planos vibrantes) */
        .prioridad-baja {
            background-color: #34c759; /* Verde iOS */
        }

        .prioridad-media {
            background-color: #ff9f0a; /* Naranja iOS */
        }

        .prioridad-alta {
            background-color: #ff3b30; /* Rojo iOS */
        }

        .detalle-adicional {
            font-size: 0.9rem;
            color: var(--text-secondary);
            margin-top: 0.5rem;
            user-select: text;
        }
        
        .detalle-adicional strong {
            font-weight: 600;
            color: var(--text-primary);
        }

        hr.divisor {
            width: 100%;
            max-width: 720px;
            border: none;
            border-bottom: 1px solid var(--border-color);
            margin: 3rem auto; /* Máxima separación visual */
        }

        h3.seccion-tareas {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--text-primary);
            font-weight: 600;
            font-size: 1.5rem;
            letter-spacing: -0.01em;
            user-select: none;
        }

        #tareasArchivadasContainer {
            display: none;
            width: 100%;
        }
        
        .empty-state {
            text-align: center;
            margin-top: 2rem;
            color: var(--text-secondary);
            font-size: 1rem;
            font-style: normal;
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

    <div class="btn-volver-container">
        <a href="javascript:history.back()" class="btn-volver">Volver</a>
    </div>

    <h2 class="titulo-historial">Historial de Tareas</h2>

    <button class="boton-toggle" onclick="toggleArchivadas()">
        <span id="texto-toggle">Mostrar Archivados</span>
    </button>

    <section id="tareasArchivadasContainer" aria-label="Tareas Archivadas">
        <?php if (empty($tareasArchivadas)): ?>
            <p class="empty-state">No hay tareas archivadas.</p>
        <?php else: ?>
            <div class="tareas-container">
                <?php foreach ($tareasArchivadas as $tarea): ?>
                    <article class="tarea-card archivada" tabindex="0" aria-label="Tarea archivada: <?= esc($tarea['titulo']) ?>">
                        <div class="tarea-titulo"><?= esc($tarea['titulo']) ?></div>
                        <div class="tarea-info">
                            <div><strong>Estado:</strong> <?= esc($tarea['estado']) ?></div>
                            <div>
                                <span class="etiqueta-prioridad prioridad-<?= strtolower(esc($tarea['prioridad'])) ?>">
                                    <?= esc($tarea['prioridad']) ?>
                                </span>
                            </div>
                        </div>
                        <div class="detalle-adicional"><strong>Vencimiento:</strong> <?= esc($tarea['fecha_vencimiento']) ?></div>
                        <?php if ($tarea['fecha_recordatorio']): ?>
                            <div class="detalle-adicional"><strong>Recordatorio:</strong> <?= esc($tarea['fecha_recordatorio']) ?></div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

    <hr class="divisor" />

    <h3 class="seccion-tareas">Tareas Activas</h3>

    <?php if (empty($tareasActivas)): ?>
        <p class="empty-state">No hay tareas activas.</p>
    <?php else: ?>
        <div class="tareas-container" aria-label="Tareas Activas">
            <?php foreach ($tareasActivas as $tarea): ?>
                <article class="tarea-card" tabindex="0" aria-label="Tarea activa: <?= esc($tarea['titulo']) ?>">
                    <div class="tarea-titulo"><?= esc($tarea['titulo']) ?></div>
                    <div class="tarea-info">
                        <div><strong>Estado:</strong> <?= esc($tarea['estado']) ?></div>
                        <div>
                            <span class="etiqueta-prioridad prioridad-<?= strtolower(esc($tarea['prioridad'])) ?>">
                                <?= esc($tarea['prioridad']) ?>
                            </span>
                        </div>
                    </div>
                    <div class="detalle-adicional"><strong>Vencimiento:</strong> <?= esc($tarea['fecha_vencimiento']) ?></div>
                    <?php if ($tarea['fecha_recordatorio']): ?>
                        <div class="detalle-adicional"><strong>Recordatorio:</strong> <?= esc($tarea['fecha_recordatorio']) ?></div>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <script>
        function toggleArchivadas() {
            const contenedor = document.getElementById("tareasArchivadasContainer");
            const textoToggle = document.getElementById("texto-toggle");

            if (contenedor.style.display === "none" || contenedor.style.display === "") {
                contenedor.style.display = "block";
                textoToggle.textContent = "Ocultar Archivados";
                animarTarjetas(contenedor);
            } else {
                contenedor.style.display = "none";
                textoToggle.textContent = "Mostrar Archivados";
            }
        }

        function animarTarjetas(contenedor) {
            const tarjetas = contenedor.querySelectorAll('.tarea-card');
            tarjetas.forEach((card, i) => {
                setTimeout(() => card.classList.add('show'), i * 100 + 50); // Ligeramente más retrasado para suavidad
            });
        }

        window.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.tareas-container:not(#tareasArchivadasContainer) .tarea-card')
                .forEach((card, i) => {
                    setTimeout(() => card.classList.add('show'), i * 100 + 50);
                });
        });
    </script>
    
    <script src="<?= base_url('js/page-transitions.js') ?>"></script>
</body>
</html>
