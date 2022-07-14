<?php
ob_start();


include "login.php";
include "functions.php";

if (isset($_GET['productid'])) {   
    $productid=isset($_GET['productid'])&& is_numeric($_GET['productid'])?intval($_GET['productid']):0;   
   $stmt = $con->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute(array($productid));
    $count = $stmt->rowCount();
    $row = $stmt->fetch();   
  if ($count>0) {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" />
    <title><?php 
        if (isset($_GET['productid'])) {
            echo "details | " .  $row['productname'];
        }
    ?></title>
    <link rel="stylesheet" href="style/home_style.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/productdetails.css">
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
      .product-title {
    font-size: 2.7rem;
    text-transform: capitalize;
    font-weight: 600;
    position: relative;
    color: var(--form-label-color);
    margin: 1rem 0;
    letter-spacing: -1.5px;
    font-family: sans-serif;
}
h2{
  letter-spacing: -1.5px;
    font-family: sans-serif;
}
      a{
        text-decoration: none;
      }
      .purchase-info input[type="submit"] {
    background-color: #006eeb !important;
    width: auto;
    color: white;
    font-size: 14px;
    font-weight: bold;
}
      @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap');

*{
    box-sizing: border-box;
    padding: 0;
    margin: 0;
}
a i{
    font-size: 25px;
}
body{
    line-height: 1.5;
}
.fa-star,.fa-star-half-alt{
    font-size: 20px;
    color: yellow;
}
p{
    color: var(--black);
}

.card-wrapper{
    max-width: 1100px;
    margin: 0 auto;
}
.box {
    margin: auto;
    border: 2px solid var(--black);
    width: 100%;
    margin: 25px;
}
@media (min-width:1000px) {
    .box {
    width: 80%;
    margin: auto;
    border: 2px solid var(--black);
}
}
.box1 {
    margin-top: 30px;
    background: var(--main-color);
    height: auto;
    display: flex;
    border-radius: 8px;
    margin-left: 14px;
    width: 80%;
    max-width: 463px;
    margin: auto;
    padding: 0;
    margin: 30px;
    display: flex;
    align-items: start;
    justify-content: start;
}
.priceName h2{
    padding: 4px;
    color: var(--black);
    text-align: center;
}
body > div.card-wrapper > div > div.product-content > div.product-detail > ul > li{
    color: var(--form-label-color);
}
.card-wrapper ul li {
    margin: 0;
    list-style: none;
    background: url(shoes_images/checked.png) left center no-repeat;
    background-size: 18px;
    padding-left: 1.7rem;
    margin: 0.4rem 0;
    font-weight: 600;
    opacity: 0.9;
    color: var(--form-label-color);
}
.box img{
    width: 100%;
    height: auto;
    display: block;
    border-bottom: 2px solid var(--black);
}
.img-display{
    overflow: hidden;
}
.img-showcase{
    display: flex;
    width: 100%;
    transition: all 0.5s ease;
}
.img-select{
    display: flex;
}
.img-item{
    margin: 0.3rem;
}
.img-item:nth-child(1),
.img-item:nth-child(2),
.img-item:nth-child(3){
    margin-right: 0;
}
.img-item:hover{
    opacity: 0.8;
}
.product-content{
    padding: 2rem 1rem;
}
.product-content{
    padding: 2rem 1rem;
    width: 50%;
    text-align: center;
}
.card1{
    display: flex;
    flex-wrap: nowrap;
}
.product-title{
    font-size: 3rem;
    text-transform: capitalize;
    font-weight: 700;
    position: relative;
    color: var(--form-label-color);
    margin: 1rem 0;
}
.product-title::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    height: 4px;
    width: 80px;
    background: var(--form-label-color);
}
.product-link{
    text-decoration: none;
    text-transform: uppercase;
    font-weight: 400;
    font-size: 0.9rem;
    display: inline-block;
    margin-bottom: 0.5rem;
    background: #256eff;
    color: #fff;
    padding: 0 0.3rem;
    transition: all 0.5s ease;
}
.product-link:hover{
    opacity: 0.9;
}
.product-rating{
    color: #ffc107;
}
.product-rating span{
    font-weight: 600;
    color: #252525;
}
.product-price{
    margin: 1rem 0;
    font-size: 1rem;
    font-weight: 700;
}
.product-price span{
    font-weight: 400;
}
.last-price span{
    color: #f64749;
    text-decoration: line-through;
}
.new-price span{
    color: #256eff;
}
.product-detail h2{
    text-transform: capitalize;
    color: var(--form-label-color);
    padding-bottom: 0.6rem;
}
.product-detail p{
    font-size: 0.9rem;
    padding: 0.3rem;
    opacity: 0.8;
}
.product-detail ul{
    margin: 1rem 0;
    font-size: 0.9rem;
}
.card{
    width: 100%;
}
.fa-shopping-cart{
    font-size: 35px;
}
.product-detail ul li{
    margin: 0;
    list-style: none;
    background: url(shoes_images/checked.png) left center no-repeat;
    background-size: 18px;
    padding-left: 1.7rem;
    margin: 0.4rem 0;
    font-weight: 600;
    opacity: 0.9;
    color: var(--blue);
}
.product-detail ul li span{
    font-weight: 400;
}
.purchase-info{
    margin: 1.5rem 0;
}
.purchase-info input,
.purchase-info .btn{
    border: 1.5px solid #ddd;
    border-radius: 25px;
    text-align: center;
    padding: 0.45rem 0.8rem;
    outline: 0;
    margin-right: 0.2rem;
    margin-bottom: 1rem;
}
.purchase-info input{
    width: 60px;
}
.purchase-info .btn{
    cursor: pointer;
    color: #fff;
}
.purchase-info .btn:first-of-type{
    background: #256eff;
}
.purchase-info .btn:last-of-type{
    background: #f64749;
}
.purchase-info .btn:hover{
    opacity: 0.9;
}
.social-links{
    display: flex;
    align-items: center;
    gap: 4px;
}.social-links a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    /* color: #000; */
    /* border: 1px solid #000; */
    margin: 0 0.2rem;
    border-radius: 50%;
    text-decoration: none;
    font-size: 0.8rem;
    transition: all 0.5s ease;
}
.social-links a:hover i{
    color: var(--form-label-color);
}

