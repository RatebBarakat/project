const  form = document.querySelector('header form');
const  input = document.querySelectorAll('header input');
const inputs = Array.from(input);
const  label = document.querySelectorAll('form label');
const  tooglediv = document.querySelector('.night_mode');
const  toogle = document.querySelector('.toogle');
const up = document.querySelector('.backtoup');
const bar = document.querySelector('body > header > i');
const nav = document.querySelector('nav');
const navclose = document.querySelector('body > header > div.nav > nav > .fa-xmark');
const navlinks = document.querySelectorAll('nav ul li a');
const username = document.getElementById('#name');
const password = document.getElementById('#password');
const body = document.querySelector('body');
const elementstype = document.querySelectorAll('.ioan input')
const productsBoxes = document.querySelectorAll(".container .box");
// const dropul = document.querySelector('.drop ul');
// dropul.addEventListener('mouseOut',() => {
//     dropul.style.display = "none";
// })
window.addEventListener('scroll',() => {
    if (scrollY >= 600) {
        up.classList.add('active');
    }else up.classList.remove('active');
})
up.addEventListener('click',() => {
    window.scrollTo({
        top:0,
        left:0,
        behavior :"smooth"
    });
})
bar.addEventListener("click",() => {
    nav.classList.toggle('active');
})
navclose.addEventListener('click',() => {
    navclose.parentNode.classList.remove('active');
})
navlinks.forEach(link => {
    link.addEventListener('click',() => {
        nav.classList.remove('active');
    })
});
//elementproductfetch
elementstype.forEach(input => {
    input.addEventListener('click',() => {
        elementstype.forEach(element => {
            element.classList.remove('active');

        });
        input.classList.add('active');
        productsBoxes.forEach(box => {
            box.classList.add("none");
            box.classList.remove("active");
            if (box.classList.contains(input.dataset.type)) {
                box.classList.remove("none");
                box.classList.add("active");
            }
        });
    })
});
// darkmode
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
}else {
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
