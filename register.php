<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="style/home_style.css">
    <link rel="stylesheet" href="style/registration .css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" />
    <link rel="stylesheet" href="style/header.css">
    <style>
        section.register{
            width: 95%;
            margin: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        section.register form{
            min-width: 200px;
        }
        .register form{
            margin-top: 0;
        }
        .alert-danger{
            z-index: 100;
        }
        .alert{
            margin-top:50%;
                    width: 80%;
                    position: absolute;
                    height: 73px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    z-index: 11;
                    background: #ff000080;
                    color: white;
                    border: 2px solid red;
                    text-align: center;
                    padding: 20px;transition: 0.4s;
        }
    </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <div class="backtoup">
        up
    </div>
    <?php
    include "login.php";
    include "functions.php";
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['rname'];
        $password = $_POST['rpass'];
        $hashpass = sha1($_POST['rpass']);
        $email = $_POST['remail'];
        $date = $_POST['date'];
        $gender = $_POST['gender'];
        try {
            $stmt=$con->prepare("INSERT INTO login (username, pasword, email,birth,gender,regStatus)
            VALUES (?,?,?,?,?,0);");
            $stmt->execute(array($username,$hashpass,$email,$date,$gender));
            $count = $stmt->rowCount();
            $row = $stmt->fetch();
            redirectHome('you are registered wait till the admin activate you and then you can login'
            ,3);
        } catch (\Throwable $th) {
            $stmt=$con->prepare("SELECT * FROM login WHERE username = ?");
            $stmt->execute(array($username));
            $count = $stmt->rowCount();
            $row = $stmt->fetch();
            if ($count>0) {
                echo '<div class="alert alert-danger" role="alert">
        this username is already exist
  </div>';
            }
            redirectHome('you are registered wait till the admin activate you and then you can login'
            ,3,'back');
        }
        
    }
    ?>
    <div class="back">
        <a href="homepage.php">back to login</a>
    </div>
    <section class="register" id="register">
            <form style="min-width:400px ;" class="form" autocomplete="off" method="POST" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
                <h1>Sign Up</h1>
                <div class="form-group">
                    <input type="text" placeholder=" " id="name" name="rname" required>
                    <label for="name">Name</label>
                    <div class="check" id="cname">
                    </div>
                </div>
                <table style="margin-left: 35px;">
                    <tr>
                        <td><label for="gender">Your Gender:</label></td>
                        <td> <input type="radio" name="gender" id="male" value="male"><label for="male">male</label>
                            <input type="radio" style="
                                filter:grayscale(1);
                                filter:hue-rotate(120deg);
                            " name="gender" id="femele" value="femele"><label for="femele">femele</label>
                        </td>
                    </tr>
                    <tr>
                        <td> <label style="margin-left: 20px;" for="date">DOB:</label>
                        </td>
                        <td> <input type="date" class="" name="date" id="date" required>
                        </td>
                    </tr>
                    <tr>
                        <td> <label for="list">Natianality:</label>
                        </td>
                        <td>
                            <select id="list1">
                                <option value="lebanon">lebanon</option>
                                <option value="syria">syria</option>
                                <option value="jordan">jordan</option>
                                <option value="saudi arabia">saudi arabia</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <div class="form-group">
                    <input type="email" placeholder=" " name="remail" id="email" required>
                    <label for="email">Email</label>
                    <div class="check" id="cemail">
                    </div>
                </div>
                <div class="form-group">
                    <input type="password" placeholder=" " name="rpass" id="password" required>
                    <label for="password">Password</label>
                    <div class="check" id="cpass">
                    </div>
                </div>
                <div class="form-group">
                    <input type="password" placeholder=" " id="confirm" required>
                    <label for="confirm">Confirm</label>
                    <div class="check" id="cconf">
                    </div>
                </div>
                <div class="form-bottom">
                    <a href="#">Forgot Password?</a>
                </div>
                <div class="accept">
                    <input type="checkbox" name="accept" id="acc"><span>i accept <a href="#">all the terms</a></span>
                </div>
                <div class="resetsubmit">
                    <input type="submit" value="Sign Up" id="submit">
                    <input type="reset" id="reset" value="reset">
                </div>
            </form>
    </section>
    <script>
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
const nav = document.querySelector('nav');
const namerror = document.getElementById('cname');
const passrror = document.getElementById('cpass');
const mailerror = document.querySelector('#cemail');
const navlinks = document.querySelectorAll('nav ul li a');
const confinput = document.getElementById('confirm');
const conferror = document.getElementById('cconf');
const submit = document.querySelector("#submit")
const reset = document.querySelector('#reset');
const date = document.querySelector('#date');
const dateinput = document.querySelector('#date');
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
dateinput.addEventListener('input',() => {
    underAgeValidate(dateinput.value);
})
function underAgeValidate(birthday){
	// it will accept two types of format yyyy-mm-dd and yyyy/mm/dd
	var optimizedBirthday = birthday.replace(/-/g, "/");

	//set date based on birthday at 01:00:00 hours GMT+0100 (CET)
	var myBirthday = new Date(optimizedBirthday);

	// set current day on 01:00:00 hours GMT+0100 (CET)
	var currentDate = new Date().toJSON().slice(0,10)+' 01:00:00';

	// calculate age comparing current date and borthday
	var myAge = ~~((Date.now(currentDate) - myBirthday) / (31557600000));

	if(myAge < 18 || myAge >130) {       
        dateinput.className = 'error';
     	    return false;
        }else{  
        dateinput.className = 'true';
	    return true;
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
        ValidateEmail(emailinput)&&
        underAgeValidate(date.value)) {
        return true
    }else {
    document.querySelector('.form').style.animation = "form 2s";
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


    </script>
    
</body>

</html>