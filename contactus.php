<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/home_style.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/contact.css">
    <title>contact us</title>
</head>
<body>
    
<?php
require 'login.php';
session_start();
require 'functions.php';
    if (!isset($_SESSION['username'])) {
        redirectHome('you must login first');
    }else {
        ?>
        <section id="contact">
  <div class="contact-box">
    <div class="contact-links">
      <h2>Contact us</h2>
      <div class="links">
        <div class="link">
          <a><img src="https://i.postimg.cc/m2mg2Hjm/linkedin.png" alt="linkedin"></a>
        </div>
        <div class="link">
          <a><img src="https://i.postimg.cc/YCV2QBJg/github.png" alt="github"></a>
        </div>
        <div class="link">
          <a><img src="https://i.postimg.cc/W4Znvrry/codepen.png" alt="codepen"></a>
        </div>
        <div class="link">
          <a><img src="https://i.postimg.cc/NjLfyjPB/email.png" alt="email"></a>
        </div>
      </div>
    </div>
    <div class="contact-form-wrapper">
      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" autocomplete="off" method="POST">
      <div class="displaymessage">
        
      </div>
        <div class="form-item">
          <input type="text" name="name" required>
          <label>Name:</label>
        </div>
        <div class="form-item">
        </div>
        <div class="form-item">
          <textarea class="" name="message" required></textarea>
          <label>Message:</label>
        </div>
        <input type="submit" name="contact" class="submit-btn"/>
      </form>
    </div>
  </div>
</section>
        <?php
    }
    if (isset($_POST['contact'])) {
        
        $stmt = $con->prepare('INSERT INTO contact(message,sender,name) VALUES(?,?,?)');
        $stmt->execute(array($_POST['message'],$_SESSION['id'],$_SESSION['username']));
        ?>
        <script>
            document.querySelector('.displaymessage').innerHTML = "<p class='message'>the mesage is send </p>";
            setTimeout(() => {
                message.style.animation = 'message 0.3s'
            }, 1000);
            setTimeout(() => {
                message.remove();
            }, 1300);
        </script>
        <?php
        redirectHome('',1300);

    }

?><script>
const message = document.querySelector('.message');
message.onclick = () => {
    message.style.animation = 'message 0.5s'
    setTimeout(() => {
        message.remove();
    }, 500);
}
</script>
</body>
