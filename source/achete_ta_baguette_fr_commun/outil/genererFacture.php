<?php
require 'fpdf.php';

class PDF extends FPDF
{
    public $facture;

    // function __construct()
    // {
    //     //$this->facture= $facture;

    //     parent::construct();
    // }

    public function Header()
    {
        $this->SetFont('Arial', 'B', 15);
        //$this->Cell(80);
        $this->Cell(0, 10, 'Facture AcheteTaBaguette', 1, 0, 'C');
        $this->Ln(20);
    }

    public function LoadData($file)
    {
        // Lecture des lignes du fichier
        $lines = file($file);
        $data = array();
        foreach ($lines as $line) {
            $data[] = explode(';', trim($line));
        }

        return $data;
    }

// Tableau amélioré
    public function ImprovedTable($header, $data)
    {
        // Largeurs des colonnes
        $w = array(40, 35, 45, 40);
        // En-tête
        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        }

        $this->Ln();
        // Données
        foreach ($data as $row) {
            $this->Cell($w[0], 6, utf8_decode($row[0]), 'LR', 0, 'R');
            $this->Cell($w[1], 6, $row[1]." ".chr(128), 'LR', 0, 'R');
            $this->Cell($w[2], 6, number_format($row[2], 0, ',', ' '), 'LR', 0, 'R');
            $this->Cell($w[3], 6, $row[1]*$row[2]." ".chr(128), 'LR', 0, 'R');
            $this->Ln();
        }
        // Trait de terminaison
        $this->Cell(array_sum($w), 0, '', 'T');
    }

}

$pdf = new PDF();
// Titres des colonnes
$header = array('Item', 'Prix Unitaire', utf8_decode(Quantité), 'Prix Total');
// Chargement des données
$data = $pdf->LoadData('data.txt');
$pdf->SetFont('Arial', '', 14);
$pdf->AddPage();
$pdf->ImprovedTable($header, $data);
$pdf->Output('I', "Facture", true);
