<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>envoice</title>
    <link rel="stylesheet" href="style/home_style.css">
    <link rel="stylesheet" href="style/header.css">
    <script src="dark.js" defer></script>
</head>
<body>
    <?php
    include "header.php";
    include "functions.php";
    include "login.php";

    if (!isset($_SESSION['admin'])) {
        redirectHome("you are not a admin",1,'back');
    }else {
        if (isset($_GET['envoiceid'])) {
            $id = (is_numeric($_GET['envoiceid'])) ? $_GET['envoiceid'] : 0 ;
            $stmt = $con->prepare("SELECT * FROM envoices WHERE id = ?");
            $stmt->execute(array($id));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();
            if ($count>0) {
            $file = $row['file'];
            
            $filename = "C:\\xampp\\htdocs\\rateb barakat\\uploads\\envoices\\$file";
            // Header content type
            header("Pragma: public");
header("Expires: 0");
header("Content-type: $content_type");
header('Cache-Control: private', FALSE);
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header("Content-Disposition: inline; filename=\"$filename\"");
header('Content-Transfer-Encoding: binary');
header('Content-Length' . filesize($path));
ob_clean();
flush();

              
            // Send the file to the browser.
            readfile($filename);
            }else {
                redirectHome("there is no such envoices",1,'back');
            }

            }else {
                redirectHome("you can not browze this page directly",1,'back');
            }
        }
    ?>
</body>
</html>