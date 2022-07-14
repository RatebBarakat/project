<?php
session_start();
?>
<style>
                    :root{
    --white:white;
    --black: rgb(0 0 0 / 85%) !important;
    --blue:#006eeb;
    --box-color:  white ;
    --main-color:#71e7ff;
    --nav-color:#0dcaf0;
    --form-label-color:#0400ff; 
    --boxhovereffect: #00ffd5;
    --register-form: #fff;
    --succes-color: #2ecc71;
    --error-color: #e74c3c; 
    --border:#5f5f5fa1;  
    --input:white;
    --color:#3d3d3d;
    --drop-down-color: rgb(0 173 236);
    --container-color: #f5f5f5;
}
body.active{
    --container-color:#040d20;
    --drop-down-color: rgb(0 39 84);
    --black: #fff;
    --blue:#006eeb;
    --box-color: hsl(228deg 8% 12% / 0%);
    /* --main-color: rgba(0, 53, 90, 0.466); */
    --white:rgb(0 9 34);
    --main-color:rgb(0 51 85);
    --nav-color: rgb(0, 53, 90);
    --form-label-color:cyan; 
    --boxhovereffect: cyan;
    --register-form: linear-gradient( to bottom,rgb(17 42 61),rgba(0, 53, 90, 0.466)) ;
    --succes-color: #2ecc71;
    --error-color: #e74c3c;
    --border:#878787;
    --input:rgb(53 53 53);
    --color:lightGrey;
    --form-input-color:rgb(132 142 255 / 20%);
}
.toogle.night {
    transform: translateX(23px);
    transition: transform 0.3s ease-in-out 0s;
}
.dropdown{
    font-size: 20px !important;
}
.dropdown ul li{
    font-size: 15px !important;
}
.night_mode .toogle {
    width: 20px;
    height: 20px;
    vertical-align: middle;
    background: var(--black);
    border-radius: 10px;
    color: var(--black);
    transition: transform 0.3s ease-in-out 0s;
    margin-top: 3px;
    margin-left: 2px;
}
.find{
    width: 95%;
    height: auto;
    position: absolute;
    left: 10px;
    right: 10px;
    top: 106px;
    height: 48px;
    z-index: 11;
    background: var(--main-color);
    outline: none;
    border: 2px solid transparent;
    margin: auto;
    color: var(--black);
    font-size: 20px;
    transition: all 0.3s;
    padding: 0 10px;
    transform: scale(0);
}
header .logo{
    left: 0 !important;
}
header .logo img {
    width: 70px !important;
}
.find:focus{
    border:2px solid var(--boxhovereffect); 
    box-shadow: 0 0 10px var(--boxhovereffect);  
}
.fa-magnifying-glass {
    cursor: pointer;
    font-size: 25px;
    position: absolute;
    top: 116px;
    z-index: 11 !important;
    right: 50px;
}
.find.show{
    transform: scale(1);
}
.find:hover,.find:focus{
    transform: scale(1);
}
.night_mode {
    width: 50px;
    height: 25px;
    background-color: var(--form-label-color) !important;
    color: var(--white);
    border-radius: 10px;
    z-index: 2;
}
.night_mode .toogle{
    color: var(--white);
}
.header{
    margin-bottom: 100px;
}
@media (max-width: 600px) {
header nav.active {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: absolute;
        top: 0px;
        width: 100%;
        height: 50%;
        position: fixed;
        background: var(--nav-color);
        transform: translateX(0%) !important;
        animation: slideDown 400ms  ease-in-out forwards;
        transform-origin: top;
    }
}
nav.active{
    transform: translateX(0) !important;
}
</style>
<header class="header">

    </div>
        <i class="fa-solid fa-bars"></i>
        <div class="night_mode">
            <div class="toogle">

            </div>
        </div>
        <div class="logoLinks">
            <div class="logo"><img src="imgs/logo1.PNG" alt="logo"></div>
        </div>
        <div class="nav">
            <nav>
                <i class="fa-solid fa-xmark"></i>
                <ul style="margin: 0 !important;">
                    <li><a href="homepage.php#home">home</a></li>
                    <li class="drop">
                       <a href="products.php">products</a>
                    </li>
                    <li><a href="contactus.php">contact us</a></li>
                </ul>
            </nav>
            
        </div>
        <?php
        if (isset($_SESSION['admin'])) {
            ?>

  <ul class="menu">
    <li class="dropdown dropdown-6">
      <?php
      $name = '';
      if (strlen($_SESSION['username'])>8) {
          $name = substr($_SESSION['username'],0,8)."...";
      }else $name = $_SESSION['username'];
      echo $name ?>
      <ul class="dropdown_menu dropdown_menu--animated dropdown_menu-6">
        <li style="padding: 0; height: 40px;" class="dropdown_item-1"><a style="    text-decoration: none;
    width: 100%;
    height: 100%;
    text-align: center;
    display: inline-block;
    display: flex;
    justify-content: center;animation: create 0.2s  linear !important;
    align-items: center;" href="members.php?do=edit&userid=<?php echo $_SESSION['id'] ?>">edit profile</a></li>
        <li style="padding: 0; height: 40px;" class="dropdown_item-2"><a style="    text-decoration: none;
    width: 100%;
    height: 100%;
    text-align: center;
    display: inline-block;
    display: flex;
    justify-content: center;
    align-items: center;" href="logout.php">logout</a></li>
            <li style="padding: 0; height: 40px;" class="dropdown_item-2"><a style="    text-decoration: none;
    width: 100%;
    height: 100%;
    text-align: center;
    display: inline-block;
    display: flex;
    justify-content: center;
    align-items: center;" href="dashbord.php">dashborad</a></li>
      </ul>
            <?php
        }elseif (!isset($_SESSION['admin']) && isset($_SESSION['username'])) {
            ?>
            <?php
            include "login.php";
            ?>
                
                <li class="dropdown dropdown-6">
      <?php echo $_SESSION['username']; ?>
      <ul class="dropdown_menu dropdown_menu--animated dropdown_menu-6">
        <li style="padding: 0; height: 40px;" class="dropdown_item-1"><a style="    text-decoration: none;
    width: 100%;
    height: 100%;
    text-align: center;
    display: inline-block;
    display: flex;
    justify-content: center;animation: create 0.2s  linear !important;
    align-items: center;" href="profile.php">profile</a></li>
        <li style="padding: 0; height: 40px;" class="dropdown_item-2"><a style="    text-decoration: none;
    width: 100%;
    height: 100%;
    text-align: center;
    display: inline-block;
    display: flex;
    justify-content: center;
    align-items: center;" href="logout.php">logout</a></li>
    <li style="padding: 0; height: 40px;" class="dropdown_item-2"><a style="    text-decoration: none;
    width: 100%;
    height: 100%;
    text-align: center;
    display: inline-block;
    display: flex;
    justify-content: center;
    align-items: center;" href="card.php?do=card&productid=<?php echo $_SESSION['id']; ?>">
    card (<?php
        $stmt = $con->prepare('SELECT name FROM card WHERE user = ?');
        $stmt->execute(array($_SESSION['id']));
        $count = $stmt->rowCount();
    echo $count;?>)</a></li>
      </ul>
            </div>
        
            <?php
            
        }else{
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $username = $_POST['name'];
                    $password = $_POST['pass'];
                    $hashedPass= sha1($password);
                    $stmt=$con->prepare("SELECT * FROM login WHERE username = ? AND pasword = ?
                     AND regStatus = 1");
                    $stmt->execute(array($username,$hashedPass));
                    $count = $stmt->rowCount();
                    $row = $stmt->fetch();
                    if ($count > 0) {
                    $_SESSION['username'] = $_POST['name'];
                    $_SESSION['id'] = $row['id'];
                        // header('Location:products.php');
                        // exit();    
                }else { echo "<div onclick='remove(this)' style='margin-top:50%;
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
                    padding: 20px;transition: 0.4s;' 
                class='btn btn-danger'>this user is not exist or is not activated</div>";
                }
            }
            ?>
            <script>
                function remove(el) {
                var element = el;    
                element.classList.add('remove');
                setTimeout(() => {
                    element.remove();
                }, 200);
            }
            </script>
            <div class="login">
        login
    </div>
    <form autocomplete="off" id="form" method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">
        <div class="name">
            <input type="text" placeholder=" " name="name" id="name" required maxlength="20">
            <label for="name">name<span class="required-star">*</span></label>
            <small style="visibility: hidden;"></small>
        </div>
        <div class="password">
            <input type="password" placeholder=" " name="pass" id="password" required maxlength="20">
            <label for="pass">password<span class="required-star">*</span></label>
            <small style="visibility: hidden;"></small>
        </div>
        <div class="register_login">
            <a target="_blank" href="register.php">Register?</a>
            <a target="_blank" href="adminlogin.php">adminlogin</a>
            <input type="submit" value="submit">
        </div>
    </form>
    <?php
    ?>
            <?php
        }
        
        ?>

    </header>
    