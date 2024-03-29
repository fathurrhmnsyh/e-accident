<?php

use Illuminate\Auth\Events\Login;

defined('BASEPATH') or exit('No direct script access allowed');

class Cetak extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
    }
    function index()
    {
        $pdf = new FPDF('p', 'mm', 'A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Cell(190, 7, 'Laporan Investigasi Kecelakaan', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 7, 'DAFTAR SISWA KELAS IX JURUSAN REKAYASA PERANGKAT LUNAK', 0, 1, 'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 6, 'NIM', 1, 0);
        $pdf->Cell(85, 6, 'NAMA MAHASISWA', 1, 0);
        $pdf->Cell(27, 6, 'NO HP', 1, 0);
        $pdf->Cell(25, 6, 'TANGGAL LHR', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $lik = $this->db->get('tb_lik')->result();
        foreach ($lik as $row) {
            $pdf->Cell(20, 6, $row->tanggal, 1, 0);
            $pdf->Cell(85, 6, $row->waktu, 1, 0);
            $pdf->Cell(27, 6, $row->nama, 1, 0);
            $pdf->Cell(25, 6, $row->nik, 1, 1);
        }
        $pdf->Output();
    }
}
