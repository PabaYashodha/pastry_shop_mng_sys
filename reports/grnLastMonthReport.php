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
        $this->Cell(30, 10, 'GRN Last Week Report', 0, 1, 'C');
        $this->SetFont('Arial','', 10);
        //$this->Cell(193, 10, '(2022-03-05)', 0, 0, 'C');
        // Line break
        $this->Ln(20);
    }
//Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
    //          Page footer
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
        $this->Cell(50, 10, 'REFERENCE NO', 1, 0, 'C');
        $this->Cell(40, 10, 'DATE ', 1, 0, 'C');
        $this->Cell(40, 10, 'PAID AMT.(RS)', 1, 0, 'C');
        $this->Cell(53, 10, 'SUPPLIER ', 1, 1, 'C');
    }

    function TableBody()
    {
        $reportDb = new reportDb(); 
        $result = $reportDb->grnLastMonthReport();
        //var_dump( $result);
        $this->SetFont('Arial', '', 8);
        $count = 1;
        while ($row = $result->fetch_assoc()) {
            $this->Cell(6, 10, $count++, 1, 0, 'C');
            $this->Cell(50, 10, $row['grn_ref_id'], 1, 0, 'C');
            $this->Cell(40, 10, $row['grn_date'], 1, 0, 'C');
            $this->Cell(40, 10, $row['grn_price'], 1, 0, 'C');
            $this->Cell(53, 10, $row['supplier_name'], 1, 1, 'C');
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
