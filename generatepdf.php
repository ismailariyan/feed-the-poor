<?php
require('./fpdf186/fpdf.php');
$connection = mysqli_connect("localhost", "root", "", "demo");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
else{
$query = "SELECT * FROM food_donations ORDER BY id DESC LIMIT 1";
// Create a new FPDF instance
$pdf = new FPDF();
$pdf->AddPage();

// Set font
$pdf->SetFont("Arial", "I", 8);

// Hardcoded values for invoice details
$customerName = "John Doe";
$invoiceNumber = "INV123";
$invoiceDate = "2024-05-14";
$totalAmount = "$500.00";

// Output invoice details
$pdf->Cell(0, 10, "Invoice Details", 0, 1, "C");
$pdf->Cell(50, 7, "Customer Name: " . $customerName, 0, 1);
$pdf->Cell(50, 7, "Invoice Number: " . $invoiceNumber, 0, 1);
$pdf->Cell(50, 7, "Invoice Date: " . $invoiceDate, 0, 1);
$pdf->Cell(50, 7, "Total Amount: " . $totalAmount, 0, 1);

// Output the PDF
$pdf->Output();

}
?>

