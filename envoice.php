<?php
require('./fpdf.php');
session_start();
include "functions.php";
include "login.php";
checkUserLogin();
class envoice extends FPDF
{
    
    function header1()
    {
        $name = $_SESSION['username'];
        $this->Image("imgs/logo1.PNG",0,0,20,25);
        $this->SetFont( 'Arial', 'B' ,14);

          $this->Cell(276,5,"invoice of $name",0,0,'C');
          $this->Cell(276,10,"rateb phope",0,0,'C');
          $this->Ln(20);
    }
    function footer(){  
        $this->setY("-15");
        $this->SetFont('Arial', '' ,8);
        $this->Cell(0,10,"Page". $this->PageNo()."/{nb}",0,0,'C');
    }
    function table()
    {
        $this->SetLeftMargin(28);
        $this->SetFillColor( 0,40,200);
        $this->SetFont('Arial', 'B' ,12);
        $this->Cell(60,10,'Name',1,0,"C");
        $this->Cell(60,10,'price',1,0,'C');
        $this->Cell(60,10,'quantity',1,0,"C");
        $this->Cell(60,10,'Total',1,0,"C");
        $this->Ln();
    }
    function tablecard()
    {
        include "login.php";
        $stmt = $con->prepare("SELECT * FROM card WHERE user = ?");
                // Execute The Statement
                $stmt->execute(array($_SESSION['id']));
                // Assign To Variable
                $rows = $stmt->fetchAll();
                $finalprice = 0;
                foreach ($rows as $row) {
                    $finalprice+=$row['price']*$row['quantity'];
                    $totalpice = $row['quantity'] * $row['price'];
                    $this->SetFont('Arial', '' ,10);
                    $this->Cell(60,10,$row['name'],1,0,"C");
                    $this->Cell(60,10,$row['price'],1,0,'C');
                    $this->Cell(60,10,$row['quantity'],1,0,"C");
                    $this->Cell(60,10,$totalpice,1,0,"C");
                    $this->Ln();
                }
                $this->Cell(180,10,'final Price',1,0,"C");
                $this->Cell(60,10,$finalprice,1,0,"C");
                $this->Ln(20);
                $this->SetFont('Arial', '' ,13);
                $this->Cell(240,10,"your final price is $finalprice, the payment will be happen when you recive the product thank you for pay from our website",0,0,"C");
    }
}
$pdf = new envoice();
$pdf->AliasNbPages();
$pdf->SetTitle($_SESSION['username']." envoice");
$pdf->AddPage('L','A4',0);
$pdf->header1();
$pdf->table();
$pdf->tablecard();
$pdf->Output();
$filename = rand(0,100000).$_SESSION['username'].".pdf";

$path = "C:\\xampp\\htdocs\\rateb barakat\\uploads\\envoices\\".$filename;
$pdf->Output($path,'F');
$stmt = $con->prepare("INSERT INTO envoices(name,file) VALUES(?,?)");
$stmt->execute(array($_SESSION['username'],$filename));
$stmtdelete = $con->prepare("DELETE FROM card WHERE user = ?");
$stmtdelete->execute(array($_SESSION['id']));
?>