@media screen and (min-width: 992px){
    .card{
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 1.5rem;
    }
    .card-wrapper{
        height: auto !important;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .product-imgs{
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .product-content{
        padding-top: 0;
    }
    h2{
        color: var(--black);
    }

    @media (max-width:1000px) {
    
    .product-content{
        text-align: center !important;
    }
        .box1 {
            margin-top: 30px;
        background: var(--main-color);
        height: auto;
        display: flex;
        border-radius: 8px;
        margin-left: 14px;
        padding: 5px 0;
        width: 85%;
        margin: auto;
        padding: 20px 0;
    }
    }
}
.product-title::after {
    content: "";
    position: absolute;
    left: 0%;
    bottom: 0;
    height: 4px;
    width: 100%;
    background: var(--form-label-color);
}  
  @media (max-width:900px) {
      .product-content{
        width: 100% !important;
        text-align: center !important;
      }
      .box1{
        margin: auto;
      }
      .card1{
        flex-wrap: wrap !important;
      }
    }
    </style>
</head>
<body>
    <?php include "header.php";
    checkUserLogin();
    if (!isset($_SESSION['username'])) {
    redirectHome("you are not loged you will be redirected to home page",3,"homepage.php");
}else{
        if (isset($_GET['productid'])) {

            ?>
            <div class = "card-wrapper1">
            <div class = "card1">
              <!-- card left -->
      <div class="box1">
      <div class="box">
                          <img src="./uploads/image/<?php echo $row['image']; ?>" alt="img">
                          <div class="priceName">
                              <h2>
                              <?php echo $row['price'];?> 
                              </h2>
                          </div>
                        </div>
      </div>
              <!-- card right -->
              <div class = "product-content">
                <h2 class = "product-title"><?php echo $row['productname'];?> </h2>
                <a href = "#" class = "product-link">visit <?php echo $row['type'];?> store</a>
                <div class = "product-rating">
                  <i class = "fas fa-star"></i>
                  <span>4.7</span>
                </div>
      
                <div class = "product-price">
                  <p class = "new-price"> Price: <span><?php echo $row['price']; ?>$</span></p>
                </div>
      
                <div class = "product-detail">
                  <h2>about this item: </h2>
                  <p><?php echo $row['description']; ?></p>                  
                </div>
      
                <div class = "purchase-info">
                  <form action="card.php?productid=<?php echo $row['id'];?>&do=add" method="post">
                  <input type = "number" value="1" min = "1" name="quantity" required>
                    <input type="submit" value="Add to Cart" name="submit" class = "btn1">
                     <i class = "fas fa-shopping-cart"></i>
                  </input>
                  </form>
                </div>
      
              </div>
            </div>
          </div>
      
          
        
        <?php
        }else{
            redirectHome("you are not able to browze this page you will be redirected to home page",3,"homepage.php");
        }
        ?>

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
                    </script>
</body>
</html>
<?php 
}
include "footer.php";
    ob_end_flush();
?>


  }
  <?php
}else {
  redirectHome('there is no such id',2,'back');
}
}
?>