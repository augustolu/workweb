/**
 * Page Transitions Script
 * Agrega un efecto de difuminado (fade in/out) suave entre páginas.
 * Diseñado para ser lo más simple posible para que cualquier programador pueda leerlo.
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Efecto Fade-In al cargar la página
    document.body.classList.add('page-transition-enter');

    // 2. Interceptar todos los enlaces (<a>) que no abran en otra pestaña
    const links = document.querySelectorAll('a[href]:not([target="_blank"])');

    links.forEach(link => {
        link.addEventListener('click', function (e) {
            const href = this.getAttribute('href');

            // Ignorar enlaces vacíos, anclas (#) o javascript:history.back()
            if (!href || href.startsWith('#') || href.includes('javascript:')) {
                return;
            }

            e.preventDefault(); // Prevenir el salto brusco de página

            // Agregar la clase de salida (Fade-Out)
            document.body.classList.remove('page-transition-enter');
            document.body.classList.add('page-transition-exit');

            // Esperar a que termine la animación (300ms) antes de redirigir
            setTimeout(() => {
                window.location.href = href;
            }, 300);
        });
    });

    // 3. Soporte para el botón "Volver Atras"
    // Interceptamos específicamente los clics que usan history.back
    const backButtons = document.querySelectorAll('a[href*="javascript:history.back()"]');
    backButtons.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            document.body.classList.remove('page-transition-enter');
            document.body.classList.add('page-transition-exit');

            setTimeout(() => {
                window.history.back();
            }, 300);
        });
    });

    // 4. Soporte para navegacion desde el historial del navegador (botón flecha del navegador)
    window.addEventListener('pageshow', function (event) {
        if (event.persisted) { // Si la página se está restaurando desde la caché (bfcache)
            document.body.classList.remove('page-transition-exit');
            document.body.classList.add('page-transition-enter');
        }
    });
});
