import domReady from '@roots/sage/client/dom-ready';

import React from 'react';
import ReactDOM from 'react-dom';
import QuantityChanger from './components/QuantityChanger';

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




//Button add to cart quantity change
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

  // Sprawdź, czy przewijanie jest potrzebne na starcie
  updateSliderVisibility();

  // Opcjonalnie: Sprawdź ponownie po zmianie rozmiaru okna
  window.addEventListener('resize', updateSliderVisibility);
});


//Filter products by attributes

document.addEventListener('DOMContentLoaded', function () {
  const attributeButtons = document.querySelectorAll('.show-attributes-button');
  const checkboxes = document.querySelectorAll('.attribute-options input[type="checkbox"]');
  let currentlyOpenGroup = null;
  let updateTimer = null;

  // Funkcja do otwierania/zamykania grup atrybutów
  function toggleAttributeGroup(button) {
    const attributeGroupId = button.dataset.target.replace('attribute-group-', '');
    const attributeGroup = document.getElementById(attributeGroupId);

    if (attributeGroup) {
      if (currentlyOpenGroup && currentlyOpenGroup !== attributeGroup) {
        currentlyOpenGroup.classList.add('hidden');
      }
      attributeGroup.classList.toggle('hidden');
      currentlyOpenGroup = attributeGroup.classList.contains('hidden') ? null : attributeGroup;
    }
  }

  // Funkcja do zbierania zaznaczonych atrybutów
  function collectCheckedAttributes() {
    const attributeGroups = {};
    checkboxes.forEach(checkbox => {
      const attributeName = checkbox.name.replace('[]', '').replace('pa_', '');
      const attributeValue = checkbox.value;
      
      if (checkbox.checked) {
        if (!attributeGroups[attributeName]) {
          attributeGroups[attributeName] = [];
        }
        attributeGroups[attributeName].push(attributeValue);
      }
    });
    return attributeGroups;
  }

  // Funkcja do tworzenia URLSearchParams
  function createUrlParams(attributeGroups) {
    const params = new URLSearchParams();
    for (const [attribute, values] of Object.entries(attributeGroups)) {
      params.set(`filter_${attribute}`, values.join(','));
      params.set(`query_type_${attribute}`, 'or');
    }
    return params;
  }

  // Funkcja do aktualizacji URL i przeładowania strony
  function updateUrlAndReload() {
    const attributeGroups = collectCheckedAttributes();
    const params = createUrlParams(attributeGroups);
    const newUrl = `${window.location.pathname}?${params.toString()}`;
    window.location.href = newUrl; // To spowoduje przeładowanie strony
  }

  // Funkcja do ustawiania opóźnionego przeładowania
  function setDelayedRefresh() {
    clearTimeout(updateTimer);
    updateTimer = setTimeout(() => {
      updateUrlAndReload();
    }, 1000);
  }

  // Funkcja do zaznaczania checkboxów na podstawie URL
  function setCheckboxesFromUrl() {
    const params = new URLSearchParams(window.location.search);
    checkboxes.forEach(checkbox => {
      const attributeName = checkbox.name.replace('[]', '').replace('pa_', '');
      const filterParam = params.get(`filter_${attributeName}`);
      if (filterParam) {
        const values = filterParam.split(',');
        checkbox.checked = values.includes(checkbox.value);
      } else {
        checkbox.checked = false;
      }
    });
  }

  // Dodawanie event listenerów
  attributeButtons.forEach(button => {
    button.addEventListener('click', () => toggleAttributeGroup(button));
  });

  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', setDelayedRefresh);
  });

  // Inicjalizacja - zaznacz checkboxy na podstawie URL przy ładowaniu strony
  setCheckboxesFromUrl();
});

//terst react 

// Sprawdź, czy istnieje element o ID "quantity-changer"
if (document.getElementById('quantity-changer')) {
  ReactDOM.render(<QuantityChanger />, document.getElementById('quantity-changer'));
}