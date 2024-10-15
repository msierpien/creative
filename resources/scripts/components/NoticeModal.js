import React, { useState, useEffect } from 'react';

const NoticeModal = () => {
  const [isOpen, setIsOpen] = useState(true);
  const notices = productData.notices || [];

  useEffect(() => {
    if (!notices || notices.length === 0) {
      setIsOpen(false);
    }
  }, [notices]);

  if (!isOpen) return null;

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center bg-gray-90 bg-opacity-75">
      <div className="bg-gray-10 w-96 p-6 rounded shadow-lg relative">
        <button 
          className="absolute top-2 right-2 text-gray-50 hover:text-gray-5"
          onClick={() => setIsOpen(false)}
        >
          &times;
        </button>
        <div className="mb-4">
          <h2 className="text-xl font-semibold text-gray-5">Notifications</h2>
        </div>
        <div className="text-gray-5">
          {notices && notices.map((notice, index) => (
            <div key={index} dangerouslySetInnerHTML={{ __html: notice }} />
          ))}
        </div>
      </div>
    </div>
  );
};

export default NoticeModal;
