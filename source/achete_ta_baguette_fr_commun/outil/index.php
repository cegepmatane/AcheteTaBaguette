<?php
require 'genererFacture.php';

$test = "
Baguette simple;2.00; 4;6\n\rCroissant;1;2;2\n\rPain au chocolat;1.50;2;3";

$pdf = new PDF();
$pdf->genererFacture($test);
// print_r('test');
// //header('genererFacture.php');
// $pdf = new PDF();
// $pdf = new PDF();
// // Titres des colonnes
// $header = array('Item', 'Prix Unitaire', utf8_decode(Quantité), 'Prix Total');
// // Chargement des données
// $data = $pdf->chargerData('data.txt');
// $pdf->SetFont('Arial', '', 14);
// $pdf->AddPage();
// $pdf->genererTableau($header, $data);
// //$pdf->Output('I', "Facture", true);
// $pdf->Output();
