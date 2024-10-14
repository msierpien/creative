import React from 'react';

const QuantityInput = ({ value, onChange }) => {
  return (
    <input
      type="number"
      value={value}
      onChange={onChange}
      min="1"
      className="border w-1/4 text-center py-2 px-4"
    />
  );
};

export default QuantityInput;
