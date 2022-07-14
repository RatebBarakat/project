<?php
ob_start();
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

.col-sm-10 {
    flex: 0 0 auto;
    width: 100%;
    margin: auto;
}
.form-group{
    width: 80%;
    margin: auto;
}
@media (max-width:400px) {
    .form-group{
        width: 100%;
    }
}

        table tr td {
            background-color: var(--table-color);
            vertical-align: middle;
        }
        label {
    display: inline-block;
    color: var(--black);
}
        table tr:first-child td {
    background-color: var(--nav-color) !important;
    color: var(--black) !important;
}
        .container{
            max-width: none !important;
            max-width: unset !important;
        }
        label{
            color: var(--black) !important;
        }
        input:not([type="submit"]),textarea{
            background-color: var(--form-input-color) !important;
            color: var(--black) !important;
        }
        textarea {
            resize: none;
            width: 100%;outline: none;
            border: 2px solid transparent;
        }
        textarea:focus{
            outline: none;
            border: 2px solid var(--form-label-color);
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
            $userid=isset($_GET['userid'])&& is_numeric($_GET['userid'])?intval($_GET['userid']):0;   
            $do = $_GET['do'];
            if ($do == "manage") {
                $query = '';
                if (isset($_GET['page']) == "pending") {
                    $query = 'WHERE visibility=1';
                }
                $stmt = $con->prepare("SELECT * FROM products $query");
                // Execute The Statement
                $stmt->execute();
                // Assign To Variable
                $rows = $stmt->fetchAll();
    ?>
                <hl class="text-center">Manage products</hl>
                <div class="container">
                    <div class="table-responsive">
                        <table class="main-table table table-bordered">
                            <tr>
                                <td>name</td>
                                <td>description</td>
                                <td>price</td>
                                <td>image</td>
                                <td>visibility</td>
                                <td>poster</td>
                                <td>control</td>
                            </tr>
                            <?php
                            foreach ($rows as $row) {
                                $stmt = $con->prepare("SELECT * FROM products,login WHERE
                                products.poster=login.id AND products.id=?;");
                                // Execute The Statement
                                $stmt->execute(array($row['id']));
                                // Assign To Variable
                                $row1 = $stmt->fetch();
                                echo "<tr>";
                                echo "<td>" . $row['productname'] . "</td>";
                                echo "<td>" . $row['description'] . "</td>";
                                echo "<td>" . $row['price'] . "</td>";
                                echo "<td>" . $row['image'] . "</td>";
                                echo "<td>" . $row['visibility'] . "</td>";
                                echo "<td>" . $row1['username'] . "</td>";
                                echo "<td>
        <a href='adproducts.php?do=edit&userid=" . $row['id'] . "'class='btn btn-success'>Edit</a>
        <a href='adproducts.php?do=delete&userid=" . $row['id'] . "'
        class='btn btn-danger confirm'>delete</a>";
                                if ($row['visibility'] == 1) {
                                    echo "<a style='margin:0 5px;'
                                    href='adproducts.php?do=activate&userid=" . $row['id'] . 
                                    "'class='btn btn-primary'>activate</a>";
                                }
                                echo "</td>";
                            }
                            ?>
                        </table>
                        <a href="adproducts.php?do=insert" class="btn btn-primary">Add New product</a>
                        <a href="dashbord.php" class="btn btn-primary">dashboard</a>
                    </div>
                <?php } elseif ($do == "edit" && isset($_GET['userid'])) { //edit page
                // include "header.php";
                $id = $_GET['userid'];
                if (isset($_SESSION['admin'])) {
                    $stmt = $con->prepare("SELECT * FROM products WHERE id = ?");
                    // Execute The Statement
                    $stmt->execute(array($userid));
                    // Assign To Variable
                    $row = $stmt->fetch();
                    echo '<h1>edit product</h1>';
                ?>
                   <div class="form-body">
            <div class="container">
                <form enctype="multipart/form-data" style="margin: 10px;" 
                class="form-horizontal" 
                method="POST" action="adproducts.php?do=update&userid=<?php echo $row['id']; ?>">
                    <!-- Start Username Field -->
                    <div class="form-group form-gr">
                        <label class="col-sm-2 control-label">product name</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?php echo $row['productname'] ?>" name="pname" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <!-- End Username Field -->
                    <!-- Start Password Field -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">description</label>
                        <div class="col-sm-10">
                            <textarea name="description"
                            id="desc" cols="30" rows="10">
        <?php echo $row['description'] ?>
        </textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">price</label>
                        <div class="col-sm-10">
                            <input type="text"value="<?php echo $row['price'] ?>"  name="price" class="form-control" autocomplete="off">
                        </div>
                        <label for="v1">
                                    visibility
                                </label>
                        <div class="form-check">
                            <input class="" type="radio" value="0" name="visibility" checked id="flexRadioDefault1" />
                            <label class="form-check-label" for="v1"> yes </label>
                        </div>

                        <!-- Default checked radio -->
                        <div class="form-check">
                            <input style="filter: grayscale(1);filter: hue-rotate(120deg);" class="" 
                            type="radio" value="1" name="visibility" id="flexRadioDefault2" />
                            <label class="form-check-label" for="v2"> no </label>
                        </div>
                    <label for="poster">poster</label>
                    <select style="display: block;" name="poster" id="poster" default="">
                        <?php
                        $stmt = $con->prepare("SELECT id,username FROM login");
                        $stmt->execute();
                        $count = $stmt->rowCount();
                        $posters = $stmt->fetchAll();
                        $check = "";
                       
                        foreach ($posters as $poster) { 
                            if ((int)$poster['id']==(int)$row['poster']) {
                            $check="selected";
                            echo "good";
                        }else $check = "";
                            echo "<option ".$check." value=".$poster['id']."
                            >".$poster['username']."</option>";
                        }
                        ?>
                    </select>
                    <input type="file"class="col-sm-10" name="newimage" id="image" style="display: block;width: 100%;">
                    <input type="hidden" name="image" id="image"
                                value="<?php echo $row['image']?>"
                                style="display: block;width: 100%;">
                        <!-- submit -->
                        <input type="submit" value="insert" class="btn btn-primary">
                    </div>

                </form>
                <?php
                } else {
                    redirectHome("you are not an admin you will be
                     redirected to home page after 3 second$", 3, 'homepage.php');
                }
                ?>
                            <?php
                        } elseif ($do == "update" && isset($_GET['userid'])) {
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $arrayoferrors = (array) null;
                                // include "header.php";
                                echo '<h1>update product</h1>';
                                $pname = $_POST['pname'];
                                $description = $_POST['description'];
                                $price = $_POST['price'];
                                $visibility = $_POST['visibility'];
                                $poster = $_POST['poster'];
                                $imagevalue = '';
                                if ($_FILES['newimage']['name'] == "") {
                                $imagevalue = $_POST['image'];
                                }else{ 
                                $newimagevalue = $_FILES['newimage']['name'];
                                $newimageName=$_FILES['newimage']['name'];
                                $newimagesize=$_FILES['newimage']['size'];
                                $newimageTmp=$_FILES['newimage']['tmp_name'];
                                $newimageType=$_FILES['newimage']['type'];
                                // List Of Allowed File Typed To Uploa
                                $cond = ".";
                                // $imageextention = strtolower(end(explode($cond,$imageName)));
                                // $imageAllowedExtension=array("jpeg", "jpg", "png");
                                $imagevalue = rand(0, 1000000000).$newimageName;
                                move_uploaded_file($newimageTmp,"uploads\image\\".$imagevalue);
                                }
                                
                                if (empty($pname)) {
                                    array_push($arrayoferrors, 'name can not be emty');
                                } elseif (strlen($pname) < 2) {
                                    array_push($arrayoferrors, 'name can not less than 2 char');
                                } elseif (strlen($pname) > 20) {
                                    array_push($arrayoferrors, 'name can not geater than 20 char');
                                }
                                function nullcheck($input, array $array, $message)
                                {
                                    if (empty($input)) {
                                        array_push($array, $message);
                                    }
                                }
                                if (empty($arrayoferrors)) {
                                $update = $con->prepare("UPDATE products SET productname = ?, description = ?, 
                                price = ?,visibility=?,poster=?,image=? WHERE id = ?");
                                $update->execute(array($pname, $description, $price,
                                $visibility,$poster,$imagevalue,$userid));
                                $pr = $update->fetch();
                                $count = $update->rowCount();
                                    $msg = "$count product updated";
                                    redirectHome($msg, 1, 'adproducts.php?do=manage');
                                } else {
                                    foreach ($arrayoferrors as $error) {
                                        echo "<div class='alert alert-danger'>$error</div>";
                                    }
                                }
                            } else {
                                redirectHome("you can not browze this page directly", 3, 'back');
                            }
                        } elseif ($do == 'insert') {
                            // include "header.php";
                            if (isset($_SESSION['admin'])) {
                                echo '<h1>insert</h1>';
                            ?>
                               <div class="form-body">
                        <div class="container">
                            <form enctype="multipart/form-data" style="margin: 10px;" 
                            class="form-horizontal" 
                            method="POST" action="adproducts.php?do=add">
                                <!-- Start Username Field -->
                                <div class="form-group form-gr">
                                    <label class="col-sm-2 control-label">product name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="pname" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <!-- End Username Field -->
                                <!-- Start Password Field -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">description</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" id="desc" cols="30" rows="10">
                    
                    </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">price</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="price" class="form-control" autocomplete="off">
                                    </div>
                                    <label for="v1">
                                                visibility
                                            </label>
                                    <div class="form-check">
                                        <input class="" type="radio" value="visibility" name="visibility" checked id="flexRadioDefault1" />
                                        <label class="form-check-label" for="v1"> yes </label>
                                    </div>

                                    <!-- Default checked radio -->
                                    <div class="form-check">
                                        <input style="filter: grayscale(1);filter: hue-rotate(120deg);" class="" 
                                        type="radio" value="femele" name="visibility" id="flexRadioDefault2" />
                                        <label class="form-check-label" for="v2"> no </label>
                                    </div>
                                <label for="poster">poster</label>
                                <select style="display: block;" name="poster" id="poster">
                                    <?php
                                    $stmt = $con->prepare("SELECT id,username FROM login");
                                    $stmt->execute();
                                    $count = $stmt->rowCount();
                                    $posters = $stmt->fetchAll();
                                    foreach ($posters as $poster) {
                                        echo "<option value=".$poster['id']."
                                        >".$poster['username']."</option>";
                                    }
                                    ?>
                                </select>
                                <input type="file" class="col-sm-10" name="image" id="image" style="display: block;width: 100%;">
                                <select name="type" id="type">
                                    <option value="android" selected>android</option>
                                    <option value="ios">ios</option>
                                    <option value="huwai">huwai</option>
                                    <option value="poco">poco</option>
                                </select>
                                    <!-- submit -->
                                    <input type="submit" value="insert" class="btn btn-primary">
                                </div>

                            </form>
                            <?php
                            } else {
                                redirectHome("you are not an admin you will be
                                 redirected to home page after 3 second$", 3, 'homepage.php');
                            }
                            ?>
                <?php


                        } elseif ($do == "add") {
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $imageName=$_FILES['image']['name'];
                                $imagesize=$_FILES['image']['size'];
                                $imageTmp=$_FILES['image']['tmp_name'];
                                $imageType=$_FILES['image']['type'];
                                // List Of Allowed File Typed To Uploa
                                $cond = ".";
                                // $imageextention = strtolower(end(explode($cond,$imageName)));
                                // $imageAllowedExtension=array("jpeg", "jpg", "png");
                                $image = rand(0, 1000000000).$imageName;
                                move_uploaded_file($imageTmp,"uploads\image\\".$image);
                                $arrayoferrors = (array) null;
                                // include "header.php";
                                echo '<h1>add</h1>';
                                $pname = $_POST['pname'];
                                $description = $_POST['description'];
                                $price = $_POST['price'];
                                $visibility = $_POST['visibility'];
                                $poster = $_POST['poster'];
                                $type = $_POST['type'];
                                if (empty($pname)) {
                                    array_push($arrayoferrors, 'name can not be emty');
                                } elseif (strlen($pname) < 2) {
                                    array_push($arrayoferrors, 'name can not less than 2 char');
                                } elseif (strlen($pname) > 20) {
                                    array_push($arrayoferrors, 'name can not geater than 20 char');
                                }
                                if (empty($arrayoferrors)) {
                                    $stmt = $con->prepare("INSERT INTO products(productname,description,
                                    price,visibility,image,poster,type)
                                    VALUES(?,?,?,?,?,?,?);");
                                    $stmt->execute(array($pname,$description,$price,
                                                         $visibility,$image,$poster,$type));
                                    $count = $stmt->rowCount();
                                    $row = $stmt->fetchAll();
                                    $count = $stmt->rowCount();
                                    $msg = "$count product added";
                                    accec($msg, 1, 'adproducts.php?do=manage');
                                } else {
                                    foreach ($arrayoferrors as $error) {
                                        echo "<div class='alert alert-danger'>$error</div>";
                                        header('refresh:1,url=adproducts.php?do=manage');
                                    }
                                }
                            }
                        } elseif ($do == "delete" && isset($_GET['userid'])) {
                            $stmt = $con->prepare("SELECT * FROM products WHERE id = ?");
                            $stmt->execute(array($userid));
                            $count = $stmt->rowCount();
                            $row = $stmt->fetch();
                            $imageproduct = $row['image'];
                            if ($count > 0) {
                               
                                $delete = $con->prepare("DELETE FROM products WHERE id=:zuser");
                                $delete->bindParam(":zuser", $userid);
                                $delete->execute();
                                $count = $delete->rowCount();
                                $msg = "$count product deleted";
                                 if (unlink("C:\\xampp\\htdocs\\rateb barakat\\uploads\\image\\$imageproduct")) {
                                    accec($msg, 1, 'adproducts.php?do=manage');
                                    } else {
                                    redirectHome('there no such product',1,'back');
                                    }
                            } else {
                                echo 'This ID is Not Exist';
                            }
                        } elseif ($do = "activate" && isset($userid)) {
                            echo "<h1>activate</h1>";
                            $stmt = $con->prepare("UPDATE products SET visibility = 0 WHERE id =?");
                            $stmt->execute(array($userid));
                            $count = $stmt->rowCount();
                            accec("$count activted", 2, 'adproducts.php?do=manage');
                        }
                    } else { //if not exist do
                        echo 'you can not browze this page directly';
                    }
                } else {
                    redirectHome("you are not an admin
             you will be redirected o admin login page after 2 second", 2, 'adminlogin.php');
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
    ob_end_flush();
?>