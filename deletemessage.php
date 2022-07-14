<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete</title>
    <link rel="stylesheet" href="style/home_style.css">
    <link rel="stylesheet" href="style/header.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style/members.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" />
    
</head>
<body>
<?php
    ob_start();
        include "login.php";
        include 'header.php';
        include 'functions.php';
        checkUserLogin();
        if (isset($_SESSION['admin'])) {
            if (isset($_GET['message'])) {
                $message=isset($_GET['message'])&& 
                is_numeric($_GET['message'])?intval($_GET['message']):0;   

                $stmt = $con->prepare("DELETE FROM contact WHERE id = $message");
                $stmt->execute();
                $row = $stmt->rowCount();
                if ($row>0) {
                        echo "<div class='alert alert-danger'>message deleted succesfull</div>";
    echo "<div class='alert alert-info'>You Will Be Redirected After 1 Seconds.</div>";
    header("refresh:1;url=admincontact.php");
                }else {
                        echo "<div class='alert alert-danger'>there is no message to delete</div>";
    echo "<div class='alert alert-info'>You Will Be Redirected After 1 Seconds.</div>";
    header("refresh:1;url=admincontact.php");
                }
            }
        }

?>
    </body>
</html>