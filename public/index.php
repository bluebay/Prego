<?php require __DIR__ . '/../app/bootstrap.php'; ?>
<!doctype html>
<html lang="es-CL">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Descubre las cubiertas de mesa PREGO. Acabados marmolados para transformar tu comedor. Explora el catálogo y solicita una cotización personalizada.">
    <meta name="theme-color" content="#f4f3ee">
    <title><?= $selectedProduct ? e($selectedProduct['name']) . ' — ' : '' ?>PREGO · Cubiertas para compartir</title>
    <link rel="icon" href="assets/favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/app.js" defer></script>
</head>
<body>
<a class="skip-link" href="#contenido">Saltar al contenido</a>
<div class="announcement">Una nueva mirada para tu mesa. <a href="#coleccion">Descubre la colección <span aria-hidden="true">↗</span></a></div>
<header class="header">
    <a class="brand" href="index.php" aria-label="PREGO, inicio">prego<span>.</span><small>CUBIERTAS & DISEÑO</small></a>
    <button class="menu-toggle" type="button" aria-label="Abrir menú" aria-controls="navigation" aria-expanded="false"><span></span><span></span></button>
    <nav id="navigation" aria-label="Navegación principal">
        <a href="index.php#coleccion">La colección</a><a href="index.php#inspiracion">Inspiración</a><a href="index.php#proceso">Cómo cotizar</a>
    </nav>
    <a class="header-contact" href="#contacto">Hablemos de tu mesa <span aria-hidden="true">↗</span></a>
