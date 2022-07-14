const  login = document.querySelector('.login');
const  form = document.querySelector('form');
const  input = document.querySelectorAll('header input');
const nameinput = document.querySelector('#name');
const emailinput = document.querySelector('#email');
const passwordinput = document.querySelector('#password');
const  label = document.querySelectorAll('form label');
const  forsearch = document.querySelector('.search');
const  search = document.querySelector('#search');
const up = document.querySelector('.backtoup');
const bar = document.querySelector('body > header > i');
const nav = document.querySelector('nav');
const namerror = document.querySelector('#cname');
const passrror = document.querySelector('#cpass');
const mailerror = document.querySelector('#cemail');
const navclose = document.querySelector('body > header > div.nav > nav > .fa-xmark');
const navlinks = document.querySelectorAll('nav ul li a');
const confinput = document.querySelector('#confirm');
const conferror = document.querySelector('#cconf');
const submit = document.querySelector("#submit")
const reset = document.querySelector('#reset');
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
reset.addEventListener('click',() => {
    document.querySelectorAll('input').forEach(ipt => {
        ipt.classList.remove("error","true");
    });
    document.querySelectorAll('.error').forEach(err => {
        err.classList.remove("error","true");
        err.innerHTML = "";
    });
    document.querySelectorAll('.true').forEach(truw => {
        truw.classList.remove("error","true");
        truw.innerHTML = "";
    });
})
function checkname() {   
     if (nameinput.value.length<1) {
    namerror.classList.remove('error');
    nameinput.classList.remove('error');
    namerror.innerHTML = "";
    return false;
}
    if (nameinput.value.length<=2 && nameinput.value.length>0) {
        namerror.className='error';
        nameinput.className='error';
        namerror.textContent = "name cant be less than 2 char"
        return false;
    }else if (nameinput.value.length>21) {
        namerror.className= 'error';
        nameinput.className= 'error';
        namerror.textContent = "name cant be more than 20 char"
        return false;
    }else if (nameinput.value.length >2 && nameinput.value.length <=21) {
        namerror.className= 'true';
        nameinput.className= 'true';
        namerror.textContent = "name specify the condition";
        return true;
    }
    else {
        namerror.textContent = "";
        namerror.classList.remove('error');
        return false;
    }

}
function CheckPass(inputtxt) 
{ 
var passw=  /^[A-Za-z]\w{7,14}$/;
if(inputtxt.value.match(passw)) 
{ 
return true;
}
else
{ 
return false;
}
}
function ValidateEmail(mail) 
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail.value))
  {
    return true;
  }
    return false;
}
function confpass(pass) {
    if (pass.value === passwordinput.value) {
        return true;
    }
    else return false;
}
nameinput.addEventListener('input',() => {
    checkname();
    console.log('name');
})
passwordinput.addEventListener('input',() => {
    
    console.log('name');
    if (passwordinput.value.length>0) {
        CheckPass(passwordinput);
        if (CheckPass(passwordinput)) {
            passwordinput.className = "true";
            passrror.className = "true";
            passrror.innerHTML = "good password";
        }
        else{
            passwordinput.className = "error";
            passrror.className = "error";
            passrror.innerHTML = "password between 7 to 16 characters which contain only characters, numeric digits, underscore and first character must be a letter";
        }
    }else {
        passwordinput.classList.remove("error");
        passrror.classList.remove("error");
        passrror.innerHTML = "";
    } 
})
emailinput.addEventListener('input',() => {
    
    console.log('name');
if (emailinput.value.length>0) {
    ValidateEmail(emailinput);
    if (!ValidateEmail(emailinput)) {
    mailerror.className = "error";
    mailerror.innerHTML = "invalid email";
    emailinput.className = "error";
    emailinput.className = "error";
    }else if (ValidateEmail(emailinput)) {
        mailerror.className = "true";
        emailinput.className = "true";
        mailerror.innerHTML = "valid email";
    }else {
        mailerror.onFocus.className = "none";
        mailerror.innerHTML = '';
    }
}else mailerror.innerHTML = ""
if (emailinput.value.length<1) {
    emailinput.classList.remove("error");
}
})
confinput.addEventListener('input',() => {
    
    console.log('name');
    if (confinput.value.length>0) {
        if (confpass(confinput)) {
            confinput.className = "true";
            conferror.className = "true";
            conferror.innerHTML = "password is confirm";
        }
        else{
            confinput.className = "error";
            conferror.className = "error";
            conferror.innerHTML = "value should be the same of password";
        }
    }else{
        confinput.classList.remove("error","true");
        conferror.classList.remove("error");
        conferror.innerHTML = "";
    }
})
window.addEventListener('submit',(e) => {
    if (checkname()&&
        CheckPass(passwordinput)&&
        confpass(confinput)&&
        ValidateEmail(emailinput)) {
        return true
    }else {
    e.preventDefault();
    }
})
// // darkmode
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
}
  darkMode = localStorage.getItem('darkMode'); 
  if (darkMode !== 'enabled') {
    enableDarkMode();
  } else {  
    disableDarkMode(); 

  }
;
