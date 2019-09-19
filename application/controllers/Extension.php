<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Extension extends CI_Controller {

	public function index()
	{
		$test = new \Lytrax\Test(10);
		// $test->doTest();
		// $test->shift(3);
		// $test->accelerate();
		// $test->brake();
		// $speed =$test->getCurrentSpeed();
    	$gear = $test->getCurrentGear();
		// print_r($test->getCurrentSpeed());
		print_r($test);
		print_r($gear);
	}
}