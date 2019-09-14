<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adm extends CI_Controller {

	public function loket()
	{
		$nama_instansi = License::GetOrganization();
		$address = License::GetAddress();
		$telp = License::GetPhone();

		$data = [
			'lokets' => $this->db->get('m_loket')->result_object(),
			'nama_instansi' => $nama_instansi,
			'alamat_instansi' => $address,
			'telp' => $telp,
			
		];
		$this->load->view('adm/loket', $data);
	
	}
}