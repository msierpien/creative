import React from 'react';
import SimpleProduct from './SimpleProduct';
import VariantProduct from './VariantProduct';

const AddToCart = () => {
  const { productId, productType, productVariations, productAttributes } = productData;
  const currencySymbol = productData.currencySymbol;
  return (
    <div>
      {productType === 'simple' && <SimpleProduct productId={productId}  currencySymbol={currencySymbol}/>}
      {productType === 'variable' && <VariantProduct productId={productId} variations={productVariations} attributes={productAttributes} currencySymbol={currencySymbol}/>}
    </div>
  );
};

export default AddToCart;
