import React from 'react';
import ReactDOM from 'react-dom';
import QuantityChanger from './components/QuantityChanger';
import AddToCart from './components/molecules/AddToCart';


// Sprawdź, czy istnieje element o id "quantity-changer", aby wstawić nasz komponent React
if (document.getElementById('quantity-changer')) {
  ReactDOM.render(<AddToCart />, document.getElementById('quantity-changer'));
} 

console.log('Hello from app.js');
if (typeof productData !== 'undefined') {
  console.log(productData.productType); // Typ produktu
  console.log(productData.productId);   // ID produktu
}