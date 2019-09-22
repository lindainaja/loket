<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Websocket extends CI_Controller {

	public function index()
	{
		$this->load->view('websocket/index');
	}
}