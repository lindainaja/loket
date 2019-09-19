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
	// Tampilkan daftar antrian tabular data
	public function loket_list()
	{
		$loket_list = $this->db->select('al.id,al.status,al.nomor,al.waktu_mulai,jp.slug,jp.kode,jp.id jp_id')->where([
									'tanggal' => date('Y-m-d'),
									'status' => 1,
								])
							  ->join('m_jenis_pendaftaran jp','al.jp_id=jp.id')
							  ->order_by('waktu_mulai','asc')
							  ->get('m_antrian_loket al')

							  ->result_array();
		echo json_encode($loket_list);
	}

	// Tampilkan daftar antrian tabular data
	public function loket_row($jp_id)
	{
		# code...
	}
}