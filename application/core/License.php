<?php

/**
 * 
 */
use phpseclib\Crypt\RSA;
class License 
{
	private static $ci;
	 

	public static function GetVolumeLabel($drive) {
		if(preg_match('#Volume Serial Number is (.*)\n#i', shell_exec('dir '.$drive.':'), $m)) {
			$volname = ' ('.$m[1].')';
		} else {
			$volname = '';
		}
		return $volname;
	}

	public static function GetHardwareId($drive)
	{
		return  str_replace("(","",str_replace(")","",License::GetVolumeLabel("c")));
	}

	public static function GenerateSerialNumber($hardware_id)
	{
		$rsa = new RSA();
		$rsa->setPassword($hardware_id);
		$data = $rsa->createKey();

		$license_path = "license/";

		$pk_path 	  = $license_path . "/pk";
		$pub_path 	  = $license_path . "/pub";

		$pk = "";
		$pub = "";

		if(!file_exists($pk_path)){
			file_put_contents($pk_path, $data['privatekey']);

		}
		if(!file_exists($pub_path)){
			file_put_contents($pub_path, $data['publickey']);

		}

		if(file_exists($pk_path)){
			$pk = file_get_contents($pk_path);
		}
		if(file_exists($pk_path)){
			$pub = file_get_contents($pub_path);
		}
		return json_encode([$pk,$pub]);

	}
	public static function CheckSerialNumber($hardware_id)
	{
		$license_path = "license/";

		$pk_path 	  = $license_path . "/pk";
		$pub_path 	  = $license_path . "/pub";
	}
	public static function CheckSupportFile($hardware_id)
	{

	}
	public static function GenerateSupportFile($hardware_id)
	{
		# code...
	}
	public static function IsSoftwareLicensed()
	{
		$hardware_id = License::GetHardwareId('c');
		$license_path = "license/";

		$pk_path 	  = $license_path . "/pk";
		$pub_path 	  = $license_path . "/pub";

		$pk = "";
		$pub = "";

		if(!file_exists($pk_path)){
			file_put_contents($pk_path, $data['privatekey']);

		}
		if(!file_exists($pub_path)){
			file_put_contents($pub_path, $data['publickey']);

		}

		if(file_exists($pk_path)){
			$pk = file_get_contents($pk_path);
		}
		if(file_exists($pk_path)){
			$pub = file_get_contents($pub_path);
		}
		if(!empty($pk) && !empty($pub)){
			$rsa = new RSA();
			$rsa->setPassword($hardware_id);
			$rsa->loadKey($pk); // private key

			$plaintext = 'HelloWorld';

			//$rsa->setSignatureMode(RSA::SIGNATURE_PSS);
			$signature = $rsa->sign($plaintext);

			$rsa->loadKey($pub); // public key
			return $rsa->verify($plaintext, $signature);// ? 'verified' : 'unverified';
		}
		return false;
		

	}
	

	public static function GetOrganization()
	{
		# code...
	}
	public static function GetAddress()
	{
		# code...
	}

	public static function GetEmail()
	{
		# code...
	}
	public static function GetPhone()
	{
	
	}
	public static function Encrypt($plaintext)
	{
	
	}
	public static function Decrypt($chipertext)
	{
	
	}
}