</header>
<main id="contenido">
    <?php if ($selectedProduct): ?>
    <section class="standalone-product container" aria-labelledby="selected-title">
        <a class="text-link" href="index.php#coleccion">← Volver a la colección</a>
        <div class="standalone-grid">
            <img src="assets/images/<?= e($selectedProduct['image']) ?>.webp" alt="Cubierta <?= e($selectedProduct['name']) ?>" width="1200" height="896">
            <div><p class="eyebrow">LA COLECCIÓN / PREGO</p><h1 id="selected-title"><?= e($selectedProduct['name']) ?></h1><p><?= e($selectedProduct['description']) ?></p><p class="muted">Medidas, composición, disponibilidad y precio se confirman al cotizar. Las fotografías muestran referencias del acabado.</p><a class="button" href="<?= e(whatsapp('Hola PREGO, me interesa cotizar la cubierta ' . $selectedProduct['name'] . '.')) ?>" rel="noreferrer">Consultar por WhatsApp <span aria-hidden="true">↗</span></a></div>
        </div>
        <div class="standalone-gallery"><?php foreach ($selectedProduct['gallery'] as $i => $image): ?><img src="assets/images/<?= e($image) ?>.webp" alt="<?= e($selectedProduct['gallery_labels'][$i]) ?>" width="1200" height="896" loading="lazy"><?php endforeach ?></div>
    </section>
    <?php elseif ($selectedId !== null): ?>
    <section class="container error-page"><h1>No encontramos esa cubierta.</h1><a class="button" href="index.php#coleccion">Explorar la colección</a></section>
    <?php else: ?>
    <section class="hero" aria-labelledby="hero-title">
        <div class="hero-copy">
            <p class="eyebrow"><span class="little-line"></span> CUBIERTAS PARA COMPARTIR</p>
            <h1 id="hero-title">Hay mesas.<br>Y hay puntos<br>de <em>encuentro.</em></h1>
            <p class="hero-description">Dale una nueva vida a tu espacio con una cubierta que invite a quedarse.</p>
            <a class="button" href="#coleccion">Explora la colección <span aria-hidden="true">↗</span></a>
            <div class="hero-bottom"><span>Diseño que se siente en casa.</span><a href="#coleccion" aria-label="Bajar a la colección">↓</a></div>
        </div>
        <div class="hero-image">
            <img src="assets/images/hero.webp" alt="Mesa de comedor con cubierta blanca de vetas oscuras, base negra y cuatro sillas" width="1800" height="1344" fetchpriority="high">
            <span class="image-label">ESPACIOS CON CARÁCTER</span>
            <a class="hero-image-note" href="index.php?producto=veta-blanca" data-product="veta-blanca"><span><small>EN ESTA IMAGEN</small>Veta Blanca</span><span aria-hidden="true">↗</span></a>
        </div>
    </section>
    <div class="benefit-strip"><span><svg aria-hidden="true"><use href="#icon-design"/></svg> Acabados con personalidad</span><span><svg aria-hidden="true"><use href="#icon-measure"/></svg> Tu proyecto, tus medidas</span><span><svg aria-hidden="true"><use href="#icon-chat"/></svg> Asesoría de persona a persona</span></div>
    <section class="collection container" id="coleccion" aria-labelledby="collection-title">
        <div class="section-heading"><div><p class="eyebrow">01 / LA COLECCIÓN</p><h2 id="collection-title">Una superficie.<br><em>Muchas posibilidades.</em></h2></div><p>Texturas, tonos y detalles que cambian<br class="desktop-break"> la forma de habitar tu espacio.</p></div>
        <div class="collection-tools"><div class="filters" role="group" aria-label="Filtrar por tono"><button type="button" data-filter="all" aria-pressed="true">Todos los acabados <span>02</span></button><button type="button" data-filter="claros" aria-pressed="false">Tonos claros</button><button type="button" data-filter="calidos" aria-pressed="false">Tonos cálidos</button></div><span class="collection-caption" id="filter-status" aria-live="polite">2 acabados para descubrir</span></div>
        <div class="product-grid">
            <?php foreach ($products as $id => $product): ?>
            <article class="product-card" data-tone="<?= e($product['tone']) ?>">
                <a class="product-image" href="index.php?producto=<?= e($id) ?>" data-product="<?= e($id) ?>" aria-label="Ver detalles de <?= e($product['name']) ?>"><img src="assets/images/<?= e($product['image']) ?>.webp" alt="Cubierta rectangular de acabado <?= e($product['finish']) ?>" width="1448" height="1086" loading="lazy"><span class="product-tag"><?= e($product['tag']) ?></span><span class="product-arrow" aria-hidden="true">↗</span></a>
                <div class="product-info"><div><p class="eyebrow">CUBIERTA DE MESA</p><h3><a href="index.php?producto=<?= e($id) ?>" data-product="<?= e($id) ?>"><?= e($product['name']) ?></a></h3><p class="product-finish"><span class="swatch <?= e($product['tone']) ?>"></span><?= e($product['finish']) ?></p></div><a class="product-consult" href="#contacto" data-enquire="<?= e($id) ?>">Cotizar <span aria-hidden="true">↗</span></a></div>
            </article>
            <?php endforeach ?>
        </div>
        <p class="collection-footnote">Encuentra tu acabado. Conversemos sobre medidas, materiales y disponibilidad para tu proyecto.</p>
    </section>
    <section class="inspiration" id="inspiracion" aria-labelledby="inspiration-title">
        <div class="inspiration-photo"><img src="assets/images/detalle.webp" alt="Detalle de la cubierta marmolada sobre una base metálica negra" width="1800" height="1344" loading="lazy"><span>EL DISEÑO ESTÁ EN LOS DETALLES.</span></div>
        <div class="inspiration-copy"><p class="eyebrow">02 / UNA NUEVA MIRADA</p><h2 id="inspiration-title">El cambio empieza<br>en <em>tu mesa.</em></h2><p>Un café sin apuro. Una conversación que se alarga. Una cena con los de siempre.</p><p>Creemos en espacios que se disfrutan. Por eso, nuestra colección pone el acento en lo que ves, lo que sientes y lo que compartes.</p><a class="text-link" href="#contacto">Encuentra la cubierta para tu espacio <span aria-hidden="true">↗</span></a><span class="big-asterisk" aria-hidden="true">✳</span></div>
    </section>
    <section class="process container" id="proceso" aria-labelledby="process-title"><div class="section-heading"><div><p class="eyebrow">03 / DE LA IDEA A TU ESPACIO</p><h2 id="process-title">Tu próxima mesa,<br><em>paso a paso.</em></h2></div><p>Te acompañamos a elegir.<br>Sin compras ni pagos en el sitio.</p></div><ol class="steps"><li><span class="step-number">01</span><svg aria-hidden="true"><use href="#icon-design"/></svg><h3>Encuentra tu estilo</h3><p>Explora los acabados y descubre cuál conversa mejor con tu espacio.</p></li><li><span class="step-number">02</span><svg aria-hidden="true"><use href="#icon-measure"/></svg><h3>Cuéntanos tu idea</h3><p>Comparte tus medidas aproximadas, el uso que le darás y el acabado que te gusta.</p></li><li><span class="step-number">03</span><svg aria-hidden="true"><use href="#icon-chat"/></svg><h3>Conversemos los detalles</h3><p>Consulta materiales, precio y disponibilidad. La cotización se coordina directamente con nosotros.</p></li></ol></section>
    <section class="faq container" aria-labelledby="faq-title"><div><p class="eyebrow">BUENO SABERLO</p><h2 id="faq-title">Antes de elegir.</h2></div><div class="faq-list"><details><summary>¿Cómo puedo cotizar una cubierta?<span aria-hidden="true">+</span></summary><p>Elige un acabado y escríbenos por WhatsApp o correo. Si puedes, incluye las medidas aproximadas y una fotografía de tu mesa o espacio.</p></details><details><summary>¿Qué medidas y materiales tienen?<span aria-hidden="true">+</span></summary><p>Las medidas, el espesor y la composición se confirman en la cotización de cada cubierta. Cuéntanos qué necesitas para revisar las opciones disponibles.</p></details><details><summary>¿Las cubiertas incluyen la base?<span aria-hidden="true">+</span></summary><p>Las fotografías en ambiente son una referencia de cómo se ve el acabado. Consulta por separado la disponibilidad de bases y qué incluye la cotización.</p></details><details><summary>¿Puedo comprar a través del sitio?<span aria-hidden="true">+</span></summary><p>Este sitio es un catálogo. La cotización, las condiciones de entrega y cualquier compra se coordinan directamente con nuestro equipo.</p></details></div></section>
    <?php endif ?>
    <section class="contact" id="contacto" aria-labelledby="contact-title"><div class="contact-inner container"><div class="contact-copy"><p class="eyebrow">HAGAMOS ESPACIO PARA TU IDEA</p><h2 id="contact-title">Una buena mesa<br>empieza con una<br><em>conversación.</em></h2><p>Cuéntanos qué estás imaginando.<br>Te ayudamos a encontrar tu cubierta.</p><a class="contact-direct" href="<?= e(whatsapp('Hola PREGO, me gustaría consultar por las cubiertas de mesa.')) ?>" rel="noreferrer"><svg aria-hidden="true"><use href="#icon-chat"/></svg><?= e($config['phone_display']) ?> <span aria-hidden="true">↗</span></a><a class="contact-direct" href="mailto:<?= e($config['email']) ?>"><svg aria-hidden="true"><use href="#icon-mail"/></svg><?= e($config['email']) ?> <span aria-hidden="true">↗</span></a></div>
        <form class="contact-form" action="index.php#contacto" method="post" data-whatsapp-number="<?= e($config['whatsapp']) ?>">
            <h3>Hablemos de tu proyecto</h3><p class="form-intro">Puedes consultar directamente o agregar detalles a tu mensaje. Todos los campos son opcionales.</p>
            <?php if ($errors): ?><div class="form-errors" role="alert" tabindex="-1"><strong>Revisa tu consulta</strong><ul><?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach ?></ul></div><?php endif ?>
            <?php if ($preparedWhatsapp): ?><div class="whatsapp-prepared" tabindex="-1"><p>Tu consulta está lista para enviar.</p><a class="text-link" href="<?= e($preparedWhatsapp) ?>" rel="noreferrer">Abrir WhatsApp <span aria-hidden="true">↗</span></a></div><?php endif ?>
            <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>"><div class="honeypot" aria-hidden="true"><label for="website">Sitio web</label><input id="website" name="website" tabindex="-1" autocomplete="off"></div>
            <div class="form-row"><div class="field"><label for="name">Tu nombre <span>(opcional)</span></label><input id="name" name="name" autocomplete="name" placeholder="¿Cómo te llamas?" maxlength="80" value="<?= e($values['name']) ?>"></div><div class="field"><label for="email">Correo <span>(opcional)</span></label><input type="email" id="email" name="email" autocomplete="email" placeholder="tu@correo.cl" maxlength="254" aria-describedby="email-error" value="<?= e($values['email']) ?>"><span id="email-error" class="field-error" hidden>Revisa el correo o déjalo vacío para continuar.</span></div></div>
            <fieldset class="finish-choice"><legend>¿Qué acabado te interesa?</legend><div class="radio-options"><?php foreach (['asesoria' => 'Quiero asesoría', 'veta-blanca' => 'Veta Blanca', 'veta-arena' => 'Veta Arena'] as $id => $label): ?><label><input type="radio" name="product" value="<?= e($id) ?>" data-product-label="<?= e($products[$id]['name'] ?? 'Asesoría para elegir una cubierta') ?>" <?= $values['product'] === $id ? 'checked' : '' ?>><?= e($label) ?></label><?php endforeach ?></div></fieldset>
            <div class="field"><label for="dimensions">Medidas aproximadas <span>(opcional)</span></label><input id="dimensions" name="dimensions" placeholder="Ej. 160 × 90 cm" maxlength="80" value="<?= e($values['dimensions']) ?>"></div>
            <div class="field"><label for="message">Cuéntanos un poco más <span>(opcional)</span></label><textarea id="message" name="message" rows="3" maxlength="1000" placeholder="Tu espacio, tu idea o lo que te gustaría saber…"><?= e($values['message']) ?></textarea></div>
            <button class="button contact-submit" type="submit">Consultar por WhatsApp <span aria-hidden="true">↗</span></button>
            <a class="button contact-submit" id="whatsapp-consult" href="<?= e(whatsapp(consultation_message($values))) ?>" rel="noreferrer" hidden>Consultar por WhatsApp <span aria-hidden="true">↗</span></a>
            <div class="whatsapp-feedback" id="whatsapp-feedback" role="status" hidden><p>Tu consulta está lista. Si WhatsApp no se abrió, <a id="whatsapp-same-tab" href="<?= e(whatsapp(consultation_message($values))) ?>">ábrelo en esta pestaña</a> o usa tu navegador habitual.</p><p>No se ha enviado ningún mensaje todavía.</p></div>
            <p class="form-note">Se abrirá WhatsApp con tu mensaje para que lo revises y envíes. No guardamos los datos de este formulario.</p>
        </form></div></section>
