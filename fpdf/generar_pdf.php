<?php
require('fpdf.php'); // Asegúrate de que esta ruta sea correcta.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $servicio = $_POST['servicio'];
    $fecha = $_POST['fecha'];

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    $pdf->Cell(190, 10, 'Contrato de Solicitante de Servicio', 0, 1, 'C');
    $pdf->Ln(10);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Yo, ' . $nombre . ', solicito el siguiente servicio:', 0, 1);
    $pdf->Ln(5);

    $pdf->MultiCell(0, 10, $servicio, 0, 'L');
    $pdf->Ln(5);

    $pdf->Cell(0, 10, 'Fecha de Solicitud: ' . $fecha, 0, 1);
    $pdf->Ln(10);

    $pdf->Cell(0, 10, 'Firma del Solicitante:', 0, 1);

    $pdf->Output();
}
?>
