<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiket extends CI_Controller {

	public function index()
	{
		$jenis_pendaftaran = $this->m_jenis_pendaftaran->get_jenis_pendaftaran();
		$data = [
			'jenis_pendaftaran' => $jenis_pendaftaran,
			'test' => 12
		];

	 

		$this->load->view('tiket/index', $data);
	}

	public function cetak($jenis)
	{
		$kode_jenis_pendaftaran = $this->m_jenis_pendaftaran->get_kode_jenis_pendaftaran();
		$kode_jenis = $kode_jenis_pendaftaran[$jenis];

		$nomor_terkhir = $this->m_pendaftaran->get_nomor_pendaftaran($kode_jenis);

		$nomor_antrian = $kode_jenis . sprintf("%04d", $nomor_terkhir) ;

		$data = [
			'jenis' => $jenis,
			'nomor_antrian' => $nomor_antrian
		];

		$this->m_pendaftaran->set_next_nomor_pendaftaran($kode_jenis);

		$this->load->view('tiket/cetak', $data);
	}
}
