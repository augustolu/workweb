<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingresar Código de Invitación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
    background-color: #f8f9fa;
    font-family: system-ui, sans-serif;
    color: #212529;
    margin: 0;
}

.form-container {
    max-width: 500px;
    margin: 4rem auto;
    padding: 2rem;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
    border: 1px solid #dee2e6; 
}

h2.titulo-principal {
    text-align: center;
    margin-bottom: 1.5rem;
    color: #0d6efd; 
    font-size: 1.5rem;
    font-weight: 600;
}

.btn-enviar {
    background-color: #0d6efd; 
    border: none;
    color: white;
    padding: 0.6rem 1.2rem;
    font-weight: 600;
    border-radius: 6px;
    transition: background-color 0.3s ease;
    cursor: pointer;
}

.btn-enviar:hover {
    background-color: #0846b9; 
}

.form-container input[type="text"],
.form-container input[type="email"],
.form-container input[type="password"],
.form-container textarea {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #ced4da;
    border-radius: 6px;
    font-size: 0.9rem;
    margin-bottom: 1rem;
    box-sizing: border-box;
}

.form-container label {
    display: block;
    font-weight: 500;
    margin-bottom: 0.3rem;
    color: #495057;
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


    <div class="form-container">
        <h2 class="titulo-principal">Ingresar código de invitación</h2>

        <form action="<?= base_url('invitacion/verificar') ?>" method="post">
            <div class="mb-3">
                <label for="codigo" class="form-label">Código:</label>
                <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Ej. ABCD1234" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn-enviar">Verificar</button>
            </div>
        </form>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
<?php endif; ?>

</body>
</html>
