
<!DOCTYPE html>
<?php 
ob_start();  
    include 'login.php';
    include 'header.php';
    include 'functions.php';
    if (isset($_SESSION['username'])) {
        header('Location: products.php');
        exit;
    } 
    ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        home
    </title>
    <link rel="shortcut icon" href="imgs/logo1.ico">
    <link rel="stylesheet" href="style/home_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" />
    <script src="home.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="style/header.css">
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
         .container .box{
            width: 90% !important;
            height: auto !important;
            max-width: 300px;
        }
         .container .box img{
            height: auto !important;
        }
        body{
            overflow-x: hidden;
        }
        .btn-danger:hover{
            background: red !important;
    box-shadow: 0 0 20px 7px rgb(255 0 0 / 40%);
        }
        @media (max-width:600px) {
            .products .container {
    color: var(--black);
    border: 1px solid rgb(46, 46, 46);
    box-shadow: rgb(0 0 0 / 60%) 0px 0px 10px 0px;
    border-radius: 10px;
    margin: 10px auto;
    width: max-content;
    padding: 61px 10px !important;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    row-gap: 30px;
    justify-items: center;
    padding: 60px 0px;
    background-color: var(--white);
}
        }
    </style>
    <body>

    <div class="backtoup">
        up
    </div>
    <div class="swiper mySwiper" style="margin-top: 30px;">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="imgs/s22_uiltra.jpg" alt=""></div>
            <div class="swiper-slide"><img src="imgs/note_10_pro1_8.jpg" alt=""></div>
            <div class="swiper-slide"><img src="imgs/apple-iphone-11-pro-gfe8bafd49_640.jpg" alt=""></div>
            <div class="swiper-slide"><img src="imgs/ipjone_6_plus.jpg" alt=""></div>
            <div class="swiper-slide"><img src="imgs/Poco.jpg" alt=""></div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
    <svg style="margin-top: 0px;" class="afterslider" style="z-index: -1;transform: rotate(0deg);"
        viewBox="0 0 1440 200" version="1.1" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <linearGradient id="sw-gradient-1" x1="0" x2="0" y1="1" y2="0">
                <stop stop-color="var(--main-color)" offset="0%"></stop>
                <stop stop-color="var(--main-color)" offset="100%"></stop>
            </linearGradient>
        </defs>
        <path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)"
            d="M0,20L80,23.3C160,27,320,33,480,46.7C640,60,800,80,960,86.7C1120,93,1280,87,1440,90C1600,93,1760,107,1920,110C2080,113,2240,107,2400,96.7C2560,87,2720,73,2880,66.7C3040,60,3200,60,3360,76.7C3520,93,3680,127,3840,140C4000,153,4160,147,4320,150C4480,153,4640,167,4800,163.3C4960,160,5120,140,5280,123.3C5440,107,5600,93,5760,86.7C5920,80,6080,80,6240,93.3C6400,107,6560,133,6720,120C6880,107,7040,53,7200,56.7C7360,60,7520,120,7680,140C7840,160,8000,140,8160,130C8320,120,8480,120,8640,100C8800,80,8960,40,9120,20C9280,0,9440,0,9600,23.3C9760,47,9920,93,10080,100C10240,107,10400,73,10560,76.7C10720,80,10880,120,11040,133.3C11200,147,11360,133,11440,126.7L11520,120L11520,200L11440,200C11360,200,11200,200,11040,200C10880,200,10720,200,10560,200C10400,200,10240,200,10080,200C9920,200,9760,200,9600,200C9440,200,9280,200,9120,200C8960,200,8800,200,8640,200C8480,200,8320,200,8160,200C8000,200,7840,200,7680,200C7520,200,7360,200,7200,200C7040,200,6880,200,6720,200C6560,200,6400,200,6240,200C6080,200,5920,200,5760,200C5600,200,5440,200,5280,200C5120,200,4960,200,4800,200C4640,200,4480,200,4320,200C4160,200,4000,200,3840,200C3680,200,3520,200,3360,200C3200,200,3040,200,2880,200C2720,200,2560,200,2400,200C2240,200,2080,200,1920,200C1760,200,1600,200,1440,200C1280,200,1120,200,960,200C800,200,640,200,480,200C320,200,160,200,80,200L0,200Z">
        </path>
    </svg>

    <!-- productssection -->
    <section class="products" id="products">
        <div class="tittle">
            <h1>products</h1>
        </div>
        <div class="container">
            <?php
            $lastest = getlatest('*',"products",'productname',4);
            foreach($lastest as $row) : ?>
            <div class="box ios all" id="p1">
                <div class="img"><img src="uploads/image/<?php echo $row['image']; ?>" alt="a"></div>
                <div class="content">
                    <h2><?php echo $row['productname']; ?></h2>
                </div>
                <div class="price_moredetails">
                    <a href="register.php">more details</a>
                    <h2><?php echo $row['price']; ?></h2>
                </div>
                <div class="addtocard">
                    add to card
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <!-- about us -->
    </div>
    <section class="ContactUs" id="ContactUs">
        <div class="contacttittle">
            <h1>contact us</h1>
        </div>
        <div class="container">
            <form>
                <ul>
                    <li>
                        <label for="name"><span>Name <span class="required-star">*</span></span></label>
                        <input type="text" id="name1" name="user_name">
                    </li>
                    <li>
                        <label for="mail"><span>Email <span class="required-star">*</span></span></label>
                        <input type="email" id="mail" name="user_email">
                    </li>
                    <li>
                        <label> <span>Message</span></label>
                        <textarea rows="4" cols="50"></textarea>
                    </li>
                    <li>
                        <input type="submit">
                    </li>
                </ul>
            </form>
        </div>
    </section>
    <section class="map">
        <div class="tittle">
            <h1>location</h1>
        </div>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d822.3091863363591!2d36.17423517081921!3d34.47151799878087!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x951c7634fdb18525!2zMzTCsDI4JzE3LjUiTiAzNsKwMTAnMjUuMyJF!5e0!3m2!1sar!2slb!4v1648381244982!5m2!1sar!2slb"
            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
<script>
            const searchvalue = document.querySelector(".fa-magnifying-glass").addEventListener('click',() => {
                document.querySelector('.find').focus();
            })
        </script>
        <?php include "footer.php"; 
            ob_end_flush();
        ?>
</body>

</html>