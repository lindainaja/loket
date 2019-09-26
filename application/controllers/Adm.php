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
		$dt = date('Y-m-d', time());
		$loket_list = $this->db->select('al.id,al.status,al.nomor,al.waktu_mulai,jp.slug,jp.kode,jp.id jp_id')->where([
									'al.tanggal' => $dt,
									'al.status <>'=>' 5',
								])
							  ->join('m_jenis_pendaftaran jp','al.jp_id=jp.id')
							  ->order_by('al.id','asc')
							  ->get('m_antrian_loket al')

							  ->result_array();
		echo json_encode($loket_list);
	}
	public function poli_list()
	{
		$dt = date('Y-m-d', time());
/*
SELECT
map.id,
map.al_id,
map.tanggal,
map.waktu_mulai,
map.waktu_dilayani,
map.`status`,
map.nama,
map.alamat,
map.poli_id,
mp.nama AS nama_poli,
mal.nomor,
mjp.slug AS jenis
FROM
m_antrian_poli AS map
INNER JOIN m_poli AS mp ON map.poli_id = mp.id
INNER JOIN m_antrian_loket AS mal ON map.al_id = mal.id
INNER JOIN m_jenis_pendaftaran AS mjp ON mal.jp_id = mjp.id

*/
		$list = $this->db->select('map.id, map.al_id, map.tanggal, map.waktu_mulai, map.waktu_dilayani, map.status, map.nama, map.alamat, map.poli_id, mp.nama AS nama_poli, mal.nomor, mjp.slug AS jenis ')
						 ->join('m_poli mp','map.poli_id = mp.id','inner')
						 ->join('m_antrian_loket mal','map.al_id = mal.id','inner')
						 ->join('m_jenis_pendaftaran mjp','mal.jp_id = mjp.id','inner')
						 ->order_by('map.id','asc')
						 ->get('m_antrian_poli map')
						 ->result_array();
		echo json_encode($list);
	}

	// Tampilkan daftar antrian tabular data
	public function loket_skip($id)
	{
		$this->db->where('id',$id)->update('m_antrian_loket',['status'=>3]);
	}
	public function poli_skip($id)
	{
		$this->db->where('id',$id)->update('m_antrian_poli',['status'=>3]);
		# code...
	}
	public function loket_register()
	{
		$form = json_decode(file_get_contents('php://input'));
		// print_r($form);

		$al_id   = $form->id_antrian;
		$nomor    = $form->nomor;
		$kode    = $form->kode;
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
		// UPDATE DAL 
		// $this->db->where('date',$tanggal)
		$context = new ZMQContext();
	    $socket = $context->getSocket(ZMQ::SOCKET_PUSH);
	    $socket->connect('tcp://127.0.0.1:5555');
	    // // print_r($socket);
		$socket->send(json_encode(['cat'=>'onCreateAp','data'=>$rec_ap]) );
		
		$this->loket_update_dal((object)['nomor'=>$nomor]);

		echo json_encode($result);
	}
	
	public function loket_update_dal($src_lkt='')
	{
		$lkt = json_decode(file_get_contents('php://input'));
		
		if(!empty($src_lkt)){
			$lkt = $src_lkt;
		}
		
		$date = date('Y-m-d H:i:s',time());
		$dt= date('Y-m-d',time());
		$tanggal = date('Y-m-d',time());

		$a_cx = $this->db->where(['tanggal'=>$tanggal,'jp_id'=>1,'status'=>5])->get('m_antrian_loket')->num_rows();
		$b_cx = $this->db->where(['tanggal'=>$tanggal,'jp_id'=>2,'status'=>5])->get('m_antrian_loket')->num_rows();
		$c_cx = $this->db->where(['tanggal'=>$tanggal,'jp_id'=>3,'status'=>5])->get('m_antrian_loket')->num_rows();
		
		$dal = [
			'curr_no' => $lkt->nomor,
			'a_cx' => $a_cx,
			'b_cx' => $b_cx,
			'c_cx' => $c_cx,
			'date' => $date
		];
		//CHECK
		$rs = $this->db->where('DATE(date)',$dt)->get('m_display_antrian_loket')->num_rows();
		if($rs > 0){
			$this->db->where('DATE(date)',$dt)->update('m_display_antrian_loket',$dal);
		}else{
			$this->db->insert('m_display_antrian_loket',$dal);
		}

		// Ini lah sesuatu yang baru
	    
	    $context = new ZMQContext();
	    $socket = $context->getSocket(ZMQ::SOCKET_PUSH);
	    $socket->connect('tcp://127.0.0.1:5555');
	    // // print_r($socket);
	    $socket->send(json_encode(['cat'=>'onUpdateDal','data'=>$dal]) );

	    if(empty($src_lkt)){
	    	echo json_encode($lkt);
	    }
		
	}

	public function poli()
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
		$this->load->view('adm/poli', $data);
	
	}
}