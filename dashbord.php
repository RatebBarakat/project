<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashbord</title>
    <?php
    session_start();
    include "functions.php";
    include "login.php";
    ob_start();
    checkUserLogin();
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        :root {
            --white: white;
            --black: #2a2a2a;
            --blue: #006eeb;
            --box-color: white;
            --main-color: rgb(162, 217, 255);
            --nav-color: rgb(162, 217, 255);
            --form-label-color: #0400ff;
            --boxhovereffect: #080077f8;
            --register-form: #fff;
            --succes-color: #2ecc71;
            --error-color: #e74c3c;
            --form-input-color: white;
            --drop-down-color: rgb(78 208 255);
        }
        body.active{
    --table-color:#363636;
    --drop-down-color: rgb(0 39 84);
    --form-input-color:rgba(248, 255, 174, 0.2);
    --white:rgb(0 9 34);
    --black: #fff;
    --blue:#006eeb;
    --box-color: hsl(0deg 0% 20% / 44%);
    /* --main-color: rgba(0, 53, 90, 0.466); */
    --nav-color: rgb(0, 53, 90);
    --main-color:rgb(0 60 101);
    --form-label-color:cyan; 
    --boxhovereffect: rgba(0, 0, 102, 0.548);
    --register-form: linear-gradient( to bottom,rgb(17 42 61),rgba(0, 53, 90, 0.466)) ;
    --succes-color: #2ecc71;
    --error-color: #e74c3c;
}

        .home-stats .stat {
            background-color: #EEE;
            border: 1px solid #CCC;
            padding: 20px;
            border-radius: 10px;
            font-size: 15px;
            color: white;
        }
        .col-md-3{
            margin-bottom: 10px;
        }
        .col-md-3 span a{
            height: 100%;
            display: block;
        }
        body{
            background-color: #f1f1f1;
        }
        .latest-users li a{
            float: right;
        }
        .home-stats .stat span {
            display: block;
            font-size: 35px;
        }
        .panel-body{
            background: #fff;
            padding: 5px;
        }
        .latest {
            margin-top: 30px;
        }
        .panel-heading{
            border: 1px solid #dbdbdb;
    padding: 8px;
    border-radius: 5px;
        }
        .home-stats .st-members {
            background-color: #df2be2;
        }
        .stat{
            white-space: nowrap;
        }
        .home-stats .st-pending {
            background-color: rgb(0 151 255);
        }

        .home-stats .st-items {
            background-color: red;
        }

        .home-stats .st-comments {
            background-color: #ffa500;
        }

        .home-stats span a {
            text-decoration: none;
            color: white;
        }
        .latest-users{
            margin: auto;
        }
        .latest-users li{
            padding: 5px 0;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div class="container home-stats text-center">
        <h1>Dashboard</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="stat st-members">Total Members
                    <span><a href="members.php?do=manage"><?php echo countItems('id','login','WHERE
                    group_id!=1') ?></a>
                    </span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-pending">contacts
                    <span><a href="admincontact.php"><?php
                        echo countItems('id','contact','')
                    ?></a></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-items">products
                    <span>
                        <a href="adproducts.php?do=manage"><?php echo countItems('id','products','') ?></a>
                    </span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-comments">envoices
                    <span>
                    <a href="allenvoices.php?do=manage">
                    <?php echo countItems('id','envoices','') ?></a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="latest">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-users"></i> Latest <?php echo $registeruser = 5 ?> Registerd Users
                        </div>
                        <div class="panel-body">
                        <ul class="list-unstyled latest-users">
    <?php
    $thelatest = (array) getlatest("*","login","username",5,"WHERE group_id = 0");
         foreach ($thelatest as $user){
              echo '<li>'. $user[ 'username']. 
              '<a href="members.php?do=edit&userid='.$user['id'].
               '"class="btn btn-success pull-right">
              edit</a></li>';
         }
     ?>
</ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-users"></i> Latest <?php echo $registeruser = 5 ?>Registerd Users
                        </div>
                        <div class="panel-body">
                        <ul class="list-unstyled latest-users">
    <?php
    $thelatestproducts = (array) getlatest("*","products","productname",5);
         foreach ($thelatestproducts as $product){
              echo '<li>'. $product[ 'productname']. 
              '<a href="adproducts.php?do=edit&userid='.$product['id'].
               '"class="btn btn-success pull-right">
              edit</a></li>';
         }
     ?>
</ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<?php 
ob_end_flush();
?>
</body>

</html>