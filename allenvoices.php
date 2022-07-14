<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>all envoices</title>
    <link rel="stylesheet" href="style/home_style.css">
    <link rel="stylesheet" href="style/header.css">
    <script src="dark.js" defer></script>
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
        td{
            color: var(--black) !important;
        }
        table{
            width: 90% !important;
            margin: auto;
        }
        table tr:first-of-type{
            background-color: var(--nav-color);
        }
    </style>
</head>
<body>
    <?php
    include 'functions.php';
    include 'header.php';
    include 'login.php';
    if (!isset($_SESSION['admin'])) {
        redirectHome('you can browze this page',2,'back');
    }else {#admin exict
        $do = '';
        if (isset($_GET['do'])) {
            $do = $_GET['do'];
            if ($do == "manage") {
                $stmt = $con->prepare("SELECT * FROM envoices");
                $stmt->execute();
                $envoices = $stmt->fetchAll();
                ?>
                                <div class="table-responsive">
                                    <table class="main-table table table-bordered">
                                        <tr>
                                            <td>name</td>
                                            <td>date</td>
                                            <td>file</td>
                                            <td>control</td>
                                        </tr>
                                        <?php foreach ($envoices as $envoice) {
                                            ?>
                                            <tr>
                                                
                                                <td><?php echo $envoice['name']; ?></td>
                                                <td><?php echo $envoice['date']; ?></td>
                                                <td><?php echo $envoice['file']; ?></td>
                                               
                                                <td><a  href="allenvoices.php?do=delete&envoiceid=<?php echo $envoice['id']; ?>" 
                                                class="btn btn-danger">
                                                    delete
                                                </a>
                                            <a href="showenvoice.php?envoiceid=<?php echo $envoice['id'] ?>" class="btn btn-success">show</a></td>
                                            </tr>
                                            <?php
                                        } ?>
                                    </table>
                                </div>
                <?php
            } elseif($do=='delete' && isset($_GET['envoiceid'])) {
                $envoiceid = is_numeric($_GET['envoiceid'])? $_GET['envoiceid'] : 0;
                $eid = $con->prepare("SELECT * FROM envoices WHERE id = ?");
                $eid->execute(array($envoiceid));
                $envoicedata  =$eid->fetch();
                $deleteitem = $envoicedata['file'];
                $delete = $con->prepare("DELETE FROM envoices WHERE id = ?");
                $delete->execute(array($envoiceid));
                if (unlink("C:\\xampp\\htdocs\\rateb barakat\\uploads\\envoices\\$deleteitem")) {
            redirectHome('envoice is succesfully deleted',1,'back');
            } else {
            redirectHome('there no such envoice',1,'back');
            }
            
            }else{
                $do = "manage";
            } 
        }else {
            redirectHome('you can not browze this page directly',1,'back');
        }
    }
    ob_end_flush();
    ?>
</body>
</html>