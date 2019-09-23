<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adm extends CI_Controller {

	public function loket()
	{
		$nama_instansi = License::GetOrganization();
		$address = License::GetAddress();
		$telp = License::GetPhone();
		$daftar_poli_rs = $this->db->get('m_poli')->result_object();
		$daftar_poli = [''=>'--Pilih Poli--'];

		foreach ($daftar_poli_rs as $poli) {
			$daftar_poli[$poli->id] = $poli->nama;
		}
		$dd_poli = form_dropdown('id_poli',$daftar_poli,'','class="form-control" v-model="form.id_poli" @change="onChangePoli()" :disabled="form.id_antrian==\'\'"');
		$data = [
			'lokets' => $this->db->get('m_loket')->result_object(),
			'nama_instansi' => $nama_instansi,
			'alamat_instansi' => $address,
			'telp' => $telp,
			'dd_poli'=>$dd_poli
			
		];
		$this->load->view('adm/loket', $data);
	
	}
	// Tampilkan daftar antrian tabular data
	public function loket_list()
	{
		$loket_list = $this->db->select('al.id,al.status,al.nomor,al.waktu_mulai,jp.slug,jp.kode,jp.id jp_id')->where([
									'al.tanggal' => date('Y-m-d', time()),
									'al.status <>'=>' 5',
								])
							  ->join('m_jenis_pendaftaran jp','al.jp_id=jp.id')
							  ->order_by('al.id','asc')
							  ->get('m_antrian_loket al')

							  ->result_array();
		echo json_encode($loket_list);
	}

	// Tampilkan daftar antrian tabular data
	public function loket_skip($id)
	{
		$this->db->where('id',$id)->update('m_antrian_loket',['status'=>3]);
	}
	public function loket_register()
	{
		$form = json_decode(file_get_contents('php://input'));
		// print_r($form);

		$al_id   = $form->id_antrian;
		$nama    = $form->nama;
		$alamat  = $form->alamat;
		$id_poli = $form->id_poli;
		$tanggal = $form->tanggal;
		$dt   	 = $form->dt;
		$tanggal = date('Y-m-d',strtotime($form->dt));
		$waktu   = date('H:i:s',strtotime($form->dt));

		$rec_al  = [
			'status' => 5,
			'poli_id' => $id_poli,
			'waktu_dilayani'=> $waktu
		];
		//UPDATE AL
		$this->db->where('id',$al_id)->update('m_antrian_loket',$rec_al);

		$rec_ap = [
			'al_id' => $al_id,
			'nama' => $nama,
			'alamat' => $alamat,
			'poli_id'=>$id_poli,
			'tanggal'=>$tanggal,
			'waktu_mulai'=>$waktu,
			'status'=>1
		];
		//CHECK AP
		$rs = $this->db->where(['al_id'=>$al_id])->get('m_antrian_poli');
		if($rs->num_rows() > 0){
			//REC exists
			unset($rec_ap['al_id']);
			$this->db->where(['al_id'=>$al_id])->update('m_antrian_poli',$rec_ap);
		}else{
			// NEW rec
			$this->db->insert('m_antrian_poli',$rec_ap);
		}
		$result = [
			'status' => true,
			'ap' => $rec_ap,
			'al' => $rec_al
		];
		// UPDATE AL

		echo json_encode($result);
	}
}