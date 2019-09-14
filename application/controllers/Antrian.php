<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Antrian extends CI_Controller {

	public function index()
	{
		$data = [
			
		];
		$this->load->view('antrian/index', $data);
	
	}
	public function loket()
	{
		$nama_instansi = License::GetOrganization();
		$address = License::GetAddress();
		$telp = License::GetPhone();
		$jenis_pendaftaran = $this->m_jenis_pendaftaran->get_jenis_pendaftaran();
		$data = [
			'jenis_pendaftaran' => $jenis_pendaftaran,
			'app_name' => $this->m_setting->get_value('app_name'),
			'alamat_instansi' => $address,
			'nama_instansi' => $nama_instansi,


		];

	 

		$this->load->view('antrian/loket', $data);
	}
	public function poli()
	{
		$jenis_pendaftaran = $this->m_jenis_pendaftaran->get_jenis_pendaftaran();
		$data = [
			'jenis_pendaftaran' => $jenis_pendaftaran,
			'test' => 12
		];

	 

		$this->load->view('antrian/poli', $data);
	}

	public function apotek()
	{
		$jenis_pendaftaran = $this->m_jenis_pendaftaran->get_jenis_pendaftaran();
		$data = [
			'jenis_pendaftaran' => $jenis_pendaftaran,
			'test' => 12
		];

	 

		$this->load->view('antrian/pendaftaran', $data);
	}
}