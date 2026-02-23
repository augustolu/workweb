<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Editar Tarea</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: system-ui, sans-serif;
            color: #212529;
            margin: 0;
            padding: 2rem;
        }
        h1 {
            text-align: center;
            color: #0d6efd;
            font-weight: 600;
            margin-bottom: 2rem;
            font-size: 1.8rem;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-bottom: 0.4rem;
            font-weight: 500;
            color: #495057;
            margin-top: 1rem;
        }
        input[type="text"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 1rem;
            color: #212529;
            resize: vertical;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        input[type="text"]:focus,
        input[type="date"]:focus,
        select:focus,
        textarea:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
            outline: none;
        }
        textarea {
            min-height: 100px;
        }
        button[type="submit"] {
            margin-top: 2rem;
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #0846b9;
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


<h1>Editar Tarea</h1>

<form action="<?= base_url('tarea/actualizar') ?>" method="post">
  <input type="hidden" name="id" value="<?= esc($tarea['id']) ?>">

  <label for="titulo">Título:</label>
  <input
    type="text"
    name="titulo"
    id="titulo"
    value="<?= esc($tarea['titulo']) ?>"
    required
    minlength="3"
    maxlength="100"
    title="Debe tener entre 3 y 100 caracteres"
  >

  <label for="descripcion">Descripción:</label>
  <textarea
    name="descripcion"
    id="descripcion"
    maxlength="500"
    title="Máximo 500 caracteres"
  ><?= esc($tarea['descripcion']) ?></textarea>

  <label for="prioridad">Prioridad:</label>
  <select name="prioridad" id="prioridad" required>
    <option value="baja" <?= $tarea['prioridad'] == 'baja' ? 'selected' : '' ?>>Baja</option>
    <option value="normal" <?= $tarea['prioridad'] == 'normal' ? 'selected' : '' ?>>Normal</option>
    <option value="alta" <?= $tarea['prioridad'] == 'alta' ? 'selected' : '' ?>>Alta</option>
  </select>
  <?php
function formatoInputFecha(?string $fecha): string {
    if (!$fecha) return '';
    $fechaObj = date_create($fecha);
    return $fechaObj ? $fechaObj->format('Y-m-d') : '';
}
?>

  <label for="fecha_vencimiento">Fecha de vencimiento:</label>
<input
  type="date"
  name="fecha_vencimiento"
  id="fecha_vencimiento"
  value="<?= esc(formatoInputFecha($tarea['fecha_vencimiento'] ?? null)) ?>"
  min="<?= date('Y-m-d') ?>"
  title="Debe ser una fecha futura"
/>

<label for="fecha_recordatorio">Fecha de recordatorio (opcional):</label>
<input
  type="date"
  name="fecha_recordatorio"
  id="fecha_recordatorio"
  value="<?= esc(formatoInputFecha($tarea['fecha_recordatorio'] ?? null)) ?>"
  title="Debe ser anterior o igual a la fecha de vencimiento"
/>



  <label for="color">Color (formato #RRGGBB):</label>
  <input
    type="text"
    name="color"
    id="color"
    value="<?= esc($tarea['color']) ?>"
    pattern="^#([A-Fa-f0-9]{6})?$"
    title="Debe estar en formato hexadecimal, por ejemplo #FF0000"
  >

  <button type="submit">Actualizar</button>
</form>


</body>
</html>
