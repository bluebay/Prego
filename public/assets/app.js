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
    radio?.dispatchEvent(new Event('change', { bubbles: true }));
    const dialog = link.closest('dialog');
    if (dialog?.open) dialog.close();
    // Focus the form after dialog focus restoration, keeping the field visible.
    window.setTimeout(() => document.querySelector('#name')?.focus(), 450);
  });
});

document.querySelector('.form-errors')?.focus();

const contactForm = document.querySelector('.contact-form');
const whatsappLink = document.querySelector('#whatsapp-consult');
const whatsappFallback = document.querySelector('#whatsapp-same-tab');
const whatsappFeedback = document.querySelector('#whatsapp-feedback');
const emailInput = contactForm?.querySelector('#email');
const emailError = document.querySelector('#email-error');

if (contactForm && whatsappLink) {
  const updateWhatsapp = () => {
    const values = new FormData(contactForm);
    const name = String(values.get('name') ?? '').trim();
    const email = String(values.get('email') ?? '').trim();
    const dimensions = String(values.get('dimensions') ?? '').trim();
    const message = String(values.get('message') ?? '').trim();
    const product = contactForm.querySelector('input[name="product"]:checked')?.dataset.productLabel ?? 'Asesoría para elegir una cubierta';
    let text = `${name ? `Hola PREGO, soy ${name}.` : 'Hola PREGO.'} Me gustaría cotizar una cubierta de mesa.\nAcabado: ${product}.`;
    if (dimensions) text += `\nMedidas aproximadas: ${dimensions}.`;
    if (email) text += `\nMi correo: ${email}.`;
    if (message) text += `\n${message}`;
    const url = `https://api.whatsapp.com/send?phone=${contactForm.dataset.whatsappNumber}&text=${encodeURIComponent(text)}`;
    whatsappLink.href = url;
    whatsappFallback.href = url;
  };
  const showEmailError = () => {
    const invalid = !emailInput.validity.valid;
    emailError.hidden = !invalid;
    if (invalid) emailInput.setAttribute('aria-invalid', 'true');
    else emailInput.removeAttribute('aria-invalid');
  };
  contactForm.addEventListener('input', () => {
    updateWhatsapp();
    // Clear feedback while the visitor corrects an error.
    if (emailInput.validity.valid) showEmailError();
    whatsappFeedback.hidden = true;
  });
  contactForm.addEventListener('change', updateWhatsapp);
  emailInput.addEventListener('blur', showEmailError);
  whatsappLink.addEventListener('click', event => {
    showEmailError();
    if (!contactForm.reportValidity()) {
      event.preventDefault();
      return;
    }
    // Use a real external link, rather than a server redirect or a scripted popup.
    updateWhatsapp();
    whatsappFeedback.hidden = false;
  });
  updateWhatsapp();
  contactForm.querySelector('button[type="submit"]').hidden = true;
  whatsappLink.hidden = false;
}

document.querySelector('.whatsapp-prepared')?.focus();
