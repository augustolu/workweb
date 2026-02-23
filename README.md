# WorkWeb

Este sistema fue desarrollado como uno de los proyectos finales para la carrera de **Tecnicatura Universitaria en Web**. Su objetivo principal es demostrar las competencias adquiridas aplicando las herramientas tecnológicas brindadas por la universidad: **PHP, CodeIgniter y SQL**.

### Descripción
WorkWeb es una solución escalable para la gestión de proyectos estructurada bajo el patrón MVC. Permite la administración de equipos dinámicos, flujos de trabajo colaborativos y la segmentación jerárquica de tareas y subtareas.

### Stack Tecnológico y Requisitos
* **Lenguaje:** PHP 8.1+
* **Framework:** CodeIgniter 4 (MVC)
* **Base de Datos:** MySQL
* **Entorno Local:** XAMPP (requerido para Apache y MySQL) -> https://sourceforge.net/projects/xampp/files/latest/download
* **Gestor de Dependencias:** Composer -> https://getcomposer.org/download/

### Funcionalidades Clave
1.  **Colaboración Jerárquica:** Desglose operativo en tareas y subtareas con control lógico de estados.
2.  **Gestión de Equipos:** Sistema de invitaciones asíncronas para colaboradores y asignación granular de recursos.
3.  **Arquitectura MVC:** Separación estricta entre la lógica de negocio (Controllers) y la manipulación de datos (Models).

### Base de Datos
>   **Nota importante:** Todo lo relacionado con la base de datos SQL (esquema relacional, sintaxis de creación de tablas e instrucciones detalladas) se encuentra documentado dentro de la sección de **Issues** de este repositorio.

### Requisitos
>   **Extensión PHP**: La extensión `intl` debe estar habilitada en el archivo `php.ini`.
1. **Localizar php.ini:**
   En XAMPP: Suele estar en C:\xampp\php\php.ini.
   
3. **Habilitar la extensión:**
   Abre el archivo php.ini con un editor de texto.
   Busca la línea ;extension=intl.
   Quita el punto y coma (;) del principio para que quede así: extension=intl.
   Guarda el archivo y reinicia tu servidor (Apache/PHP).

### Instalación Rápida

1. **Clonar repositorio e instalar dependencias:**
```
git init
git clone [https://github.com/tu-usuario/workweb.git](https://github.com/tu-usuario/workweb.git)
cd workweb
composer install
```

2. **Configurar entorno:**
   Copia el archivo env a .env y configura tus credenciales de MySQL (asegúrate de tener encendido el módulo MySQL en XAMPP):

```
database.default.hostname = localhost
database.default.database = workweb_db
database.default.username = tu_usuario
database.default.password = tu_contraseña
database.default.DBDriver = MySQLi
```



3. **Ejecutar:**
   Con el servidor XAMPP corriendo, levanta el proyecto ejecutando el siguiente comando en la raíz:

```
php spark serve
```

---
**Autor:** A.L.P  
*Full-Stack Web Developer*
