<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adm extends CI_Controller {

	public function loket()
	{
		$data = [
			
		];
		$this->load->view('adm/loket', $data);
	
	}
}