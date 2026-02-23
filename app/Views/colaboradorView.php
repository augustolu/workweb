<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Colaborador</title>
    <!-- Importar tipografía moderna de Apple/Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-color: #f5f5f7;
            --card-bg: #ffffff;
            --text-primary: #1d1d1f;
            --text-secondary: #86868b;
            --apple-blue: #0071e3;
            --apple-blue-hover: #0077ED;
            --border-color: #d2d2d7;
            --focus-ring: rgba(0, 113, 227, 0.4);
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: var(--text-primary);
            margin: 0;
            padding: 2rem;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Estilo de la tarjeta principal (Apple Style) */
        .content {
            width: 100%;
            max-width: 500px;
            margin-top: 2rem;
        }

        .panel {
            background-color: var(--card-bg);
            border: none;
            border-radius: 16px; /* Bordes redondeados pronunciados */
            padding: 3rem; /* Doble espaciado (Respiro Visual) */
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06); /* Sombra amplia y sutil */
        }

        h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 2rem;
            text-align: center;
            letter-spacing: -0.01em;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
            letter-spacing: 0.01em;
        }

        select {
            width: 100%;
            padding: 1rem 1.25rem; /* Padding amplio */
            font-size: 1rem;
            color: var(--text-primary);
            background-color: var(--bg-color);
            border: 1px solid transparent;
            border-radius: 12px; /* Bordes redondeados modernos */
            margin-bottom: 2rem; /* Margen amplio */
            appearance: none; /* Quitamos flecha por defecto OS */
            background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%2386868b%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem top 50%;
            background-size: 0.65rem auto;
            transition: all 0.2s ease;
            outline: none;
            cursor: pointer;
        }

        select:focus {
            background-color: var(--card-bg);
            border-color: var(--apple-blue);
            box-shadow: 0 0 0 4px var(--focus-ring);
        }

        button[type="submit"] {
            padding: 1rem; /* Padding amplio */
            font-size: 1rem;
            font-weight: 600;
            background-color: var(--apple-blue);
            color: white;
            border: none;
            border-radius: 999px; /* Estilo pastilla perfecta */
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.1s ease;
            letter-spacing: 0.01em;
        }

        button[type="submit"]:hover {
            background-color: var(--apple-blue-hover);
        }
        
        button[type="submit"]:active {
            transform: scale(0.98);
        }

        .mensaje {
            text-align: center;
            font-size: 1rem;
            color: var(--text-secondary);
            margin-top: 1rem;
        }

        /* Rediseño del botón "Volver atrás" al estilo Apple Nav */
        .btn-volver {
            align-self: flex-start;
            display: inline-flex;
            align-items: center;
            font-size: 1rem;
            font-weight: 500;
            color: var(--apple-blue);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: background-color 0.2s ease;
            margin-bottom: 1rem;
        }

        .btn-volver:hover {
            background-color: rgba(0, 113, 227, 0.1); /* Efecto hover sutil tipo iOS */
        }

        .btn-volver::before {
            content: "‹"; /* Flecha chevron nativa */
            font-size: 1.5rem;
            margin-right: 0.3rem;
            line-height: 1;
            transform: translateY(-1px);
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
    
<a href="javascript:history.back()" class="btn-volver">Volver</a>

<?php if (!empty($tarea_id)): ?>
    <script>
        window.onload = function() {
            document.getElementById("autoForm").submit();
        };
    </script>
    <form id="autoForm" action="<?= base_url('/tarea') ?>" method="POST" style="display:none;">
        <input type="hidden" name="tarea_id" value="<?= $tarea_id ?>">
    </form>
<?php elseif (empty($tarea_id)): ?>
    <div class="content">
        <div class="panel">
            <h2>Asignar Colaborador</h2>

            <?php if (!empty($colaboradores)): ?>
                <form action="<?= base_url('subtarea/guardarAsignacion') ?>" method="post">
                    <input type="hidden" name="subtarea_id" value="<?= esc($subtarea_id) ?>">

                    <label for="usuario_id">Seleccionar colaborador</label>
                    <select name="usuario_id" id="usuario_id" required>
                        <option value="" disabled selected>Elige un miembro del equipo...</option>
                        <?php foreach ($colaboradores as $colab): ?>
                            <option value="<?= esc($colab['id']) ?>">
                                <?= esc($colab['nombre']) ?> (<?= esc($colab['correo']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit">Asignar Colaborador</button>
                </form>
            <?php else: ?>
                <p class="mensaje">No hay colaboradores disponibles para asignar en este momento.</p>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<script src="<?= base_url('js/page-transitions.js') ?>"></script>
</body>
</html>
