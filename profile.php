<?php   
ob_start();
    include 'login.php';
    include 'functions.php';
    
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>profile</title>
        <link rel="stylesheet" href="style/header.css">
        <link rel="stylesheet" href="style/home_style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" />
        <script src="home.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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

            table{
                width: 95% !important;
                margin: auto;
            }
            table tr{
                background-color: white;
            }
            table tr:nth-child(odd){
                background-color: var(--blue);
                color: white;
            }
            h1{
                color: var(--blue);
                text-align: center;
            }
        </style>
    </head>
    <body>
    <?php  include 'header.php'; 
    checkUserLogin();
 if (!isset($_SESSION['username'])) {
            redirectHome("you are not loged",2);
        }else {
    echo  "<h1>". $_SESSION['username']. "</h1>";
?>
    <div class="backtoup">
        up
    </div>
    <table class="main-table table table-bordered">
    <?php
        $stmt = $con->prepare("SELECT * FROM login
        WHERE id = ?");
        $stmt->execute(array($_SESSION['id']));
        $count = $stmt->rowCount();
        $rows = $stmt->fetchAll();
        foreach ($rows as $row) {
            echo "<tr><td>username:</td>";
            echo "<td>".$row['username']."</td></tr>";
            echo "<tr><td>email:</td>";
            echo "<td>".$row['email']."</td></tr>";
            echo "<tr><td>gender:</td>";
            echo "<td>".$row['gender']."</td></tr>";
            echo "<tr><td>date of birth:</td>";
            echo "<td>".$row['birth']."</td></tr>";
        }
        // foreach ($rows as $row) {
        //     echo "<tr>
        //     <td>username:</td>
        //     <td>email:</td>
        //     <td>gender:</td>
        //     <td>birth:</td></tr>";
        //     echo "<tr>
        //     <td>". $row['username'] ."</td>
        //     <td>". $row['email'] ."</td>
        //     <td>". $row['gender'] ."</td>
        //     <td>". $row['birth'] ."</td></tr>";
        // }
    ?>
    </table>
    <?php } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
               
    </body>
    </html>
    <?php
ob_end_flush();
    ?>
