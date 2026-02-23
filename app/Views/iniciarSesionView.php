<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PickTask</title>
    <!-- Importar tipografía moderna de Apple/Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    
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

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-primary);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .container {
            width: 100%;
            max-width: 440px; /* Ancho ajustado para tarjeta estilo Apple */
            margin: 2rem;
        }

        .card {
            background: var(--card-bg);
            border-radius: 16px; /* Bordes redondeados pronunciados */
            border: none;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06); /* Sombra amplia y difuminada */
            padding: 3rem; /* Doble espaciado (Respiro Visual) */
            transition: all 0.3s ease;
        }

        .login-box,
        .register-box {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .register-box {
            display: none;
        }

        h2 {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 2rem;
            text-align: center;
            letter-spacing: -0.02em;
        }

        .alert {
            background-color: #fce8e6;
            color: #d93025;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            font-weight: 400;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1.5rem; /* Doble margen entre campos */
        }

        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
            letter-spacing: 0.01em;
        }

        input {
            width: 100%;
            padding: 1rem 1.25rem; /* Padding amplio */
            font-size: 1rem;
            color: var(--text-primary);
            background-color: var(--bg-color); /* Fondo ligeramente gris dentro del input */
            border: 1px solid transparent;
            border-radius: 12px; /* Bordes inputs más amigables */
            transition: all 0.2s ease;
            outline: none;
        }

        input:focus {
            background-color: var(--card-bg);
            border-color: var(--apple-blue);
            box-shadow: 0 0 0 4px var(--focus-ring);
        }

        input::placeholder {
            color: #a1a1a6;
        }

        .button-container {
            margin-top: 2rem;
        }

        button {
            width: 100%;
            padding: 1rem; /* Padding amplio */
            font-size: 1rem;
            font-weight: 600;
            color: #ffffff;
            background-color: var(--apple-blue);
            border: none;
            border-radius: 999px; /* Estilo pastilla perfecto */
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.1s ease;
            letter-spacing: 0.01em;
        }

        button:hover {
            background-color: var(--apple-blue-hover);
        }

        button:active {
            transform: scale(0.98);
        }

        .toggle-container {
            text-align: center;
            margin-top: 2rem;
        }

        .toggle-container a {
            color: var(--apple-blue);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 400;
            transition: color 0.2s ease;
        }

        .toggle-container a:hover {
            text-decoration: underline;
            color: var(--apple-blue-hover);
        }

        .page-transition-enter {
            opacity: 1;
        }

        .page-transition-exit {
            opacity: 0;
            transform: scale(0.98);
        }

        /* Utilidad para inyectar estilo en línea desde PHP de forma limpia */
        .show { display: flex !important; }
        .hide { display: none !important; }

        @media (max-width: 480px) {
            .card {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body class="page-transition">

<div class="container">
    <div class="card">
        <!-- Contenedor general dinámico según PHP -->
        <?php $isRegister = isset($showRegister) && $showRegister; ?>

        <!-- Login -->
        <div class="login-box <?= $isRegister ? 'hide' : 'show' ?>">
            <h2>Iniciar Sesión</h2>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('usuario/autenticar') ?>" method="post">
                <div class="form-group">
                    <label for="correo">Correo electrónico</label>
                    <input type="email" id="correo" name="correo" value="<?= old('correo') ?>" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Ingrese un correo válido" placeholder="nombre@ejemplo.com">
                </div>

                <div class="form-group">
                    <label for="clave">Contraseña</label>
                    <input type="password" id="clave" name="clave" required minlength="8" title="Mínimo 8 caracteres" placeholder="••••••••">
                </div>

                <div class="button-container">
                    <button type="submit">Continuar</button>
                </div>
            </form>

            <div class="toggle-container">
                <a href="#" onclick="toggleView('register')">¿No tienes cuenta? Crea una ahora</a>
            </div>
        </div>

        <!-- Registro -->
        <div class="register-box <?= $isRegister ? 'show' : 'hide' ?>">
            <h2>Crear ID de Tareas</h2>
            
            <?php if (session()->getFlashdata('registro_error')): ?>
                <div class="alert">
                    <?= session()->getFlashdata('registro_error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('usuario/guardarRegistro') ?>" method="post">
                <div class="form-group">
                    <label for="nombre">Nombre completo</label>
                    <input type="text" id="nombre" name="nombre" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{3,50}" title="Solo letras y espacios (3-50 caracteres)" placeholder="Escribe tu primer y segundo nombre">
                </div>

                <div class="form-group">
                    <label for="correo_registro">Correo electrónico</label>
                    <input type="email" id="correo_registro" name="correo" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Ingrese un correo válido" placeholder="nombre@ejemplo.com">
                </div>

                <div class="form-group">
                    <label for="clave_registro">Contraseña</label>
                    <input type="password" id="clave_registro" name="clave" required minlength="8" pattern="^(?=.*[A-Z])(?=.*\d).{8,}$" title="Mínimo 8 caracteres, 1 mayúscula y 1 número" placeholder="Mínimo 8 caracteres, 1 mayús. y 1 núm.">
                </div>

                <div class="button-container">
                    <button type="submit">Registrarse</button>
                </div>
            </form>

            <div class="toggle-container">
                <a href="#" onclick="toggleView('login')">¿Ya tienes cuenta? Inicia sesión</a>
            </div>
        </div>

    </div>
</div>

<script>
    function toggleView(view) {
        const loginBox = document.querySelector('.login-box');
        const registerBox = document.querySelector('.register-box');

        if (view === 'register') {
            loginBox.classList.remove('show');
            loginBox.classList.add('hide');
            registerBox.classList.remove('hide');
            registerBox.classList.add('show');
        } else {
            registerBox.classList.remove('show');
            registerBox.classList.add('hide');
            loginBox.classList.remove('hide');
            loginBox.classList.add('show');
        }
    }
</script>

<script src="<?= base_url('js/page-transitions.js') ?>"></script>
</body>
</html>
