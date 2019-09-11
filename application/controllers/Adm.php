<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adm extends CI_Controller {

	public function loket()
	{
		$data = [
			'lokets' => $this->db->get('m_loket')->result_object()
		];
		$this->load->view('adm/loket', $data);
	
	}
}