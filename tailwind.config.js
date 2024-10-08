/** @type {import('tailwindcss').Config} config */
const config = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './resources/**/*.scss',
  ],
  theme: {
    extend: {
      fontFamily: {
        montserrat: ['Montserrat', 'sans-serif'],
        cormorant: ['"Cormorant Garamond"', 'serif'],
      },
    },
    colors: {
      // Bazowe kolory
      white: 'rgb(255, 255, 255)',  // Umożliwia korzystanie z klasy `text-white`
      black: 'rgb(0, 0, 0)',  // Umożliwia korzystanie z klasy `text-black`
      current: 'currentColor',  // Umożliwia korzystanie z klasy `text-current`
      grey: {
        5: 'rgb(238, 238, 238)',
        10: 'rgb(222, 222, 222)',
        20: 'rgb(190, 190, 190)',
        30: 'rgb(158, 158, 158)',
        40: 'rgb(128, 128, 128)',
        50: 'rgb(99, 99, 99)',
        60: 'rgb(72, 72, 72)',
        70: 'rgb(46, 46, 46)',
        80: 'rgb(22, 22, 22)',
        90: 'rgb(3, 3, 3)',
      },
      red: 'rgb(183, 3, 3)',
      green: 'rgb(208, 227, 178)',
      yellow: 'rgb(243, 255, 52)',
      primary: {
        50: '#f5faf3',
        100: '#e7f5e3',
        200: '#ceebc7',
        300: '#9fd692',
        400: '#79c068',
        500: '#55a443',
        600: '#428633',
      },
      secondary: {
        background: 'var(--wp--preset--color--yellow)', 
        'text-color': 'var(--wp--preset--color--black)', 
      },
      success: {
        default: 'var(--wp--preset--color--green)', 
        background: 'var(--wp--preset--color--grey-10)', 
      },
      error: {
        default: 'var(--wp--preset--color--red)', 
        background: 'var(--wp--preset--color--grey-5)', 
      },
      badge: {
        sale: 'var(--wp--preset--color--red)', 
        soldout: 'var(--wp--preset--color--red)', 
      },
    },
    
    // Odwołania do bazowych kolorów
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
};

export default config;
