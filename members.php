<?php ob_start();
    
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/home_style.css">
    <link rel="stylesheet" href="style/header.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style/members.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" />
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
.main-table tr:first-child td {
    background-color: var(--nav-color);
    color: var(--black);
}
label {
    display: inline-block;
    color: var(--black);
}
        table tr td{
            background-color: var(--table-color);
            vertical-align: middle;
        }
        input:not([type="submit"]){
            background-color: var(--form-input-color) !important;
            color: var(--black) !important;
        }
        .btn{
            margin-bottom: 7px;
        }
    </style>
</head>

<body>
    <?php
    include "login.php";
    include 'header.php';
    include 'functions.php';
    checkUserLogin();
    if (isset($_SESSION['admin'])) {


        if (!isset($_SESSION['admin'])) {
            header('Location: adminlogin.php');
        }
        $do = '';
        $id = '';

        if (isset($_GET['do'])) {
            echo $id;
            $do = $_GET['do'];
            $userid=isset($_GET['userid'])&& is_numeric($_GET['userid'])?intval($_GET['userid']):0;
            if ($do == "manage") {
                $query='';
if (isset($_GET['page']) == "pending"){
    $query = 'AND regStatus=0'; 
}
                $stmt = $con->prepare("SELECT * FROM login WHERE group_id != 1 $query");
                // Execute The Statement
                $stmt->execute();
                // Assign To Variable
                $rows = $stmt->fetchAll();
    ?>
                <hl class="text-center">Manage Members</hl>
                <div class="container">
                    <div class="table-responsive">
                        <table class="main-table table table-bordered">
                            <tr>
                                <td>#ID</td>
                                <td>Username</td>
                                <td>Email</td>
                                <td>Registerd Date</td>
                                <td>Control</td>
                            </tr>
                            <?php
                            foreach ($rows as $row) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['date_of_register'] . "</td>";
                                echo "<td>
        <a href='members.php?do=edit&userid=" . $row['id'] . "'class='btn btn-success'>Edit</a>
        <a href='members.php?do=delete&userid=" . $row['id'] . "'
        class='btn btn-danger confirm'>delete</a>";
        if ($row['regStatus'] == 0) {
            echo "<a style='margin:0 5px;' href='members.php?do=activate&userid=" . $row['id'] . "'class='btn btn-info'>activate</a>";
        }
echo "</td>";
                            }
                            ?>
                        </table>
                        <a href="members.php?do=insert" class="btn btn-info">Add New Member</a>
                        <a href="dashbord.php" class="btn btn-info">dashboard</a>
                        <a href="adproducts.php?do=manage" class="btn btn-info">products</a>
                        
                    </div>
                <?php } elseif ($do == "edit" && isset($_GET['userid'])) { //edit page
                // include "header.php";
                $id = $userid;
                $stmt = $con->prepare("SELECT * FROM login WHERE id = ?");
                $stmt->execute(array($userid));
                $count = $stmt->rowCount();
                $row = $stmt->fetch();
                if ($count>0) {
                    ?>
                    <div class="form-body">
                        <h1 style="margin-top: auto;color:var(--form-label-color);" class="text-center">Edit Member</h1>
                        <div class="container">
                            <form style="margin: 10px;" class="form-horizontal" method="POST" action="members.php?do=update&userid=<?php echo $id ?>">
                                <!-- Start Username Field -->
                                <div class="form-group form-gr">
                                    <label class="col-sm-2 control-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?php echo $row['username']; ?>" name="uname" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <!-- End Username Field -->
                                <!-- Start Password Field -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10">
                                        <i class="fa-solid fa-eye i"></i>
                                        <input id="pass" placeholder="dont input value if you want t change password" type="password" name="newpassword" class="form-control password" autocomplete="off">
                                        <input id="pass" value="<?php echo $row['pasword']; ?>" type="hidden" name="upassword" class="form-control password" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">email</label>
                                        <div class="col-sm-10">
                                            <input value="<?php echo $row['email']; ?>" type="text" name="uemail" class="form-control" autocomplete="off">
                                        </div>
                                        
                                    </div>
                                    <input type="submit" value="update" class="btn btn-info">
                            </form>
                    <?php
                }
                else {
                    redirectHome("there is no such id", 3,'back');
                    exit;
                }
                ?>
                
                            <?php
                        } elseif ($do == "update" && isset($_GET['userid'])) {
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $arrayoferrors = (array) null;
                                // include "header.php";
                                echo '<h1>update</h1>';
                                $pass = '';
                                if (empty($_POST['newpassword'])) {
                                    $pass = $_POST['upassword'];
                                } else {
                                    $pass = sha1($_POST['newpassword']);
                                };
                                $username = $_POST['uname'];
                                $password = $pass;
                                $email = $_POST['uemail'];
                                if (empty($username)) {
                                    array_push($arrayoferrors, 'name can not be emty');
                                } elseif (strlen($username) < 2) {
                                    array_push($arrayoferrors, 'name can not less than 2 char');
                                } elseif (strlen($username) > 20) {
                                    array_push($arrayoferrors, 'name can not geater than 20 char');
                                }
                                function nullcheck($input, array $array, $message)
                                {
                                    if (empty($input)) {
                                        array_push($array, $message);
                                    }
                                }
                                nullcheck($password, $arrayoferrors, 'name can not be emty');

                                if (empty($email)) {
                                    array_push($arrayoferrors, 'email can not be emty');
                                }
                                if (empty($arrayoferrors)) {
                                    $stmt = $con->prepare("UPDATE login SET username = ?, pasword = ?, email = ?
            WHERE id =?");
                                    $stmt->execute(array($username, $password, $email, $userid));
                                    $count = $stmt->rowCount();
                                    $msg = "$count user updated";
                                    accec($msg,1,'back');
                                } else {
                                    foreach ($arrayoferrors as $error) {
                                        echo "<div class='alert alert-danger'>$error</div>";
                                    }
                                }
                            } else {
                                redirectHome("you can not browze this page directly", 3,'back');
                            }
                        } elseif ($do == 'insert') {
                            // include "header.php";
                            if (isset($_SESSION['admin'])) {
                                echo '<h1>insert</h1>';
                            ?>
                                <form style="margin: 10px;" class="form-horizontal" method="POST" action="members.php?do=add">
                                    <!-- Start Username Field -->
                                    <div class="form-group form-gr">
                                        <label class="col-sm-2 control-label">Username</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="iname" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                    <!-- End Username Field -->
                                    <!-- Start Password Field -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-10">
                                            <i class="fa-solid fa-eye i"></i>
                                            <input type="password" name="ipass" class="form-control password" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">email</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="iemail" class="form-control" autocomplete="off">
                                            </div>
                                            <label for="flexRadioDefault1">
                                                gender
                                            </label>
                                            <div class="form-check">
                                                <input class="" type="radio" value="male" name="gender" id="flexRadioDefault1" />
                                                <label class="form-check-label" for="flexRadioDefault1"> male </label>
                                            </div>

                                            <!-- Default checked radio -->
                                            <div class="form-check">
                                                <input style="filter: grayscale(1);filter: hue-rotate(120deg);" class="" type="radio" value="femele" name="gender" id="flexRadioDefault2" checked />
                                                <label class="form-check-label" for="flexRadioDefault2"> femele </label>
                                            </div>
                                            <div>
                                                <input style="display: block;" type="date" name="date" id="date">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" value="">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">admin?</label>
                                                </div>
                                                <input type="submit" value="insert" class="btn btn-info">
                                </form>
                            <?php
                            } else {
                                redirectHome("you are not an admin you will be
                                 redirected to home page after 3 second$", 3,'homepage.php');
                            }
                            ?>
                <?php


                        } elseif ($do == "add") {
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                                $arrayoferrors = (array) null;
                                // include "header.php";
                                echo '<h1>add</h1>';
                                $username = $_POST['iname'];
                                $stmt = $con->prepare("SELECT * FROM login
                                WHERE username = ?");
                                $stmt->execute(array($username));
                                $count = $stmt->rowCount();
                                $row = $stmt->fetchAll();
                                $password = $_POST['ipass'];
                                $hashedPass = sha1($password);
                                $email = $_POST['iemail'];
                                $gender = $_POST['gender'];
                                $datebirth = $_POST['date'];
                                if ($count > 0) {
                                    array_push($arrayoferrors, 'this user is already exist');
                                }
                                if (empty($username)) {
                                    array_push($arrayoferrors, 'name can not be emty');
                                } elseif (strlen($username) < 2) {
                                    array_push($arrayoferrors, 'name can not less than 2 char');
                                } elseif (strlen($username) > 20) {
                                    array_push($arrayoferrors, 'name can not geater than 20 char');
                                }
                                if (empty($email)) {
                                    array_push($arrayoferrors, 'email can not be emty');
                                }
                                if (empty($password)) {
                                    array_push($arrayoferrors, 'password can not be emty');
                                }
                                if (empty($arrayoferrors)) {
             $stmt = $con->prepare("INSERT INTO login(username,pasword,email,birth,gender,regStatus)
                                    VALUES (?,?,?,?,?,1);");
                                    $stmt->execute(array($username, $hashedPass, $email, $datebirth, $gender));
                                    $count = $stmt->rowCount();
                                    $msg = ' user added';
                                    accec($msg,1,'members.php?do=manage');
                                } else {
                                    foreach ($arrayoferrors as $error) {
                                        echo "<div class='alert alert-danger'>$error</div>";
                                        header('refresh:1,url=members.php?do=manage');
                                    }
                                }
                            }
                        } elseif ($do == "delete" && isset($_GET['userid'])) {
                            $stmt = $con->prepare("SELECT * FROM login WHERE id = ?");
                            $stmt->execute(array($userid));
                            $count = $stmt->rowCount();
                            $row = $stmt->fetch();
                            if ($count > 0) {
                                $stmt = $con->prepare("DELETE FROM login WHERE id=:zuser");
                                $stmt->bindParam(":zuser", $userid);
                                $stmt->execute();
                                $msg = ' user deleted';
                                accec($msg,1,'members.php?do=manage');
                            } else {
                                echo 'This ID is Not Exist';
                            }
                        }elseif ($do="activate" && isset($userid)) {
                            echo "<h1>activate</h1>";
                            $stmt = $con->prepare("UPDATE login SET regStatus = 1 WHERE id =?"); 
                            $stmt->execute(array($userid));
                            $count = $stmt->rowCount();
                            accec("$count activted",2,'members.php?do=manage');
                        }
                    } else { //if not exist do
                        echo 'you can not browze this page directly';
                    }
                } else {
                    redirectHome("you are not an admin
             you will be redirected o admin login page after 2 second", 2,'adminlogin.php');
                }
                ?>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
                <script>
                    // darkmode
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
                    const alldelete = document.querySelectorAll('.confirm').forEach(conf => {
                        conf.addEventListener('click', () => {
                            var confir = confirm("are you sure you want to delete this user");
                            if (confir) {
                                return true;
                            } else {
                                event.preventDefault();
                                event.stopPropagation();
                                return false;
                            }
                        })
                    });
                    const togglePassword = document.querySelectorAll('.i');
                    const password = document.querySelectorAll('.password');

                    togglePassword.forEach(passt => {
                        passt.addEventListener('click', function(e) {
                            // toggle the type attribute
                            const type = passt.nextElementSibling.getAttribute('type') === 'password' ? 'text' : 'password';
                            passt.nextElementSibling.setAttribute('type', type);
                            // toggle the eye slash icon
                            passt.classList.toggle("fa-eye-slash");
                        });
                    });
                </script>
</body>

</html>
<?php
ob_end_flush(); ?>
