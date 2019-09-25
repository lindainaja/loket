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
		
		$waktu_stop_tiket = $this->m_setting->get_value('waktu_stop_tiket');
		$enable_stop_tiket = $this->m_setting->get_value('enable_stop_tiket');

		$current_dt = date('Y-m-d H:i:s');
		$current_tm = strtotime($current_dt);
		$stop_dt = date('Y-m-d ').$waktu_stop_tiket;
		$stop_tm = strtotime($stop_dt);

		if ($enable_stop_tiket && ($current_tm > $stop_tm)) {
		    $data= ['pesan' => 'Maaf pelayanan tiket pendaftaran telah habis.' ];//"{$current_dt} > {$stop_dt}"
		    $this->load->view('tiket/timeout', $data);
		    return;
		}

		// echo "{$current_dt} < {$stop_dt}";
		$jp_ids = [];
		$kode_jenis_pendaftaran = $this->m_jenis_pendaftaran->get_kode_jenis_pendaftaran($jp_ids);
		$kode_jenis = $kode_jenis_pendaftaran[$jenis];
		$jp_id = $jp_ids[$jenis];

		$nomor_terkhir = $this->m_pendaftaran->get_nomor_pendaftaran($kode_jenis);
		$tiket_digit_format = $this->m_setting->get_value('tiket_digit_format');
		$nomor_antrian = $kode_jenis . sprintf($tiket_digit_format, $nomor_terkhir) ;

		$nama_instansi = License::GetOrganization();
		$address = License::GetAddress();
		$tlp_instansi = License::GetPhone();

		$tanggal_waktu = tanggal_indo(date('Y-m-d'),true). ' ' .date('H.i');

		$data = [
			'jenis' => $jenis,
			'nomor_antrian' => $nomor_antrian,
			'nama_instansi'=>$nama_instansi,
			'alamat_instansi' => $address,
			'tlp_instansi' => $tlp_instansi,
			'tanggal_waktu' => $tanggal_waktu
		];
		// GET DEFAULT ID LOKET
		$default_loket_id = $this->m_setting->get_value('default_loket_id');
		// GET SETTING LOKET
		$loket_id_by_setting_loket = $this->m_setting_loket->get_loket_id($jp_id);
		if(!empty($loket_id_by_setting_loket)){
			$default_loket_id = $loket_id_by_setting_loket;
		}

		$queue = [
			'jp_id' => $jp_id,
			'nomor'=>$nomor_antrian,
			'tanggal'=>date('Y-m-d'),
			'waktu_mulai'=> date('H:i:s'),
			'status'=>1,
			'loket_id' => $default_loket_id
		];

		$this->m_antrian_loket->register($queue);

		$this->m_pendaftaran->set_next_nomor_pendaftaran($kode_jenis);
		// Ini lah sesuatu yang baru
	    
	    $context = new ZMQContext();
	    $socket = $context->getSocket(ZMQ::SOCKET_PUSH);
	    $socket->connect('tcp://127.0.0.1:5555');
	    // // print_r($socket);
	    $socket->send(json_encode($queue));

		$this->load->view('tiket/cetak', $data);
	}
}
