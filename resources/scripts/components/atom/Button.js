import React from 'react';

const Button = ({ label, onClick, disabled }) => {
  return (
    <button
      onClick={onClick}
      disabled={disabled}
      className={`px-4 py-2 border border-black w-full bg-black text-white  font-semibold  ${disabled ? 'opacity-50 cursor-not-allowed' : 'hover:bg-white hover:text-black'}`}
    >
      {label}
    </button>
  );
};

export default Button;
