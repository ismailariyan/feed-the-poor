<?php
require('./fpdf186/fpdf.php');

// Start the session
session_start();

// Check if the user is logged in (assuming you store user info in the session)
if (!isset($_SESSION['email'])) {
    die("User not logged in");
}

$email = $_SESSION['email'];

// Connect to the database
$connection = mysqli_connect("localhost", "root", "", "demo");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    // Fetch the last donation details for the logged-in user based on email
    $query = "SELECT name, category, quantity, date, address FROM food_donations WHERE email = ? ORDER BY Fid DESC LIMIT 1";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . mysqli_error($connection);
        exit();
    }

    // Create a new FPDF instance
    class PDF extends FPDF {
        // Page header
        function Header() {
            // Select Arial bold 15
            $this->SetFont('Arial', 'B', 15);
            // Move to the right
            $this->Cell(80);
            // Framed title
            $this->Cell(30, 10, 'Invoice', 0, 0, 'C');
            // Line break
            $this->Ln(20);
        }

        // Page footer
        function Footer() {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial', 'I', 8);
            // Page number
            $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
        }
    }

    $pdf = new PDF();
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('Arial', '', 12);

    // Fetch details from the query result
    $customerName = $row['name'];
    $category = $row['category'];
    $quantity = $row['quantity'];
    $date = $row['date'];
    $address = $row['address'];

    // Output invoice details
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, "Invoice Details", 0, 1, "C");
    $pdf->Ln(10);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(50, 10, "Customer Name:", 1);
    $pdf->Cell(140, 10, $customerName, 1, 1);
    $pdf->Cell(50, 10, "Category:", 1);
    $pdf->Cell(140, 10, $category, 1, 1);
    $pdf->Cell(50, 10, "Quantity:", 1);
    $pdf->Cell(140, 10, $quantity, 1, 1);
    $pdf->Cell(50, 10, "Date:", 1);
    $pdf->Cell(140, 10, $date, 1, 1);
    $pdf->Cell(50, 10, "Address:", 1);
    $pdf->Cell(140, 10, $address, 1, 1);

    // Output the PDF
    $pdf->Output();

    // Close the database connection
    mysqli_close($connection);
}
?>
