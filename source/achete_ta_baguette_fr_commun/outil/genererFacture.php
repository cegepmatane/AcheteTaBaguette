<?php
require 'fpdf.php';

class PDF extends FPDF
{

    public function __constructor()
    {
        parent::__construct();
    }

    public function Header()
    {
        $this->SetFont('Arial', 'B', 15);
        //$this->Cell(80);
        $this->Cell(0, 10, 'Facture AcheteTaBaguette', 1, 0, 'C');
        $this->Ln(20);
    }

    public function chargerDataDepuisFichier($file)
    {
        // Lecture des lignes du fichier
        $lignes = file($file);
        $data = array();
        foreach ($lignes as $ligne) {
            $data[] = explode(';', trim($ligne));
        }

        return $data;
    }

    public function chargerDataDepuisArray($lignes)
    {

        $lignes = explode("\n\r", $lignes);
        $data = array();
        foreach ($lignes as $ligne) {
            $data[] = explode(';', trim($ligne));
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
    public function genererTableau($header, $items, $prixUnitaire, $quantite)
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
        for ($i = 0; $i < count($items); $i++) {
            $this->isColored($i);

            $this->Cell($w[0], 6, utf8_decode($items[$i]), 'LR', 0, 'R', true);
            $this->Cell($w[1], 6, $prixUnitaire[$i] . " $", 'LR', 0, 'R', true);
            $this->Cell($w[2], 6, $quantite[$i], 0, ',', 'R', 'LR', 0, 'R', true);
            $this->Cell($w[3], 6, floatval($prixUnitaire[$i]) * floatval($quantite[$i]) . " $", 'LR', 0, 'R', true);
            $prixTotal += floatval($prixUnitaire[$i]) * floatval($quantite[$i]);
            $this->Ln();
        }
        $this->isColored($i);
        $i++;

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
        $this->Cell($w[3], 6, $prixTotal . " $", 1, 0, 'R', true);
        $this->Ln();

        $this->isColored($i);
        $i++;
        $this->Cell($w[0], 6, "", '', 0, 'R');
        $this->Cell($w[1], 6, "", '', 0, 'R');
        $this->Cell($w[2], 6, "Taxes (20%)", 1, 0, 'R', true);
        $this->Cell($w[3], 6, $prixTotal * 0.2 . " $", 1, 0, 'R', true);
        $this->Ln();

        $this->isColored($i);
        $i++;
        $this->Cell($w[0], 6, "", '', 0, 'R');
        $this->Cell($w[1], 6, "", '', 0, 'R');
        $this->Cell($w[2], 6, "Prix total", 1, 0, 'R', true);
        $this->Cell($w[3], 6, $prixTotal * 1.2 . " $", 1, 0, 'R', true);
        $this->Ln();

        // Trait de terminaison
        $this->Cell(array_sum($w), 0, '', '');
    }

    public static function genererFacture($items, $prixUnitaire, $quantite)
    {
        $pdf = new PDF();
        // Titres des colonnes
        $header = array('Item', 'Prix Unitaire', utf8_decode(Quantité), 'Prix Total');
        // Chargement des données
        //$pdf->chargerDataDepuisArray($data);
        $pdf->SetFont('Arial', '', 14);
        $pdf->AddPage();
        $pdf->genererTableau($header, $items, $prixUnitaire, $quantite);
        $pdf->Output('I', "Facture.pdf", true);
    }
}
