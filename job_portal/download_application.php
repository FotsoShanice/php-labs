<?php
require('fpdf/fpdf.php');
include 'config.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'jobseeker') {
    header("Location: login.php");
    exit;
}

$app_id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT a.*, j.title AS job_title FROM applications a JOIN jobs j ON a.job_id = j.id WHERE a.id = ? AND a.user_id = ?");
$stmt->execute([$app_id, $_SESSION['user_id']]);
$app = $stmt->fetch();

if (!$app) {
    echo "Application not found.";
    exit;
}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Job Application', 0, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->Ln(5);
$pdf->Cell(40, 10, 'Job Title: ' . $app['job_title'], 0, 1);
$pdf->Cell(40, 10, 'Full Name: ' . $app['full_name'], 0, 1);
$pdf->Cell(40, 10, 'Date Applied: ' . $app['date_applied'], 0, 1);
$pdf->Ln(5);
$pdf->MultiCell(0, 10, 'Skills: ' . $app['skills']);
$pdf->Ln(2);
$pdf->MultiCell(0, 10, 'Motivation: ' . $app['motivation']);

$pdf->Output('D', 'Application_' . $app['id'] . '.pdf');
exit;