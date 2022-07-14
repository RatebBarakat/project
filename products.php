<?php
ob_start();

    include "header.php";
    include "login.php";  
    include "functions.php";  
    if (!isset($_SESSION['username'])) {
        header('location:homepage.php');
    }
    checkUserLogin();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="style/home_style.css">
    <link rel="stylesheet" href="style/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" />
    <script src="home.js" defer></script>
    <link rel="shortcut icon" href="imgs/logo1.ico">
    <link rel="stylesheet" href="style/header.css">
    <style>
        img{
            background-color: white;
        }
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
}
#back{
    padding: 10px;
    background: var(--white);
    text-decoration: none;
    color: var(--form-label-color);
    border-radius: 9px;
    border: 2px solid;
    transition: .4s;
}
#back:hover{
    background-color: var(--form-label-color);
    color: var(--white);
    border: 2px solid var(--form-label-color);
}

.allproducts .container {
    padding: 20px !important;
    width: 90%;
    background-color: var(--container-color);
    margin: auto;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgb(0 0 0 / 40%);
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)) !important;
    column-gap: 10px !important;
    row-gap: 15px;
    justify-items: center;
    padding-top: 70px;
    z-index: auto !important;
}
.allproducts .container .box {
    background-color: var(--main-color) !important;
    box-shadow: none !important;
    max-width:300px !important;
}
.container .box .content {
    padding: 5px;
    text-align: center;
    border: none !important;    
    color: var(--color);
}
#s{
    padding: 6px 10px;
    color: var(--blue);
    background: #006eeb3d;
    border: 2px solid #006eeb;
    font-size: 20px;
    position: absolute;
    top: 157px;
    z-index: 14;
    right: 36px;
    transform: scale(0);
    transition: 0.4s;
    transform-origin: bottom;
    display: none;
}
#s.show{
    display: block;
}
.box .content h2 {
    color: var(--form-label-color);
    padding: 10px;
}
@media (max-width: 300px) {
    .allproducts .container{
        padding: 5px 0 !important;
    }
}
.logo img{
    background: none !important;
}
.ioan {
    grid-column-start: 1;
    grid-column-end: -1;
}
.ioan input{
    font-size: 1.1rem;
    font-weight: bold;
    padding: 9px 10px;
    background-color: #0dcaf0;
    color: black;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: color 0.4s,background-color 0.4s;
}
.allproducts .container .box{
    border: 2px solid transparent !important;
}
.allproducts .container .box:hover{
    box-shadow: 0 1px 13px var(--boxhovereffect)!important;
    border: 2px solid var(--boxhovereffect)!important;
}
.ioan input:not(:first-of-type){
    border-right: 1px solid #5d5d5d;
}
.ioan input:hover,.ioan input.active{
background-color: var(--input);
color: var(--form-label-color);
transition: color 0.4s,background-color 0.4s;
}
.allproducts .container .box {
    height: auto;
    border-radius: unset;
    display: flex;
    flex-direction: column;
    padding: 10px;
    transition: all 0.4s ease-in-out;
    min-height: 275px;
}

.allproducts .container .box:hover{
    transform: scale(1.05);
}
.box a{
    color: var(--black);
    transition: color 0.3s;
    font-weight: bold;
    text-decoration: none;
}
.box a:hover{
    color: var(--form-label-color);
}
.content p {
    font-size: 13px;
    padding-top: 7px;
    overflow: auto !important;
    height: auto;
    max-height: 70px;
}
.price {
    display: flex;
    width: 95%;
    justify-content: space-between;
    margin: 12px auto;
}
.container .box .content{
    padding: 5px;
    text-align: center;
    border-left: 1px solid var(--border);
    color: var(--color);
}
.box .content h2{
    color: var(--form-label-color);
}
@media (max-width:800px) {
header .fa-bars {
    display: block !important;
    right: 12px !important;
}
header .fa-bars {
    position: absolute;
    right: 50px;
    color: var(--black);
    display: none;
    font-size: 2rem;
}
}
@media (max-width: 400px) {
    .allproducts .container{
        width: 100% !important;
    }
}
.box{
    width: 95% !important;
}
.box .content{
    width: 100% !important;
}
.box img{
    width: 100% !important;
    height: auto;
    max-height: 173px;
    object-fit: contain;
}
.content p {
    font-size: 13px;
    padding-top: 7px;
    overflow: auto !important;
    height: 37px;
}

    </style>
</head>
<body class="active">
    <div class="backtoup">
        up
    </div>   
    
    <div class="search">
        <i class="fa-solid fa-magnifying-glass" id="findbtn"></i>
       <form id="formsearch" style="display: block;" action="products.php" method="post">
       <input type="search" placeholder="search here..." name="input" id="find" class="find">
       <input type="submit" value="search" id="s">
       </form>
       <script>
            const setoggle = document.querySelector('#findbtn');
            const submitsearch = document.querySelector('#s');
            const searchdata = document.querySelector('#find');
            setoggle.onclick = () =>{
                searchdata.focus();
                searchdata.classList.toggle('show');
                submitsearch.classList.toggle('show');
            }
            window.onclick = (e) =>{
                if (e.target!=searchdata) {
                    searchdata.classList.remove('show');
                    submitsearch.classList.remove('show');
                }
            }

            //fetch 

        </script>         
    <?php  
        if (isset($_POST['input'])) {
        $input = $_POST['input'];
        $stmt = $con->prepare("SELECT * FROM products WHERE productname LIKE '%$input%'");
        $stmt->execute(array());
        $count = $stmt->rowCount();
        $products = $stmt->fetchAll();
        echo "<a id='back' class='btn btn-info' href='products.php'>All product</a>";
        }else{
            $stmt = $con->prepare("SELECT * FROM products");
            $stmt->execute(array());
            $count = $stmt->rowCount();
            $products = $stmt->fetchAll();
        }
         
            
         ?>
    <div class="allproducts">
        <div class="container" style="z-index: auto;">    
        <div class="ioan">
                <input type="button" class="active" value="all" data-type="all">
                <?php 
                $types = (array) null;
                    foreach ($products as $producttype) {
                        if (!in_array($producttype['type'],$types)) {
                            array_push($types,$producttype['type']);
                            echo "<input type='button' value='". $producttype['type'] ."' 
                            data-type='".$producttype['type']."'>";
                        }
                    }
                ?>
        </div>


        <?php
         
    foreach ($products as $product) {
    
if($count>0){
    if ($product['visibility']==0) {
    ?>

    <div class="box <?php echo $product['type']; ?> all">
        <img src="./uploads/image/<?php echo $product['image']; ?>" alt="img1">
        <div class="content">
            <h2><?php echo $product['productname'] ?></h2>
            <div class="price">
                <a href="productdetails.php?productid=<?php echo $product['id']; ?>">more details</a>
                <h3><?php echo $product['price'] ?> $</h3>
            </div>
        </div>
    </div>

    <?php   
} 
}else{
    ?>
    <h1>there no such product</h1>

    <?php
}

    
    }
        ?>
            
        </div>
    </div>
    <?php
    include "footer.php";
    ob_end_flush();
    ?>
</body>
</html>