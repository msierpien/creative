import React from 'react';
import ReactDOM from 'react-dom';
import QuantityChanger from './components/QuantityChanger';

// Sprawdź, czy istnieje element o id "quantity-changer", aby wstawić nasz komponent React
if (document.getElementById('quantity-changer')) {
  ReactDOM.render(<QuantityChanger />, document.getElementById('quantity-changer'));
}


