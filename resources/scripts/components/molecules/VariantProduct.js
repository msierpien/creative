import React, { useState, useEffect } from 'react';
import Button from '../atom/Button';
import QuantityInput from '../atom/QuantityInput.js';

const VariantProduct = ({ productId, variations, attributes, currencySymbol }) => {
  const [selectedVariant, setSelectedVariant] = useState(variations[0]?.variation_id || null);
  const [isAdding, setIsAdding] = useState(false);
  const [variantName, setVariantName] = useState('');
  const [quantity, setQuantity] = useState(1);

  // Znajdź wybrany wariant po jego ID
  const selectedVariantData = variations.find((variant) => variant.variation_id === selectedVariant);

  // Funkcja mapująca slug na pełną nazwę atrybutu
  const getAttributeName = (slug, attributeTerms) => {
    const attribute = attributeTerms.find(term => term.slug === slug);
    return attribute ? attribute.name : slug;
  };

  // Aktualizuj nazwę wariantu na podstawie atrybutu
  useEffect(() => {
    if (selectedVariantData) {
      const variantAttribute = selectedVariantData.attributes['attribute_pa_kolor'];
      const attributeName = getAttributeName(variantAttribute, attributes.pa_kolor.terms); // mapowanie slug na nazwę
      setVariantName(attributeName ? `Kolor: ${attributeName}` : 'Brak atrybutu koloru');
    }
  }, [selectedVariantData]);

  const addToCart = () => {
    setIsAdding(true);

    fetch('/wp-json/wc/store/v1/cart/add-item', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Nonce': myAppData.nonce,
      },
      credentials: 'include',
      body: JSON.stringify({
        id: selectedVariant,
        quantity: quantity
      }),
    })
    .then((response) => response.json())
    .then((data) => {
      if (data.error) {
        console.error('Error:', data.message);
      } else {
        console.log('Variant added:', data);
      }
    })
    .finally(() => setIsAdding(false));
  };

  return (
    <div className="flex flex-col space-y-6 p-6 bg-grey-5">
    <h3>Wybierz {variantName}</h3>
    {/* Wyświetl listę wariantów z radiobuttonami i obrazkami */}
    <ul className="space-y-4">
      {variations.map((variant) => {
        const variantAttributeSlug = variant.attributes['attribute_pa_kolor']; // Pobieramy slug atrybutu koloru
        const variantAttributeName = getAttributeName(variantAttributeSlug, attributes.pa_kolor.terms); // Zmapowanie na pełną nazwę

        return (
          <li 
            key={variant.variation_id} 
            className={`flex items-center bg-white border justify-between hover:border-grey-20 p-4  cursor-pointer transition-all ${
              selectedVariant === variant.variation_id ? 'border-black ' : 'border-white'
            }`}
            onClick={() => setSelectedVariant(variant.variation_id)} // Ustaw wybrany wariant po kliknięciu
          >
            <div className="flex items-center space-x-4">
              <img src={variant.image.src} alt={variant.image.alt} className="w-16 h-16 object-cover " />
              <div>
                <p className="font-cormorant font-semibold text-2xl text-grey-50">{variant.display_price} {currencySymbol} </p>
                <p className="text-lg ">{variantAttributeName || 'Brak atrybutu koloru'}</p> {/* Wyświetl pełną nazwę atrybutu */}
              </div>
            </div>
            {/* Radio button */}
            <input
              type="radio"
              id={`variant-${variant.variation_id}`}
              name="product-variant"
              value={variant.variation_id}
              checked={selectedVariant === variant.variation_id}
              onChange={() => setSelectedVariant(variant.variation_id)}
              className="form-radio h-6 w-6 text-black focus:ring-black"
            />
          </li>
        );
      })}
    </ul>

    {/* Ilość i przycisk dodania do koszyka */}
    <div className="flex items-center">
      <QuantityInput value={quantity} onChange={(e) => setQuantity(parseInt(e.target.value))} />
      <Button label={isAdding ? 'Dodawanie do...' : 'Dodaj do koszyka'} onClick={addToCart} disabled={isAdding} className="bg-black text-white py-2 px-4 rounded-lg hover:bg-gray-800" />
    </div>
  </div>
  );
};

export default VariantProduct;
