<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Tarea</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: system-ui, sans-serif;
            color: #212529;
            margin: 0;
        }

        .content {
            max-width: 600px;
            margin: 4rem auto;
            padding: 2rem;
        }

        .panel {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        h1 {
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        input[type="text"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 0.5rem;
            font-size: 1rem;
            border: 1px solid #ced4da;
            border-radius: 6px;
            margin-bottom: 1rem;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        button {
            padding: 0.5rem 1rem;
            font-size: 1rem;
            background-color: #0d6efd;
            border: none;
            color: white;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0b5ed7;
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

    <div class="content">
        <div class="panel">
            <h1>Crear Nueva Tarea</h1>
            <form action="<?= base_url('tareas/guardar') ?>" method="post">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"></textarea>

                <label for="prioridad">Prioridad:</label>
                <select id="prioridad" name="prioridad">
                    <option value="baja">Baja</option>
                    <option value="normal" selected>Normal</option>
                    <option value="alta">Alta</option>
                </select>

                <label for="fecha_vencimiento">Fecha de vencimiento:</label>
                <input type="date" id="fecha_vencimiento" name="fecha_vencimiento">

                <label for="fecha_recordatorio">Fecha de recordatorio:</label>
                <input type="date" id="fecha_recordatorio" name="fecha_recordatorio">

                <label for="color">Color (opcional):</label>
                <input type="text" id="color" name="color">

                <input type="hidden" name="tarea_id" value="1"><!-- Ajustar según sea necesario -->

                <button type="submit">Guardar</button>
            </form>
        </div>
    </div>
</body>
</html>
