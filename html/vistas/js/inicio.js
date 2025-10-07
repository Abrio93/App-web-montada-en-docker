
//? Para visualizar la imagen ampliada en un modal al hacer clic en una miniatura y hacer navegación entre imágenes de la misma publicación.

document.addEventListener("DOMContentLoaded", function() {
  // Modal Bootstrap
  const modalEl = document.getElementById('visorImagen');
  const bsModal = new bootstrap.Modal(modalEl, {});
  const imagenAmpliada = document.getElementById('imagenAmpliada');
  const btnPrev = document.getElementById('btnPrev');
  const btnNext = document.getElementById('btnNext');

  // Estado actual
  let currentPublicacion = null;
  let currentIndex = 0;
  let totalFotos = 0;

  // Función para actualizar visibilidad de flechas
  function actualizarFlechas() {
    if (currentIndex <= 0) {
      btnPrev.style.display = 'none';
    } else {
      btnPrev.style.display = '';
    }

    if (currentIndex >= totalFotos - 1) {
      btnNext.style.display = 'none';
    } else {
      btnNext.style.display = '';
    }
  }

  // Obtener lista de imágenes (src) para una publicación concreta
  function obtenerListaDeFotosPorPublicacion(publicacionId) {
    const imgs = Array.from(document.querySelectorAll('.foto-clickable[data-publicacion="' + publicacionId + '"]'));
    // Ordenarlas por su data-index numérico (por si el DOM no está en orden)
    imgs.sort((a, b) => {
      return Number(a.dataset.index) - Number(b.dataset.index);
    });
    // Extraer src
    return imgs.map(i => i.src);
  }

  // Mostrar foto (por índice) de la publicación actual
  function mostrarFoto(publicacionId, index) {
    const lista = obtenerListaDeFotosPorPublicacion(publicacionId);
    if (lista.length === 0) return;
    totalFotos = lista.length;
    if (index < 0) index = 0;
    if (index >= totalFotos) index = totalFotos - 1;
    currentPublicacion = publicacionId;
    currentIndex = index;
    imagenAmpliada.src = lista[currentIndex];
    actualizarFlechas();
  }

  // Click en cada imagen clicable
  document.querySelectorAll('.foto-clickable').forEach(img => {
    img.addEventListener('click', function(e) {
      const pubId = this.dataset.publicacion;
      const idx = Number(this.dataset.index);
      mostrarFoto(pubId, idx);
      bsModal.show();
    });
  });

  // Botones prev/next
  btnPrev.addEventListener('click', function() {
    if (currentIndex > 0) {
      mostrarFoto(currentPublicacion, currentIndex - 1);
    }
  });
  btnNext.addEventListener('click', function() {
    if (currentIndex < totalFotos - 1) {
      mostrarFoto(currentPublicacion, currentIndex + 1);
    }
  });

  // Teclado: izquierda/derecha y Escape
  document.addEventListener('keydown', function(e) {
    if (!document.querySelector('.modal.show')) return; // si no hay modal abierto saltamos
    if (e.key === 'ArrowLeft') {
      if (currentIndex > 0) mostrarFoto(currentPublicacion, currentIndex - 1);
    } else if (e.key === 'ArrowRight') {
      if (currentIndex < totalFotos - 1) mostrarFoto(currentPublicacion, currentIndex + 1);
    } else if (e.key === 'Escape') {
      bsModal.hide();
    }
  });

  // Si cierras el modal, limpiamos src (por si acaso)
  modalEl.addEventListener('hidden.bs.modal', function() {
    imagenAmpliada.src = '';
    currentPublicacion = null;
    currentIndex = 0;
    totalFotos = 0;
  });

  // Soporte táctil simple: swipe left/right en la imagen para cambiar
  let touchStartX = null;
  imagenAmpliada.addEventListener('touchstart', function(e) {
    if (e.touches && e.touches.length === 1) {
      touchStartX = e.touches[0].clientX;
    }
  });
  imagenAmpliada.addEventListener('touchend', function(e) {
    if (!touchStartX) return;
    let touchEndX = (e.changedTouches && e.changedTouches[0]) ? e.changedTouches[0].clientX : null;
    if (!touchEndX) { touchStartX = null; return; }
    let diff = touchStartX - touchEndX;
    // umbral razonable
    if (Math.abs(diff) > 40) {
      if (diff > 0 && currentIndex < totalFotos - 1) {
        mostrarFoto(currentPublicacion, currentIndex + 1);
      } else if (diff < 0 && currentIndex > 0) {
        mostrarFoto(currentPublicacion, currentIndex - 1);
      }
    }
    touchStartX = null;
  });
});
