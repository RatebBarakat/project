<?php ob_start();
    
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>card</title>
    <link rel="stylesheet" href="style/home_style.css">
    <link rel="stylesheet" href="style/header.css">
    <script src="dark.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
.table-responsive table tr{
    background-color: transparent ;
    color: var(--black) ;
}
.table-responsive table tr:first-of-type {
    background-color: var(--nav-color) ;
    color: var(--black) ;
}

        a .btn-info{
            text-decoration: none;
            display: block;
            margin-left: 10px !important;
        }
        .table-responsive{
            width: 90% !important;
            margin: auto;
            
        }
        @media (max-width:350px) {
            .table-responsive {
    width: 100% !important;
    margin: auto;
}
        }
        body{
            background-color: var(--white) !important;
        }
        table{
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
    include "login.php";
    include "functions.php";
    include "header.php";
    checkUserLogin();
    if (!isset($_SESSION['username'])) {
        redirectHome('',3,null);
    } else {//isset session to user
        
        if (isset($_GET['do'])&&isset($_GET['productid'])) {
            $productid=isset($_GET['productid'])&& is_numeric($_GET['productid'])?intval($_GET['productid']):0;   
            $productid = $_GET['productid'];
            $do = $_GET['do'];
            if ($do == "add") {  
                $errors = (array)null;                                 
                $stmt = $con->prepare("SELECT * FROM products WHERE id=?");
                $stmt->execute(array($productid));
                $row = $stmt->fetch();
                $productname = $row['productname'];
                $productprice = $row['price'];
                $productuser = $_SESSION['username'];
                $stmtcheck = $con->prepare("SELECT * FROM card WHERE name=? AND user = ?");
                $stmtcheck->execute(array($productname,$_SESSION['id']));
                $rowcheck = $stmtcheck->rowCount();
                if ($rowcheck>0) {
                    array_push($errors,'this product is already exict');
                }
                
            if (empty($errors)) {
                $id=$_SESSION['id'];
                $stmtinsert = $con->prepare("INSERT INTO card(name,price,user,quantity) VALUE(?,?,?,?);");
            $stmtinsert->execute(array($productname,$productprice,$id,$_POST['quantity']));
            $rowinserted = $stmt->rowCount();
            echo "<div class='alert alert-success'>$rowinserted product added to card</div>";
            header("refresh:2,url=card.php?productid=$id&do=card");
            exit;
            } else {
                foreach ($errors as $error ) {
                    redirectHome($error,2,"back");
                }
            }
            
            }elseif ($do == "card") {
                       
                $stmt = $con->prepare("SELECT * FROM card WHERE user=?");
                $stmt->execute(array($_SESSION['id']));
                $cards=$stmt->fetchAll();
                $cardcount = $stmt->rowCount();
                if ($cardcount=0) {
                    redirectHome('your card is emty',1,"back");
                }
                ?>
                
                <h1 style="color: var(--blue); margin: 10px auto; text-align: center;">card</h1>
                <div class="table-responsive">
                            <table class="main-table table table-bordered">
                                <tr>
                                    <td>product name</td>
                                    <td>quantity</td>
                                    <td>price</td>
                                    <td>Control</td>
                                </tr>
                                <?php
                                $totalprice = (int) 0;
                                foreach ($cards as $card) {
                                    $cardid=$card['id'];
                                    $productprice = $card['price']*$card['quantity'];
                                    echo "<tr>";
                                    echo "<td>" . $card['name'] . "</td>";
                                    echo "<td>" . $card['quantity']. "</td>";
                                    echo "<td>" .$card['price']. "</td>";
                                    
                                    echo "<td>
                                    <a href ='card.php?productid=$productid&do=delete&cardid=$cardid' 
                                    class='btn btn-danger'>delete</a>
                                        </td>";
                                    
                                    echo "</tr>";  
                                    $totalprice+=$productprice;     
                                }
                                echo "
                                <tr>
                                <td colspan='3'>Total price:</td>
                                <td >
                                $totalprice
                                </td>
                                
                                </tr>
                                </table>
                                <a href='envoice.php' id='btnp' class='btn btn-info'>purshase</a>
                                <a class='btn btn-info' href='products.php'>
                                back to products page</a>
                            </div>";
                            ?>
                            <?php
            }elseif ($do=="delete" && isset($_GET['cardid'])) {
                echo "<h1>delete</h1>";
                $stmt = $con->prepare("DELETE FROM card WHERE id=:zuser");
                                $stmt->bindParam(":zuser", $_GET['cardid']);
                                $stmt->execute();
                redirectHome(' product deleted',2,'back');
            }
            ?>
            
            <?php
        }
        else{
        redirectHome("you can not browze this page directly",2,null);
    }
}
    ?>
              
<?php
$check = $con->prepare("SELECT * FROM card WHERE user = ?");
$check->execute(array($_SESSION['id']));
$countcheck = $check->rowCount();
echo "$countcheck";
if ($countcheck==0) {
    ?>
    <script>
                let purshase = document.querySelector('#btnp').addEventListener('click',() => {
                    event.preventDefault();
                    event.stopPropagation();
                    alert("you can not purshase a emty card");
                })
    </script>
    <?php
}else {
    return true;
    
}
?>
</body>
</html>
<?php ob_end_flush(); ?>
