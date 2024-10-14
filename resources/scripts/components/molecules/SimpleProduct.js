import React, { useState } from 'react';
import Button from '../atom/Button';
import QuantityInput from '../atom/QuantityInput';

const SimpleProduct = ({ productId, currencySymbol }) => {
  const [quantity, setQuantity] = useState(1);
  const [isAdding, setIsAdding] = useState(false);
  const productPrice = productData.productPrice;
 

  const addToCart = () => {
    setIsAdding(true);

    fetch('/wp-json/wc/store/v1/cart/add-item', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Nonce: myAppData.nonce,
      },
      credentials: 'include',
      body: JSON.stringify({
        id: productId,
        quantity: parseInt(quantity, 10),
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.error) {
          console.error('Error:', data.message);
        } else {
          console.log('Product added:', data);
          setQuantity(1);
        }
      })
      .finally(() => setIsAdding(false));
  };

  return (
    <div className="p-6 bg-grey-5">
      <div className="font-cormorant">
        <div className='flex gap-1 font-semibold text-4xl mb-2'>
          <span>{productPrice * quantity} </span>
          <span>{currencySymbol} </span>

        </div>
        <div className="font-thin leading-3 mb-4">
          <p>cena z {quantity} szt. </p>
          <p>cena zawiera Vat</p>
        </div>
      </div>
      <div className="flex items-center">
        <QuantityInput
          value={quantity}
          onChange={(e) => setQuantity(e.target.value)}
        />
        <Button
          label={isAdding ? 'Dodawanie do...' : 'Dodaj do koszyka'}
          onClick={addToCart}
          disabled={isAdding}
        />
      </div>
    </div>
  );
};

export default SimpleProduct;
