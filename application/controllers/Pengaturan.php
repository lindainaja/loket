<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

	public function index()
	{
		$data = [
			'settings' => $this->m_setting->get_all()
		];
		$this->load->view('pengaturan/index', $data);
	
	}
}