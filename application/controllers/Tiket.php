<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiket extends CI_Controller {

	public function index()
	{
		$jenis_pendaftaran = $this->m_jenis_pendaftaran->get_jenis_pendaftaran();
		$nama_instansi = License::GetOrganization();
		$address = License::GetAddress();
		$tlp_instansi = License::GetPhone();
		$data = [
			'jenis_pendaftaran' => $jenis_pendaftaran,
			'nama_instansi' => $nama_instansi,
			'alamat_instansi'=>$address,
			'tlp_instansi' => $tlp_instansi
		];

	 

		$this->load->view('tiket/index', $data);
	}

	public function cetak($jenis)
	{

		// periksa status layanan
		date_default_timezone_set('Asia/Jakarta');
		$waktu_stop_tiket = $this->m_setting->get_value('waktu_stop_tiket');
		$current_dt = date('Y-m-d H:i:s');
		$current_tm = strtotime($current_dt);
		$stop_dt = date('Y-m-d ').$waktu_stop_tiket;
		$stop_tm = strtotime($stop_dt);
		if ($current_tm > $stop_tm) {
		    $data= ['pesan' => 'Maaf pelayanan tiket pendaftaran telah habis.' ];//"{$current_dt} > {$stop_dt}"
		    $this->load->view('tiket/timeout', $data);
		    return;
		}

		// echo "{$current_dt} < {$stop_dt}";
		$kode_jenis_pendaftaran = $this->m_jenis_pendaftaran->get_kode_jenis_pendaftaran();
		$kode_jenis = $kode_jenis_pendaftaran[$jenis];

		$nomor_terkhir = $this->m_pendaftaran->get_nomor_pendaftaran($kode_jenis);
		$tiket_digit_format = $this->m_setting->get_value('tiket_digit_format');
		$nomor_antrian = $kode_jenis . sprintf($tiket_digit_format, $nomor_terkhir) ;

		$nama_instansi = License::GetOrganization();
		$address = License::GetAddress();
		$tlp_instansi = License::GetPhone();

		$data = [
			'jenis' => $jenis,
			'nomor_antrian' => $nomor_antrian,
			'nama_instansi'=>$nama_instansi,
			'alamat_instansi' => $address,
			'tlp_instansi' => $tlp_instansi
		];

		$this->m_pendaftaran->set_next_nomor_pendaftaran($kode_jenis);

		$this->load->view('tiket/cetak', $data);
	}
}
