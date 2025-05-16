<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Asignar Colaborador</title>
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

        h2 {
            font-size: 1.5rem;
            margin-bottom: 1.2rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        select {
            width: 100%;
            padding: 0.5rem;
            font-size: 1rem;
            border: 1px solid #ced4da;
            border-radius: 6px;
            margin-bottom: 1rem;
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

        .mensaje {
            text-align: center;
            font-size: 1rem;
            color: #6c757d;
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

    <?php if (!empty($tarea_id)): ?>
        <script>
            window.onload = function() {
                document.getElementById("autoForm").submit();
            };
        </script>
        <form id="autoForm" action="<?= base_url('/tarea') ?>" method="POST">
            <input type="hidden" name="tarea_id" value="<?= $tarea_id ?>">
        </form>
    <?php elseif (empty($tarea_id)): ?>
        <div class="content">
            <div class="panel">
                <h2>Asignar Colaborador a Subtarea</h2>

                <?php if (!empty($colaboradores)): ?>
                    <form action="<?= base_url('subtarea/guardarAsignacion') ?>" method="post">
                        <input type="hidden" name="subtarea_id" value="<?= esc($subtarea_id) ?>">

                        <label for="usuario_id">Seleccionar colaborador:</label>
                        <select name="usuario_id" required>
                            <?php foreach ($colaboradores as $colab): ?>
                                <option value="<?= esc($colab['id']) ?>">
                                    <?= esc($colab['nombre']) ?> (<?= esc($colab['correo']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <button type="submit">Asignar</button>
                    </form>
                <?php else: ?>
                    <p class="mensaje">No hay colaboradores disponibles para asignar.</p>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>
