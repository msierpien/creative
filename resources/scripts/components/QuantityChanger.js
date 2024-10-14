import React, { useState, useEffect } from 'react';

const QuantityChanger = () => {
  const [quantity, setQuantity] = useState(1);
  const [productId, setProductId] = useState(null);

  useEffect(() => {
    // Pobierz ID produktu z atrybutu data w elemencie HTML
    const productElement = document.getElementById('quantity-changer');
    const productId = productElement.getAttribute('data-product-id');
    setProductId(productId);
  }, []);

  const increaseQuantity = () => {
    setQuantity(quantity + 1);
  };

  const decreaseQuantity = () => {
    if (quantity > 1) {
      setQuantity(quantity - 1);
    }
  };

  const addToCart = () => {
    if (productId) {
      fetch('/wp-json/wc/store/v1/cart/add-item', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Nonce': myAppData.nonce,  // Dodanie nonce do nagłówków
        },
        credentials: 'include',  // Wymuszamy przesyłanie ciasteczek
        
        body: JSON.stringify({
          id: productId,
          quantity: quantity,
        }),
      })
      .then((response) => {
        console.log('Headers:', response.headers);
        return response.json();
    })
    .then((data) => {
        if (data.error) {
            console.error('Error adding to cart:', data.message);
        } else {
            console.log('Product added to cart:', data);
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
    }
  };
  return (
    <div>
      <p>Product ID: {productId}</p>
      <button onClick={decreaseQuantity}>-</button>
      <span>{quantity}</span>
      <button className="btn" onClick={increaseQuantity}>+</button>
      <button className="btn" onClick={addToCart}>Dodaj do koszyka</button>
      <p>Aktualna ilość: {quantity}</p>
    </div>
  );
};

export default QuantityChanger;
