# PREGO · Catálogo de cubiertas de mesa

Sitio en PHP, CSS y JavaScript, sin frameworks ni base de datos. No tiene carrito, pagos ni compras dentro del sitio. El formulario prepara una consulta que el visitante revisa y envía desde WhatsApp. También hay contacto directo por correo.

## Abrir localmente

Requiere PHP 8.1 o superior. Desde la carpeta del proyecto:

```powershell
php -S 127.0.0.1:8080 -t public
```

Si usas la copia portátil de PHP preparada para verificar este proyecto:

```powershell
.\.tools\php\php.exe -S 127.0.0.1:8080 -t public
```

Abre http://127.0.0.1:8080. Para detener el servidor, presiona Ctrl+C.

## Personalizar

- `app/config.php`: marca, correo y WhatsApp. Contacto configurado: canepa@bluebay.cl y +56 9 9509 7054.
- `app/products.php`: nombres, acabados, descripciones y galerías. Veta Blanca y Veta Arena son nombres comerciales propuestos a partir de las imágenes existentes.
- `public/assets/style.css`: colores, tipografía y diseño adaptable.
- `public/assets/images/`: imágenes WebP optimizadas; los originales se conservan en `imagenes/`.

No se inventaron precios, medidas, composición, plazos, garantías ni stock. Confirma estos datos antes de incluirlos en el catálogo. Las imágenes en ambiente no implican que la base esté incluida.

## Publicar

Sube `app/` y `public/` al alojamiento PHP y configura la raíz pública del dominio para que apunte a `public/`. Mantén `app/`, las imágenes originales y `.tools/` fuera de la raíz pública. Activa HTTPS. No subas `.tools/`, `.qa/` ni `contact-sheet.jpg`.

El contacto no requiere configurar correo del servidor: usa enlaces `mailto:` y WhatsApp. Todos los campos son opcionales. Con JavaScript, el botón es un enlace directo a `https://api.whatsapp.com/send` que se actualiza con los detalles del formulario. Abre la pantalla oficial de WhatsApp en la misma pestaña, evitando ventanas emergentes y redirecciones de formularios que pueden bloquearse en vistas previas. Sin JavaScript, PHP valida el formulario con protección CSRF y muestra un enlace para abrir WhatsApp. Los datos no se almacenan; el visitante debe confirmar el envío en WhatsApp.

Las fichas también funcionan sin JavaScript (`index.php?producto=veta-blanca`). Los filtros y las galerías en ventanas de detalle se activan con JavaScript. Las tipografías se sirven localmente.
