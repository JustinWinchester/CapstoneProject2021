<?php

include '../../classes/Users.php';
include '../../config/database.php';
//Session::CheckSession();
// Include the main TCPDF library (search for installation path).
require_once('../../TCPDF-main/TCPDF-main/tcpdf.php');
$filepath = realpath(dirname(__FILE__));
include_once $filepath."/../../lib/Session.php";
Session::init();



spl_autoload_register(function($classes){

  include '../../classes/'.$classes.".php";

});


$users = new Users();

$logMsg = Session::get('logMsg');
if (isset($logMsg)) {
  echo $logMsg;
}
$msg = Session::get('msg');
if (isset($msg)) {
  echo $msg;
}
Session::set("msg", NULL);
Session::set("logMsg", NULL);
?>
<?php
if(isset($_GET['pdf_schedule_generator'])){
$usersID = $_GET['ID'];

}

if (isset($_GET['id'])) {
  $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);



/**
 *
 */
class PDF extends TCPDF
{
  public function Header(){
    $imagefile = K_PATH_IMAGES.'cameronlogo.png';
    $this->Image($imagefile, 20, 10, 20, '', 'PNG', '', 'T', false, 300, '', false, false,
     0, false, false ,false);
    $this->Ln(5); //fontname ,style, size
    $this->SetFont('helvetica','B','12');
        //189 is total width of A4 page,height,border ,line,
      $this->cell(189,3,'Cameron University',0,1,'C');
      $this->SetFont('helvetica','B','12');

      $this->cell(189,3,'2800 W Gore Blvd',0,1,'C');
      $this->cell(189,3,'Lawton, OK 73505',0,1,'C');
        $this->SetFont('helvetica','','10');
        $this->Ln(2); //space
$this->cell(189,5,'CU ENROLL SCHEDULE',1,1,'C');
  }
  public function Footer(){
    $this->SetY(-148);// position at 15 mm from bottom
    $this->Ln(5);
    $this->SetFont('times','B','10');
    //page number
    date_default_timezone_set("America/North_Dakota/Center");
    $today = date("F j, Y/ g:i A", time());
    $this->Cell(25,5,'Generation Date/Time:' .$today,0,0,'L');
    $this->Cell(164,5, 'Page'.$this->getAliasNumPage().'of'.$this->getAliasNbPages(),
    0,false,'R',0, '', 0, false, 'T', 'M');
  }
}

// create new PDF document
//portrait or landscrape
$pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Capstone Team1');
$pdf->SetTitle('CU Enroll Schedule');
$pdf->SetSubject('');
$pdf->SetKeywords('');
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));



// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);



// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

$pdf ->Ln(18);//height
$pdf ->SetFont('times','B',10);
$pdf->SetFillColor(224,235,255);
//$pdf->Cell(5,5,'SL',1,0,'C',1);
$pdf->Cell(15,5,'Semester',1,0,'C',1);
//$pdf->Cell(30,5,' Year',1,0,'C',1);
$pdf->Cell(20,5,'Start',1,0,'C',1);
$pdf->Cell(20,5,'End',1,0,'C',1);
$pdf->Cell(20,5,'Time',1,0,'C',1);
$pdf->Cell(40,5,'Location',1,0,'C',1);
$pdf->Cell(40,5,'Course',1,0,'C',1);
$pdf->Cell(5,5,' Crds',1,0,'C',1);
$pdf->Cell(10,5,'Abrv',1,0,'C',1);
$pdf->Cell(20,5,'Professor',1,0,'C',1);
$pdf->SetFont('times','',10);
//$pdf->Cell(189,3,'Schedule For:',$Professor,0,1,'C');




$select = "SELECT * FROM Schedules WHERE StudID = '$userid' ";
$query = mysqli_query($con,$select);


$i=1;//no of pages start
$max = 20; //when sl no == 6 go to next page

while ($ScheduleData=mysqli_fetch_array($query)) {
  // code... $Semester = $value-> SemSemester;
                              $Semester = $ScheduleData ['SemSemester'];
                          //  $Year = $ScheduleData ['SemYear'];
                            $Start = $ScheduleData [ 'SemStart'];
                            $End = $ScheduleData ['SemEnd'];
                            $Time = $ScheduleData ['TimeAbr'];
                            $Location = $ScheduleData ['RoomLocation'];
                            $Course = $ScheduleData[ 'CrsName'];
                            $Credits = $ScheduleData ['CrsCredits'];
                            $Abrv =  $ScheduleData ['CrsAbr'];
                            $Professor = $ScheduleData['FacLastName'];
                            if(($i%$max) == 0){
                              $pdf->AddPage();

                              $pdf ->Ln(18);//height
                              $pdf ->SetFont('times','B',8);
                              $pdf->SetFillColor(224,235,255);
                              //$pdf->Cell(5,5,'SL',1,0,'C',1);
                              $pdf->Cell(15,5,'Semester',1,0,'C',1);
                            //  $pdf->Cell(30,5,' Year',1,0,'C',1);
                              $pdf->Cell(20,5,'Start',1,0,'C',1);
                              $pdf->Cell(20,5,'End',1,0,'C',1);
                              $pdf->Cell(20,5,'Time',1,0,'C',1);

                              $pdf->Cell(40,5,'Location',1,0,'C',1);
                              $pdf->Cell(40,5,'Course',1,0,'C',1);
                              $pdf->Cell(5,5,' Crds',1,0,'C',1);
                              $pdf->Cell(10,5,'Abrv',1,0,'C',1);
                              $pdf->Cell(20,5,'Professor',1,0,'C',1);
                              $pdf->SetFont('times','',8);
                            //  $pdf->Cell(189,3,'Schedule For:',$Professor,0,1,'C');
}
        $pdf->Ln(5);
      //  $pdf->Cell(5,4,$i,0,0,'C');
        $pdf->Cell(15,4,$Semester,0,0,'C');
      //  $pdf->Cell(30,4,$Year,0,0,'C');
        $pdf->Cell(20,4,$Start,0,0,'C');
        $pdf->Cell(20,4,$End,0,0,'C');
        $pdf->Cell(20,4,$Time,0,0,'C');
        $pdf->Cell(40,4,$Location,0,0,'C');
        $pdf->Cell(40,4,$Course,0,0,'C');
        $pdf->Cell(5,4,$Credits,0,0,'C');
        $pdf->Cell(10,4,$Abrv,0,0,'C');
        $pdf->Cell(20,4,$Professor,0,0,'C');
        $i++;

}

}


// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');
