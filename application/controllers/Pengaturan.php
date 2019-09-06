<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

	public function index()
	{
		$data = [
			
		];
		$this->load->view('antrian/index', $data);
	
	}
}