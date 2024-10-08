import domReady from '@roots/sage/client/dom-ready';

/**
 * Application entrypoint
 */
domReady(async () => {
  // ...
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);

// add to cart

// document.addEventListener('DOMContentLoaded', function() {
//   const addToCartButtons = document.querySelectorAll('.add-to-cart-button');

//   addToCartButtons.forEach(button => {
//       button.addEventListener('click', function(e) {
//           e.preventDefault();
//           const productId = this.getAttribute('data-product-id');
//           const nonce = this.getAttribute('data-nonce');

//           fetch(wc_add_to_cart_params.ajax_url, {
//               method: 'POST',
//               headers: {
//                   'Content-Type': 'application/x-www-form-urlencoded',
//               },
//               body: new URLSearchParams({
//                   action: 'add_to_cart',
//                   product_id: productId,
//                   quantity: 1,
//                   nonce: nonce
//               })
//           })
//           .then(response => response.json())
//           .then(data => {
//               if (data.success) {
//                   alert('Produkt dodany do koszyka!');
//                   // Tutaj możesz dodać kod do aktualizacji widoku koszyka, jeśli jest taka potrzeba
//               } else {
//                   alert('Wystąpił błąd podczas dodawania do koszyka.');
//               }
//           })
//           .catch(error => {
//               console.error('Błąd:', error);
//               alert('Wystąpił błąd podczas dodawania do koszyka.');
//           });
//       });
//   });
// });

document.addEventListener('DOMContentLoaded', function () {
  const addToCartButtons = document.querySelectorAll('.add-to-cart-button');

  addToCartButtons.forEach((button) => {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      const productId = this.getAttribute('data-product-id');

      // Dodaj klasę 'loading' podczas ładowania
      this.classList.add('loading');

      fetch(
        wc_add_to_cart_params.wc_ajax_url
          .toString()
          .replace('%%endpoint%%', 'add_to_cart'),
        {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: new URLSearchParams({
            product_id: productId,
            quantity: 1,
          }),
        }
      )
        .then((response) => response.json())
        .then((data) => {
          if (data.fragments) {
            jQuery.each(data.fragments, function (key, value) {
              jQuery(key).replaceWith(value);
            });
          }

          // Aktualizuj wygląd przycisku
          this.classList.remove('loading');

          this.querySelector('svg').setAttribute('stroke', '#4b5563');

          // Aktualizuj lub dodaj licznik
          let counter = this.querySelector('span');
          if (!counter) {
            counter = document.createElement('span');
            counter.classList.add(
              'absolute',
              '-top-2',
              '-right-2',
              'bg-green',
              'text-black',
              'rounded-full',
              'w-5',
              'h-5',
              'flex',
              'items-center',
              'justify-center',
              'text-xs'
            );
            this.appendChild(counter);
          }
          const currentQuantity = parseInt(counter.textContent || '0');
          counter.textContent = currentQuantity + 1;
        })
        .catch((error) => {
          console.error('Błąd:', error);
          this.classList.remove('loading');
        });
    });
  });
});

//image gallery

document.addEventListener('DOMContentLoaded', function () {
  const productItems = document.querySelectorAll('.product-item');

  productItems.forEach((item) => {
    const img = item.querySelector('.product-image');
    const secondImageUrl = item.dataset.secondImage;
    const originalImageUrl = img.src;

    if (secondImageUrl) {
      // Preload second image
      const preloadImg = new Image();
      preloadImg.src = secondImageUrl;

      item.addEventListener('mouseenter', () => {
        img.style.opacity = '0';
        setTimeout(() => {
          img.src = secondImageUrl;
          img.style.opacity = '1';
        }, 150); // Half of the transition duration
      });

      item.addEventListener('mouseleave', () => {
        img.style.opacity = '0';
        setTimeout(() => {
          img.src = originalImageUrl;
          img.style.opacity = '1';
        }, 150); // Half of the transition duration
      });
    }
  });
});

//scrollbar

// document.addEventListener("DOMContentLoaded", function () {
//     const scroller = document.querySelector('.scroller');
//     const progressBar = document.querySelector('.progress-bar');

//     scroller.addEventListener('scroll', function () {
//         const scrollWidth = scroller.scrollWidth - scroller.clientWidth;
//         const scrollLeft = scroller.scrollLeft;
//         const scrollPercentage = (scrollLeft / scrollWidth) * 100;

//         progressBar.style.width = `${scrollPercentage}%`;
//     });
// });

document.addEventListener('DOMContentLoaded', function () {
  const scroller = document.querySelector('.scroller');
  const sliderThumb = document.querySelector('.slider-thumb');
  const sliderContainer = document.querySelector('.slider-container');

  let isDragging = false;

  // Sprawdzenie, czy przewijanie jest potrzebne
  function updateSliderVisibility() {
    if (scroller.scrollWidth > scroller.clientWidth) {
      sliderContainer.classList.remove('hidden'); // Pokazuj slider, jeśli jest co scrollować
    } else {
      sliderContainer.classList.add('hidden'); // Ukryj slider, jeśli nie ma przewijania
    }
  }

  // Przesuwanie suwaka
  sliderThumb.addEventListener('mousedown', function (e) {
    isDragging = true;
    document.body.style.cursor = 'grabbing';
  });

  document.addEventListener('mousemove', function (e) {
    if (!isDragging) return;

    const containerRect = sliderContainer.getBoundingClientRect();
    let newLeft = e.clientX - containerRect.left;

    // Upewnij się, że suwak nie wychodzi poza kontener
    if (newLeft < 0) {
      newLeft = 0;
    } else if (newLeft > containerRect.width) {
      newLeft = containerRect.width;
    }

    // Aktualizowanie pozycji suwaka
    const sliderPercentage = (newLeft / containerRect.width) * 100;
    sliderThumb.style.left = `${sliderPercentage}%`;

    // Aktualizowanie przewijania elementów na podstawie pozycji suwaka
    const scrollWidth = scroller.scrollWidth - scroller.clientWidth;
    scroller.scrollLeft = (sliderPercentage / 100) * scrollWidth;
  });

  // Zatrzymanie przesuwania po zakończeniu przeciągania
  document.addEventListener('mouseup', function () {
    if (isDragging) {
      isDragging = false;
      document.body.style.cursor = 'default';
    }
  });

  // Aktualizacja pozycji suwaka na podstawie przewijania
  scroller.addEventListener('scroll', function () {
    const scrollWidth = scroller.scrollWidth - scroller.clientWidth;
    const scrollLeft = scroller.scrollLeft;
    const scrollPercentage = (scrollLeft / scrollWidth) * 100;

    sliderThumb.style.left = `${scrollPercentage}%`;
  });
  // Aktualizacja szerokości paska na podstawie przewijania
  scroller.addEventListener('scroll', function () {
    const scrollWidth = scroller.scrollWidth - scroller.clientWidth;
    const scrollLeft = scroller.scrollLeft;
    const scrollPercentage = (scrollLeft / scrollWidth) * 100;

    // Zmieniamy szerokość paska (sliderThumb) w zależności od przewinięcia
    sliderThumb.style.width = `${scrollPercentage}%`;
  });
  // Sprawdź, czy przewijanie jest potrzebne na starcie
  updateSliderVisibility();

  // Opcjonalnie: Sprawdź ponownie po zmianie rozmiaru okna
  window.addEventListener('resize', updateSliderVisibility);
});
