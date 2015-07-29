<?

if ($_GET['pdf'] != true) : header( 'Location: /' ) ;
else :

  # Collect and Sanitize POST data
  # Set form fields as variable names (i.e. name='firstname' => $firstname)
  
  $fields = array();
  foreach($_POST as $key => $val) { 
      $fields[$key] = strip_tags($val);
      #print "<b>$key</b> : $val <br>";
  }
  extract($fields); 

  
  #
  # Build PDF
  #
  
  require('fpdf.php');
  $pdf= new FPDF();
  $pdf->SetTitle($title);
  $pdf->AddPage();
  
  #
  # Profile Name
  #
  
  $pdf->SetXY(31, 10);
  $pdf->SetFillColor(255, 255, 255);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('Arial','', 21);
  $pdf->Cell(200, 6, $name, 0, 1, 'L', true);
  
  $pdf->SetXY(31, 18);
  $pdf->SetFillColor(153, 0, 0);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(200, 2, '', 0, 1, 'L', true); //Draw Red line under name
  
  
  #
  # Profile Photo
  #
  
  $pdf->SetFont('Arial','B', 14);
  $pdf->Image('photoTrim.png', 31, 26, 4, 44,'','');
  $pdf->Image($photo, 36, 26, 35, 0,'','');
  
  #
  # Build Profile info
  # Heading column
  #
  
  $pdf->SetFillColor(255, 255, 255);
  $pdf->SetTextColor(0,0,0);
  
  # Info column
  #
  $pdf->SetFont('Arial','', 11);
  $pdf->SetXY(72, 26);
  $pdf->MultiCell(135, 5, $title ,0,1,'L',true);
  
  $pdf->SetXY(72, 41);
  $pdf->Cell(125, 5, $primary_affiliation ,0,1,'L',true);
    
  # Line break
  $pdf->Ln(7);
  
  #
  # Build Research Section
  #
  
  $pdf->SetFont('Arial','B', 16);
  $pdf->SetXY(30, 78);
  $pdf->MultiCell(165,5, 'Research' ,0,1,'L',true);
  $pdf->Ln(4);
  
  #
  # Build Profile information section
  #
  
  $pdf->SetX(30);
  $pdf->SetFont('Arial','', 11);
  $pdf->MultiCell(175, 5, $research ,0,1,'L',true);
  $pdf->Ln(7);
  
  $pdf->SetX(30);
  $pdf->SetFont('Arial','B', 16);
  $pdf->MultiCell(175, 5, 'Teaching' ,0,1,'L',true);
  $pdf->Ln(4);
  
  $pdf->SetX(30);
  $pdf->SetFont('Arial','', 11);
  $pdf->MultiCell(175, 5, $teaching ,0,1,'L',true);
  $pdf->Ln(7);
  
  $pdf->SetX(30);
  $pdf->SetFont('Arial','B', 16);
  $pdf->MultiCell(175, 5, 'Professional Activities' ,0,1,'L',true);
  $pdf->Ln(4);
  
  $pdf->SetX(30);
  $pdf->SetFont('Arial','', 11);
  $pdf->MultiCell(175, 5, $professional_activities ,0,1,'L',true);
  
  # Save pdf file
  $filename = str_replace (' ', '', $name); 
  $pdf->Output($filename.'_profile.pdf', 'D');

endif;

?>