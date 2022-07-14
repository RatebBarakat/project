<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin | login</title>
    <link rel="stylesheet" href="style/home_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}
@media (max-width:300px) {
  form{
    width: 90% !important;
  }
}
.alert{
    position: absolute;
    top: 50px;
    left: 0;
    width: 90%;
    margin: 10px;
}
:root {
  --primary-color: hsl(196, 78%, 61%);
}

body {
  min-height: 100vh;
  background: #eceffc;
  display: flex;
  justify-content: center;
  align-items: center;
}

.login-form {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 50px 40px;
  color: white;
  min-width: 250px;
  font-family: "Microsoft YaHei", serif;
  font-size: 16px;
  background-color: rgba(0, 0, 0, 0.8);
  border-radius: 8px;
  box-shadow: 0 0.4px 0.4px rgba(128, 128, 128, 0.109), 0 1px 1px rgba(128, 128, 128, 0.155), 0 2.1px 2.1px rgba(128, 128, 128, 0.195), 0 4.4px 4.4px rgba(128, 128, 128, 0.241), 0 12px 12px rgba(128, 128, 128, 0.35);
}
.login-form h1 {
  margin: 0 0 24px 0;
}
.login-form .form-input-material {
  margin: 12px 0;
}
.login-form .btn {
  width: 100%;
  margin: 18px 0 9px 0;
  padding: 8px 20px;
  position: relative;
  border-radius: 0;
}
.login-form input {
  color: white;
}
.login-form button,
.login-form input {
  font: inherit;
  outline: none;
}

.form-input-material {
  --input-border-bottom-color: white;
  position: relative;
  border-bottom: 1px solid var(--input-border-bottom-color);
}
.form-input-material::before {
  position: absolute;
  content: "";
  left: 0;
  bottom: -1px;
  width: 100%;
  height: 2px;
  background-color: var(--primary-color);
  transform: scaleX(0);
  transform-origin: center;
  transition: 0.5s;
}
.form-input-material:focus-within::before {
  transform: scaleX(1);
}
.form-input-material .form-control-material {
  padding: 0.5rem 0;
  background: none;
  border: none;
}
.form-input-material .form-control-material:focus ~ label, .form-input-material .form-control-material:not(:placeholder-shown) ~ label {
  transform: translateY(-110%) scale(0.8);
  color: var(--primary-color);
}
.form-input-material label {
  position: absolute;
  top: 0.5rem;
  left: 0;
  transition: 0.3s;
  transform-origin: left;
}

.btn-ghost {
  --btn-color: var(--primary-color);
  --btn-border-color: var(--primary-color);
  background: none;
  transition: 0.3s;
  overflow: hidden;
  color: var(--btn-color);
  border: 1px solid var(--btn-border-color);
}
.btn-ghost::before {
  position: absolute;
  content: "";
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(120deg, transparent, var(--primary-color), transparent);
  transform: translateX(-100%);
  transition: 0.6s;
}
.btn-ghost:hover {
  box-shadow: 0 0 20px 5px rgba(51, 152, 219, 0.5);
}
.btn-ghost:hover::before {
  transform: translateX(100%);
}
.login-form .btn:focus{
    background: var(--form-label-color);
}
    </style>
</head>
<body>
    <?php
    include "login.php";
    
    session_start();
    if (isset($_SESSION['admin'])) {
        echo '<div class="alert alert-danger" role="alert">you are loged as an admin already
        you will be redirected to members page after 2 second</div>';
        header('Refresh:2,members.php?do=insert');
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adminname = $_POST['name'];
    $adminpassword = $_POST['apass'];
    $hashpass = sha1($adminpassword);
    $stmt=$con->prepare("SELECT * FROM login WHERE username = ? AND pasword = ? AND group_id = 1 LIMIT 1");
    $stmt->execute(array($adminname,$hashpass));
    $count = $stmt->rowCount();
    $row = $stmt->fetch();
    if ($count > 0) {
    $_SESSION['admin'] = $adminname;
    $_SESSION['username'] = $adminname;
    $_SESSION['id'] = $row['id'];
    header('Location:dashbord.php');
    exit;
    }
}
?>
<form class="login-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
  <h1>admin login</h1>
  <div class="form-input-material">
    <input type="text" name="name" id="username" placeholder=" " autocomplete="off" required class="form-control-material" />
    <label for="username">Username</label>
  </div>
  <div class="form-input-material">
    <input type="password" name="apass" id="password" placeholder=" " autocomplete="off" required class="form-control-material" />
    <label for="password">Password</label>
  </div>
  <input type="submit" class="btn btn-ghost" value="log">
</form>
</body>
</html>