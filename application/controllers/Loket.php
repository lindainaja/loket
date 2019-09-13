<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loket extends CI_Controller {

	public function index()
	{
		$organization = License::GetOrganization();
		$address = License::GetAddress();
		$hardware_id = License::GetHardwareId('c');
		// $serial_number = License::GenerateSerialNumber($hardware_id);
		$is_licensed = License::IsSoftwareLicensed();
		$data = [
			'organization' => $organization,
			'address' => $address,
			'hardware_id'=>$hardware_id,
			// 'serial_number' => $serial_number
			'is_licensed'=>$is_licensed
		];

		$this->load->view('loket/index', $data);
	}

	
}
