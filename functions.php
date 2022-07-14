<?php
include "login.php";
function redirectHome ($Msg, $seconds = 3,$url = null){
    if($url === null){
        $url='homepage.php';
        $link = "firstpage";
    }else{
        $url=isset($_SERVER['HTTP_REFERER'])&&$_SERVER['HTTP_REFERER'] !== ''
         ? $_SERVER['HTTP_REFERER']:'homepage.php';
        $link = "previous";
    }
        
    echo "<div class='alert alert-danger'>$Msg</div>";
    echo "<div class='alert alert-info'>You Will Be Redirected to $link page After $seconds Seconds.</div>";
    header("refresh:3;url=$url");
    exit();
}
function accec($msg = '',$seconds=2,$url=null)
{
    if($url === null){
        $url='homepage.php';
        $link = "firstpage";
    }else{
        $url=isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== ''
         ? $_SERVER['HTTP_REFERER']:'homepage.php';
        $link = "previous";
    }
    echo "<div class='alert alert-success' role='alert'>
                                         $msg</div>";
header("refresh:$seconds;url =$url");
}
//count number of items
function countItems ($item, $table,$cond){
    global $con;
    $stmt2 = $con->prepare("SELECT COUNT($item) FROM $table $cond"); 
    $stmt2->execute();
    return $stmt2->fetchColumn();
}
function getlatest($select, $table,$order, $limit=5,$cond = ''){
    global $con;
    $getStmt = $con->prepare("SELECT $select FROM $table $cond ORDER BY $order DESC LIMIT $limit ");
    $getStmt->execute();
    $rows = $getStmt->fetchAll(); 
    return $rows;
}
function checkUserLogin()//unset session where user is deleted
{
    global $con;
    $stmt = $con->prepare("SELECT * FROM login WHERE id = ?");
    $stmt->execute(array($_SESSION['id']));
    $row = $stmt->rowCount();
    if ($row>0) {
        return true;
    }else {
        session_unset();
        session_destroy();
        redirectHome('you are not a user',2,);
    }
}
?>