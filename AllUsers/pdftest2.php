<?Php

require('../fpdf182/fpdf.php');
// Database Connection 
$conn = new mysqli('localhost', 'cs12', 'CUaDGKK8', 'cs12');
//Check for connection error
if($conn->connect_error){
  die("Error in DB connection: ".$conn->connect_errno." : ".$conn->connect_error);    
}
// Select data from MySQL database
$select = "SELECT * FROM CourseCataglog ORDER BY id";
$result = $conn->query($select);
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
while($row = $result->fetch_object()){
  $id = $row->Sectid;
  $name = $row->CrsName;
  $lastname = $row->FacLastName;
  $semester = $row->SemSemester;
  $pdf->Cell(20,10,$id,1);
  $pdf->Cell(40,10,$name,1);
  $pdf->Cell(80,10,$lastname,1);
  $pdf->Cell(40,10,$semester,1);
  $pdf->Ln();
}
$pdf->Output();
?>