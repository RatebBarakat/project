<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
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
            $stmt = $con->prepare("SELECT * FROM contact");
            $stmt->execute();
            $messages = $stmt->fetchAll();
            ?>
            <div class="container">
                    <div class="table-responsive">
                        <table class="main-table table table-bordered">
                            <tr>
                                <td>sender</td>
                                <td>message</td>
                                <td>date</td>
                                <td>action</td>
                            </tr>
                            <?php
                            foreach ($messages as $message) {
                                $id_of_message = $message['id'];
                                echo "<tr>
                                <td>". $message['name']." </td>
                                <td>". $message['message']."</td>
                                <td>".
                                 $message['date'] ."
                                </td>
                                <td><a class='btn btn-danger' href='deletemessage.php?message=$id_of_message'>delete</a></td>
                            </tr>";
                            }
                            ?>
                            
            <?php
        }else {
            redirectHome('you must login as an admin',1,'back');
        }
        ob_end_flush();
    ?>

</body>
</html>