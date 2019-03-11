<?php
require 'fpdf.php';

class PDF extends FPDF
{

    public function Header()
    {
        $this->SetFont('Arial', 'B', 15);
        //$this->Cell(80);
        $this->Cell(0, 10, 'Facture AcheteTaBaguette', 1, 0, 'C');
        $this->Ln(20);
    }

    public function chargerData($file)
    {
        // Lecture des lignes du fichier
        $lines = file($file);
        $data = array();
        foreach ($lines as $line) {
            $data[] = explode(';', trim($line));
        }

        return $data;
    }

    public function isColored($i)
    {
        if ($i % 2 == 0) {
            $this->SetFillColor(224, 226, 229);
        } else {
            $this->SetFillColor(255, 255, 255);
        }
    }

// Tableau amélioré
    public function genererTableau($header, $data)
    {
        $prixTotal = 0;

        // Largeurs des colonnes
        $w = array(40, 35, 45, 40);
        // En-tête
        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        }

        $this->Ln();
        // Données
        $i = 0;
        foreach ($data as $row) {
            $this->isColored($i);
            $i++;

            $this->Cell($w[0], 6, utf8_decode($row[0]), 'LR', 0, 'R', true);
            $this->Cell($w[1], 6, $row[1] . " " . chr(128), 'LR', 0, 'R', true);
            $this->Cell($w[2], 6, number_format($row[2], 0, ',', ' '), 'LR', 0, 'R', true);
            $this->Cell($w[3], 6, $row[1] * $row[2] . " " . chr(128), 'LR', 0, 'R', true);
            $prixTotal += $row[1] * $row[2];
            $this->Ln();
        }

        $this->Cell($w[0], 6, "", "LRB", 0, 'R');
        $this->Cell($w[1], 6, "", "LRB", 'R');
        $this->Cell($w[2], 6, "", 'LR', 0, 'R');
        $this->Cell($w[3], 6, "", 'LR', 0, 'R');
        $this->Ln();

        $this->isColored($i);
        $i++;
        $this->Cell($w[0], 6, "", '', 0, 'R');
        $this->Cell($w[1], 6, "", '', 0, 'R');
        $this->Cell($w[2], 6, "Prix total HT", 1, 0, 'R', true);
        $this->Cell($w[3], 6, $prixTotal . " " . chr(128), 1, 0, 'R', true);
        $this->Ln();

        $this->isColored($i);
        $i++;
        $this->Cell($w[0], 6, "", '', 0, 'R');
        $this->Cell($w[1], 6, "", '', 0, 'R');
        $this->Cell($w[2], 6, "Taxes (20%)", 1, 0, 'R', true);
        $this->Cell($w[3], 6, $prixTotal * 0.2 . " " . chr(128), 1, 0, 'R', true);
        $this->Ln();

        $this->isColored($i);
        $i++;
        $this->Cell($w[0], 6, "", '', 0, 'R');
        $this->Cell($w[1], 6, "", '', 0, 'R');
        $this->Cell($w[2], 6, "Prix total", 1, 0, 'R', true);
        $this->Cell($w[3], 6, $prixTotal * 1.2 . " " . chr(128), 1, 0, 'R', true);
        $this->Ln();

        // Trait de terminaison
        $this->Cell(array_sum($w), 0, '', '');
    }

}

$pdf = new PDF();
// Titres des colonnes
$header = array('Item', 'Prix Unitaire', utf8_decode(Quantité), 'Prix Total');
// Chargement des données
$data = $pdf->chargerData('data.txt');
$pdf->SetFont('Arial', '', 14);
$pdf->AddPage();
$pdf->genererTableau($header, $data);
$pdf->Output('I', "Facture", true);
