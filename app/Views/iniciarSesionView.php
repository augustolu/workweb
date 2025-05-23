<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - PickTask</title>
  <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: system-ui, sans-serif;
        background-color: #f8f9fa;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #212529;
    }

    .container {
        display: flex;
        width: 70%;
        max-width: 800px;
        height: auto;
        justify-content: center;
    align-items: center;
        border-radius: 12px;
        border: 1px solid #dee2e6;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        background: #ffffff;
        flex-wrap: wrap;
    }

    .login-box,
    .register-box {
        width: 50%;
        padding: 2rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .login-box {
        background-color: #ffffff;
        color: #212529;
    }

    .register-box {
        background-color: #ffffff;
        color: #212529;
        display: none;
    }

    .login-box h2,
    .register-box h2 {
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
        text-align: center;
        color: #0d6efd;
    }

    .login-box label,
    .register-box label {
        display: block;
        margin: 0.75rem 0 0.25rem;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .login-box input,
    .register-box input {
        width: 100%;
        padding: 0.5rem 0.75rem;
        margin-bottom: 1rem;
        border-radius: 6px;
        border: 1px solid #ced4da;
        font-size: 0.95rem;
    }

    .button-container {
        display: flex;
        justify-content: flex-end;
    }

    .login-box button,
    .register-box button {
        padding: 0.5rem 1rem;
        background-color: #0d6efd;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .login-box button:hover,
    .register-box button:hover {
        background-color: #0b5ed7;
    }

    .toggle-container {
        text-align: center;
        margin-top: 1.5rem;
    }

    .toggle-container a {
        color: #0d6efd;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .toggle-container a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .container {
            flex-direction: column;
            height: auto;
        }

        .login-box,
        .register-box {
            width: 100%;
            padding: 1.5rem;
        }

        .button-container {
            justify-content: center;
        }
    }
</style>

</head>
<body>
  <div class="container">
    <!-- Login -->
    <div class="login-box">
      <h2>Iniciar Sesión</h2>

      <?php if (session()->getFlashdata('error')): ?>
        <div class="alert" style="color: white; background-color: #e74c3c; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
          <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>

      <form action="<?= base_url('usuario/autenticar') ?>" method="post">
        <label for="correo">Correo electrónico:</label>
        <input type="email" id="correo" name="correo" value="<?= old('correo') ?>" required>

        <label for="clave">Contraseña:</label>
        <input type="password" id="clave" name="clave" required>

        <div class="button-container">
          <button type="submit">Ingresar</button>
        </div>
      </form>

      <div class="toggle-container">
        <a href="#" onclick="toggleRegister()">¿No tienes cuenta? Regístrate</a>
      </div>
    </div>

    <!-- Registro -->
    <div class="register-box" style="display: none;">
      <h2>Registrarse</h2>
      <form action="<?= base_url('usuario/guardarRegistro') ?>" method="post">
        <label for="nombre">Nombre completo:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="correo">Correo electrónico:</label>
        <input type="email" id="correo" name="correo" required>

        <label for="clave">Contraseña:</label>
        <input type="password" id="clave" name="clave" required>

        <div class="button-container">
          <button type="submit">Registrarse</button>
        </div>
      </form>

      <div class="toggle-container">
        <a href="#" onclick="toggleLogin()">¿Ya tienes cuenta? Inicia sesión</a>
      </div>
    </div>
  </div>

  <script>
    function toggleRegister() {
      document.querySelector('.login-box').style.display = 'none';
      document.querySelector('.register-box').style.display = 'flex';
    }

    function toggleLogin() {
      document.querySelector('.login-box').style.display = 'flex';
      document.querySelector('.register-box').style.display = 'none';
    }
  </script>
</body>

</html>