</main>
<footer class="footer container"><div class="footer-top"><a class="brand" href="index.php">prego<span>.</span><small>CUBIERTAS & DISEÑO</small></a><p>Diseño para estar.<br>Mesas para compartir.</p><a href="#contenido">Volver arriba <span aria-hidden="true">↑</span></a></div><div class="footer-bottom"><span>© <?= date('Y') ?> PREGO. Todos los derechos reservados.</span><span>Catálogo de cubiertas de mesa · Cotización personalizada</span></div></footer>
<?php foreach ($products as $id => $product): ?>
<dialog class="product-dialog" id="dialog-<?= e($id) ?>" aria-labelledby="title-<?= e($id) ?>"><form method="dialog" class="dialog-close-form"><button class="dialog-close" aria-label="Cerrar detalles de <?= e($product['name']) ?>">×</button></form><div class="dialog-grid"><div class="dialog-gallery"><img class="gallery-main" src="assets/images/<?= e($product['image']) ?>.webp" alt="<?= e($product['gallery_labels'][0]) ?>" width="1200" height="896" loading="lazy"><div class="thumbnails"><?php foreach ($product['gallery'] as $i => $image): ?><button type="button" data-gallery-image="assets/images/<?= e($image) ?>.webp" data-gallery-alt="<?= e($product['gallery_labels'][$i]) ?>" aria-label="<?= e($product['gallery_labels'][$i]) ?>" aria-pressed="<?= $i === 0 ? 'true' : 'false' ?>"><img src="assets/images/<?= e($image) ?>.webp" alt="" width="120" height="90" loading="lazy"></button><?php endforeach ?></div></div><div class="dialog-copy"><p class="eyebrow">LA COLECCIÓN / PREGO</p><h2 id="title-<?= e($id) ?>"><?= e($product['name']) ?></h2><p class="product-finish"><span class="swatch <?= e($product['tone']) ?>"></span><?= e($product['finish']) ?></p><p><?= e($product['description']) ?></p><dl><div><dt>Acabado visual</dt><dd>Marmolado</dd></div><div><dt>Medidas y materiales</dt><dd>Consultar opciones</dd></div><div><dt>Precio y disponibilidad</dt><dd>Cotización personalizada</dd></div></dl><a class="button" href="#contacto" data-enquire="<?= e($id) ?>">Cotizar esta cubierta <span aria-hidden="true">↗</span></a><p class="dialog-note">Las imágenes son referencias del acabado. Las bases y accesorios se consultan por separado.</p></div></div></dialog>
<?php endforeach ?>
<svg class="icon-definitions" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><symbol id="icon-design" viewBox="0 0 24 24"><path d="M4 6h16v12H4zM8 6v12m0-4 7-8m-3 12 8-9"/></symbol><symbol id="icon-measure" viewBox="0 0 24 24"><path d="M3 7h18v10H3zM7 7v4m4-4v3m4-3v4m4-4v3"/></symbol><symbol id="icon-chat" viewBox="0 0 24 24"><path d="M21 11.5a9 9 0 0 1-9 9 10 10 0 0 1-4-1L3 21l1.5-5a9 9 0 1 1 16.5-4.5Z"/><path d="M8 9c1 4 3 6 7 7l2-2-3-2-1 1-2-2 1-1-2-3-2 2Z"/></symbol><symbol id="icon-mail" viewBox="0 0 24 24"><path d="M3 5h18v14H3zM3 5l9 8 9-8"/></symbol></svg>
</body>
</html>

