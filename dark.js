
            const tooglediv = document.querySelector('.night_mode');
           const toogle = document.querySelector('.toogle');
           let darkMode = localStorage.getItem('darkMode');
           const enableDarkMode = () => {
               document.body.classList.add('active');
               localStorage.setItem('darkMode', 'enabled');
           }

           const disableDarkMode = () => {
               document.body.classList.remove('active');
               localStorage.setItem('darkMode', null);
           }
           if (darkMode === 'enabled') {
               enableDarkMode();
               toogle.classList.add('night');
           } else {
               disableDarkMode();
               toogle.classList.remove('night');
           }
           tooglediv.addEventListener('click', () => {
               toogle.classList.toggle('night');
               darkMode = localStorage.getItem('darkMode');
               if (darkMode !== 'enabled') {
                   enableDarkMode();
               } else {
                   disableDarkMode();
               }
           });