<?php
include_once '../resources/FPDF/fpdf.php';
include_once 'reportDb.php';

class PDF extends FPDF
{
    function Header()
    {
        // Logo
        $this->Image('../images/logo.png', 10, 6, 20);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30, 10, 'Supplier Detail Report', 0, 1, 'C');
        $this->SetFont('Arial','', 10);
        //$this->Cell(193, 10, '(2022-03-05)', 0, 0, 'C');
        // Line break
        $this->Ln(20);
    }
// Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
//MultiCell(float w, float h, string txt [, mixed border [, string align [, boolean fill]]])
    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-28);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(93, 0, '           ----------------------------------', 0, 0, 'L');
        $this->Cell(93, 0, '----------------------------------', 0, 1, 'R');
        $this->Cell(93, 10, '                         Name', 0, 0, 'L');
        $this->Cell(93, 10, '    Signature             ', 0, 1, 'R');
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function TableHeader()
    {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(6, 10, '#', 1, 0, 'C');
        $this->Cell(30, 10, 'NAME ', 1, 0, 'C');
        $this->Cell(70, 10, 'ADDRESS ', 1,0, 'C');
        $this->Cell(40, 10, 'CONTACT ', 1, 0, 'C');
        $this->Cell(40, 10, 'Email ', 1, 1, 'C');
    }

    function TableBody()
    {
        $reportDb = new reportDb(); 
        $result = $reportDb->getSupplierDetails();
        //var_dump( $result);
        $this->SetFont('Arial', '', 8);
        $count = 1;
        while ($row = $result->fetch_assoc()) {
            $this->Cell(6, 10, $count++, 1, 0, 'C');
            $this->Cell(30, 10, $row['supplier_name'], 1, 0, 'C');
            $this->Cell(70, 10, $row['supplier_add1'].','. $row['supplier_add2'].','. $row['supplier_add3'], 1, 'C');
            $this->Cell(40, 10, $row['supplier_contact'], 1, 0, 'C');
            $this->Cell(40, 10, $row['supplier_email'], 1, 1, 'C');
            
        }  
   }
}

//Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->TableHeader();
$pdf->TableBody();
$pdf->SetFont('Times', '', 12);
$pdf->Output();
