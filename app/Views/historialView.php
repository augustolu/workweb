<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Historial de Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
            font-family: system-ui, sans-serif;
            padding-bottom: 3rem;
            color: #212529;
        }

        .titulo-historial {
            text-align: center;
            margin-top: 2.5rem;
            color: #0d253f; /* azul oscuro más neutro */
            font-weight: 700;
            font-size: 1.8rem;
            letter-spacing: 0.05em;
        }

        .boton-toggle {
            display: block;
            margin: 1.5rem auto 2rem auto;
            background-color: #34495e; /* azul oscuro sobrio */
            color: white;
            border: none;
            padding: 0.6rem 1.4rem;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 1rem;
            max-width: 200px;
        }

        .boton-toggle:hover {
            background-color: #2c3e50;
        }

        .tareas-container {
            max-width: 720px;
            margin: 0 auto 3rem auto;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .tarea-card {
            background-color: #fff;
            border-left: 4px solid #0d253f;
            border-radius: 8px;
            padding: 1rem 1.25rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 0.4s ease, transform 0.3s ease;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .tarea-card.archivada {
            border-left-color: #6c757d;
            opacity: 0.8;
        }

        .tarea-card.show {
            opacity: 1;
            transform: translateY(0);
        }

        .tarea-titulo {
            font-weight: 700;
            font-size: 1.2rem;
            color: #0d253f;
            margin-bottom: 0.4rem;
            line-height: 1.2;
            user-select: text;
        }

        .tarea-info {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            color: #495057;
            font-weight: 500;
            user-select: text;
        }

        .tarea-info > div {
            flex: 1;
        }

        .etiqueta-prioridad {
            display: inline-block;
            padding: 0.15rem 0.6rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            user-select: none;
            width: fit-content;
        }

        /* Prioridades con colores sutiles */
        .prioridad-baja {
            background-color: #6c757d; /* gris */
        }

        .prioridad-media {
            background-color: #2980b9; /* azul oscuro */
        }

        .prioridad-alta {
            background-color: #c0392b; /* rojo apagado */
        }

        .detalle-adicional {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 0.35rem;
            user-select: text;
        }

        hr.divisor {
            width: 90%;
            max-width: 720px;
            border: none;
            border-bottom: 1px solid #dee2e6;
            margin: 2rem auto;
        }

        h3.seccion-tareas {
            text-align: center;
            margin-bottom: 1.25rem;
            color: #34495e;
            font-weight: 700;
            font-size: 1.3rem;
            letter-spacing: 0.1em;
            user-select: none;
        }

        .btn-volver {
            display: block;
            margin: 0 auto;
            background-color: #0d253f;
            color: white;
            border: none;
            padding: 0.55rem 1.3rem;
            border-radius: 6px;
            font-weight: 700;
            cursor: pointer;
            font-size: 1rem;
            max-width: 150px;
            transition: background-color 0.3s ease;
            user-select: none;
        }

        .btn-volver:hover {
            background-color: #061a2b;
        }

        #tareasArchivadasContainer {
            display: none;
            max-width: 720px;
            margin: 0 auto;
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
<a href="javascript:history.back()" class="btn-volver">← Volver atrás</a>

    <h2 class="titulo-historial">Historial de Tareas</h2>

    <button class="boton-toggle" onclick="toggleArchivadas()">
        <span id="icono-archivo" aria-hidden="true">📂</span> 
        <span id="texto-toggle">Mostrar Archivados</span>
    </button>

    <section id="tareasArchivadasContainer" aria-label="Tareas Archivadas">
        <?php if (empty($tareasArchivadas)): ?>
            <p class="text-center mt-3" style="color:#6c757d; font-style: italic;">No hay tareas archivadas.</p>
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
        <p class="text-center mt-3" style="color:#6c757d; font-style: italic;">No hay tareas activas.</p>
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
            const icono = document.getElementById("icono-archivo");

            if (contenedor.style.display === "none" || contenedor.style.display === "") {
                contenedor.style.display = "block";
                textoToggle.textContent = "Ocultar Archivados";
                icono.textContent = "📁";
                animarTarjetas(contenedor);
            } else {
                contenedor.style.display = "none";
                textoToggle.textContent = "Mostrar Archivados";
                icono.textContent = "📂";
            }
        }

        function animarTarjetas(contenedor) {
            const tarjetas = contenedor.querySelectorAll('.tarea-card');
            tarjetas.forEach((card, i) => {
                setTimeout(() => card.classList.add('show'), i * 100);
            });
        }

        window.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.tareas-container:not(#tareasArchivadasContainer) .tarea-card')
                .forEach((card, i) => {
                    setTimeout(() => card.classList.add('show'), i * 100);
                });
        });
    </script>
</body>
</html>
