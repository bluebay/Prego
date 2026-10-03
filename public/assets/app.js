'use strict';

document.documentElement.classList.add('js-ready');

const menuButton = document.querySelector('.menu-toggle');
const navigation = document.querySelector('#navigation');
menuButton?.addEventListener('click', () => {
  const expanded = menuButton.getAttribute('aria-expanded') !== 'true';
  menuButton.setAttribute('aria-expanded', String(expanded));
  menuButton.setAttribute('aria-label', expanded ? 'Cerrar menú' : 'Abrir menú');
  navigation.classList.toggle('is-open', expanded);
});
navigation?.querySelectorAll('a').forEach(link => link.addEventListener('click', () => {
  menuButton.setAttribute('aria-expanded', 'false');
  menuButton.setAttribute('aria-label', 'Abrir menú');
  navigation.classList.remove('is-open');
}));

document.querySelectorAll('[data-filter]').forEach(button => {
  button.addEventListener('click', () => {
    document.querySelectorAll('[data-filter]').forEach(other => {
      other.setAttribute('aria-pressed', String(other === button));
    });
    let visibleCount = 0;
    document.querySelectorAll('.product-card').forEach(card => {
      card.hidden = button.dataset.filter !== 'all' && card.dataset.tone !== button.dataset.filter;
      if (!card.hidden) visibleCount++;
    });
    document.querySelector('#filter-status').textContent = `${visibleCount} ${visibleCount === 1 ? 'acabado para descubrir' : 'acabados para descubrir'}`;
  });
});

document.querySelectorAll('[data-product]').forEach(link => {
  link.addEventListener('click', event => {
    // Preserve open-in-new-tab gestures and the ordinary PHP page fallback.
    if (event.ctrlKey || event.metaKey || event.shiftKey || event.altKey || event.button !== 0) return;
    const dialog = document.getElementById(`dialog-${link.dataset.product}`);
    if (dialog && typeof dialog.showModal === 'function') {
      event.preventDefault();
      dialog.showModal();
    }
  });
});

document.querySelectorAll('.product-dialog').forEach(dialog => {
  dialog.addEventListener('click', event => {
    if (event.target !== dialog) return;
    const rect = dialog.getBoundingClientRect();
    if (event.clientX < rect.left || event.clientX > rect.right || event.clientY < rect.top || event.clientY > rect.bottom) dialog.close();
  });
  dialog.querySelectorAll('[data-gallery-image]').forEach(button => {
    button.addEventListener('click', () => {
      const mainImage = dialog.querySelector('.gallery-main');
      mainImage.src = button.dataset.galleryImage;
      mainImage.alt = button.dataset.galleryAlt;
      dialog.querySelectorAll('[data-gallery-image]').forEach(other => other.setAttribute('aria-pressed', String(other === button)));
    });
  });
});

document.querySelectorAll('[data-enquire]').forEach(link => {
  link.addEventListener('click', () => {
    const radio = document.querySelector(`input[name="product"][value="${link.dataset.enquire}"]`);
    if (radio) radio.checked = true;
    const dialog = link.closest('dialog');
    if (dialog?.open) dialog.close();
    // Focus the form after dialog focus restoration, keeping the field visible.
    window.setTimeout(() => document.querySelector('#name')?.focus(), 450);
  });
});

document.querySelector('.form-errors')?.focus();
