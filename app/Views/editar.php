<!DOCTYPE html>
<html>
<head>
    <title>Editar Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: system-ui, sans-serif;
            color: #212529;
            margin: 0;
            padding-top: 3rem;
        }
        h2 {
            color: #0d6efd;
            font-weight: 600;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1.8rem;
        }
        form {
            max-width: 480px;
            margin: 0 auto;
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        label {
            font-weight: 500;
            color: #495057;
        }
        input.form-control {
            border-radius: 6px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        input.form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
        }
        button.btn-primary {
            background-color: #0d6efd;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            padding: 0.5rem 1.2rem;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        button.btn-primary:hover {
            background-color: #0846b9;
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
<body class="container">

<a href="javascript:history.back()" class="btn-volver">← Volver atrás</a>

<h2>Editar Perfil</h2>

<form method="post" action="<?= site_url('usuario/editarguardar') ?>">
  <div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input
      type="text"
      name="nombre"
      id="nombre"
      class="form-control"
      value="<?= esc($usuario['nombre']) ?>"
      required
      minlength="3"
      maxlength="50"
      pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+"
      title="El nombre solo puede contener letras y espacios"
    >
  </div>

  <div class="mb-3">
    <label for="correo" class="form-label">Correo</label>
    <input
      type="email"
      name="correo"
      id="correo"
      class="form-control"
      value="<?= esc($usuario['correo']) ?>"
      required
      maxlength="100"
    >
  </div>

  <div class="mb-3">
    <label for="contrasenia" class="form-label">Contraseña</label>
    <input
      type="password"
      name="contrasenia"
      id="contrasenia"
      class="form-control"
      placeholder="Nueva contraseña"
      required
      minlength="8"
      maxlength="64"
      pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+"
      title="Debe contener al menos una mayúscula, una minúscula y un número"
    >
  </div>

  <button type="submit" class="btn btn-primary">Guardar cambios</button>
</form>


</body>
</html>
