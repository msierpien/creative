<div class="scroll-container">
      {{ $slot }} 


  <div class="slider-container relative w-6/10 mt-5 overflow-hidden">
      <div class="slider-track absolute top-1/2 w-full h-1 bg-white transform -translate-y-1/2"></div>
      <div class="slider-thumb absolute left-0 top-1/2 w-20 bg-black transform -translate-x-1/2 -translate-y-1/2 cursor-pointer"></div>
  </div>
</div>